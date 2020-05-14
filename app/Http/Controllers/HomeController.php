<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use SimpleXMLElement;
use TourCMS\Utils\TourCMS as TourCMS;


class HomeController extends Controller
{
   public function index()
   {
   	//Agents can find their Marketplace ID in the API page in TourCMS settings
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
    $channel_id = 9144;


// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);
  // 'simplexml' returns as a SimpleXMLObject
  // 'raw' returns the XML as as String

// Call the API
  // Here as a quick example we search for some tours

  $result = $tourcms->list_channels();

// Loop through each channel
foreach($result as $channel) {
  // Print out the channel name
  print $channel->channel_name.'<br />';
}

 

   }
  
public function showTour()
   {
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);
  $tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;

// Query the TourCMS API
$result = $tourcms->show_tour($tour, $channel);

// Go straight to the tour node
$tour = $result->tour;

// Print out the tour name and lead in price
print $tour->tour_name.' - from only '.$tour->from_price_display;



}

public function checkAvailabiliy()
   {
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);
  $qs = "date=2020-08-29";

// If this Tour used Hotel type pricing we'd append a duration
// $qs .= "&hdur=7";

// Append the number of people for each rate
// Rate details obtained via "Show Tour" API
// Numbers of people likely via user input
// Here we just want 2 people on rate "r1"
$qs .= "&r1=2";
$tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;

// Query the TourCMS API
$result = $tourcms->check_tour_availability($qs, $tour, $channel);

// See how many available components TourCMS has returned
if(isset($result->available_components->component))
  $num_components = count($result->available_components->component);
else
  $num_components = 0;

// If there are components display them, otherwise display "no availability"
if($num_components>0)
{
  // We have some components, loop through them
  foreach ($result->available_components->component as $component)
  {
    print $component->date_code . " ";
    print $component->total_price_display . "<br />";
  }
} else {
  // The components we searched for are not available
  print "Sorry, no availability";
}



}

public function searchBooking()
   {
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);

// If this Tour used Hotel type pricing we'd append a duration
// $qs .= "&hdur=7";

// Append the number of people for each rate
// Rate details obtained via "Show Tour" API
// Numbers of people likely via user input
// Here we just want 2 people on rate "r1"
$tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;

$params = "active=1";

// Query the TourCMS API
$results = $tourcms->search_bookings($params, $channel);

// Loop through each booking
foreach($results->booking as $booking) {
  // Print out the booking ID and channel name
  print $booking->booking_id." - ".$booking->channel_name." &gt; ";

  // Print out the booking name and revenue
  print $booking->booking_name." (".$booking->sales_revenue_display.")";
  print "<br />";
}


}

public function showBooking()
   {
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;
$tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);

// If this Tour used Hotel type pricing we'd append a duration
// $qs .= "&hdur=7";

// Append the number of people for each rate
// Rate details obtained via "Show Tour" API
// Numbers of people likely via user input
// Here we just want 2 people on rate "r1"
$booking = 59694021;
$result = $tourcms->show_booking($booking, $channel);

// Get the booking node
$booking = $result->booking;

// Print the booking ID
print $booking->booking_id . "<br />";

// Print the Booking name
print $booking->booking_name . "<br />";

// Format and print the booking start and end dates
$start_date = strtotime($booking->start_date);
$start_date_display = date("jS F Y (l)", $start_date);
print "Start: ".$start_date_display. "<br />";

$end_date = strtotime($booking->end_date);
$end_date_display = date("jS F Y (l)", $end_date);
print "End: " . date("jS F Y (l)", $end_date) . "<br />";


}


public function startNewBooking()
   {
    $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);

// If this Tour used Hotel type pricing we'd append a duration
// $qs .= "&hdur=7";

// Append the number of people for each rate
// Rate details obtained via "Show Tour" API
// Numbers of people likely via user input
// Here we just want 2 people on rate "r1"
$tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;

// Query the TourCMS API
$booking = new SimpleXMLElement('<booking />');

// Append the total customers, we'll add their details on below
$booking->addChild('total_customers', '1');

// If we're calling the API as a Tour Operator we need to add a Booking Key
// otherwise skip this
// See "Getting a new booking key" for info
$booking->addChild('booking_key', 'NO_AGENT');

// Append a container for the components to be booked
$components = $booking->addChild('components');

// Add a component node for each item to add to the booking
$component = $components->addChild('component');

// "Component key" obtained via call to "Check availability"
$component->addChild('component_key', 'Ra6+Jm4qprIgCNqiz2on4LDgX7v+3B9zIF68v5ffrlledY6g7S0hslB7XxiCIIaVGLJehxOpb9qn3/vC6gTztw==');

// Append a container for the customer recrds
$customers = $booking->addChild('customers');

// Optionally append the customer details
// Either add their details (as here)
// OR an existing customer_id
// OR leave blank and TourCMS will create a blank customer
$customer = $customers->addChild('customer');
$customer->addChild('title', 'Mr');
$customer->addChild('firstname', 'Joe');
$customer->addChild('surname', 'Bloggs');
$customer->addChild('email', 'Email');

// Query the TourCMS API, creating the booking
$result = $tourcms->start_new_booking($booking, $channel);

$bkg = $result->booking;

echo "<pre>";
print_r($bkg);die;

// Display the temporary booking ID
print "Temporary booking ID: " . $bkg->booking_id . "<br />";

// Check whether any components were unavailable
// Non-zero would indicate some items sold out since "Check availability"
print $bkg->unavailable_component_count . " unavailable components";



}

public function commitBooking()
{
  $booking_id = 59694021;

// Channel the booking is made with
 $marketplace_id = 47991;

  // API key will be a string, find it in the API page in TourCMS settings
    $api_key = "9bc420963401";

  // Timeout will set the maximum execution time, in seconds. If set to zero, no time limit is imposed.
    $timeout = 0;

  // Channel ID represents the Tour Operator channel to call the API against
  // Tour Operators may have multiple channels, so enter the correct one here
  // Agents can make some calls (e.g. tour_search()) across multiple channels
  // by entering a Channel ID of 0 or omitting it, or they can restrict to a
  // specific channel by providing the Channel ID
   
// Create a new TourCMS instance
  // Optionally alias the namespace
  $tourcms = new TourCMS($marketplace_id, $api_key, 'simplexml', $timeout);

// If this Tour used Hotel type pricing we'd append a duration
// $qs .= "&hdur=7";

// Append the number of people for each rate
// Rate details obtained via "Show Tour" API
// Numbers of people likely via user input
// Here we just want 2 people on rate "r1"
$tour = 152;

// Channel (Operator) ID of the Tour
$channel = 9144;
// Build the XML to post to TourCMS
$booking = new SimpleXMLElement('<booking />');
$booking->addChild('booking_id', $booking_id);

// Query the TourCMS API, upgrading the booking from temporary to live
$result = $tourcms->commit_new_booking($booking, $channel);

echo "<pre>";
print_r($result);die;
// Check whether everything was ok
if($result->error == "OK")
  print "Thanks, your booking ID is " . $result->booking->booking_id;
else
  print "Sorry, there was a problem: " . $result->error;

}


}