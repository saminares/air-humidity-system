<?php 
//Get new event from Thingsee, decode the array from JSON and save humidity measurement to variable
$thingseeData = file_get_contents('php://input');
$json_a = json_decode($thingseeData, true);
$humValue = ($json_a['0']['senses']['0']['val']);


//Get current date and time to be included with received humidity data
date_default_timezone_set('EET');
$now = new DateTime();
$timestamp =  $now->format('Y-m-d H:i:s') . "\n";

//Create Connection to SQL database and insert thingsee data and timestamp into ts_events table
$con=mysqli_connect("IP ADDRESS HERE","SQL USERNAME HERE","SQL PASSWORD HERE","DATABASE NAME HERE");
$sql="INSERT INTO ts_events(sensor,kuvaus,value,timestamp) 
    VALUES 
    ('0','Humidity','$humValue','$timestamp');";

mysqli_query($con,$sql);
mysqli_close($con);


$file = 'waterlevel.txt';
$current = file_get_contents('waterlevel.txt', true);
$waterlevel = filesize("waterlevel.txt");

//Connect to Kankun Wi-Fi plug
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Net/SSH2.php');
$ssh = new Net_SSH2('THINGSEE IP ADDRESS HERE');
if (!$ssh->login('USERNAM HERE', 'PASSWORD HERE')) {
    exit('Login Failed');
}
$ssh->write("echo 0 > /sys/class/leds/tp-link:blue:relay/brightness\n"); // turns Kankun relay off
$output = $ssh->read('username@username:~$');
if ($waterlevel < 26){
  if($humValue<35){
    $ssh->write("echo 1 > /sys/class/leds/tp-link:blue:relay/brightness\n"); // turns Kankun relay on
    $output = $ssh->read('username@username:~$');
		$current .= "x";
		file_put_contents($file, $current);
	}
	else {
		return;
	}
  
}
else {


// require Facebook PHP SDK
require_once("facebook-php-sdk-v4/src/Facebook/autoload.php");
 
$ch = curl_init();


 $fb = new Facebook\Facebook([
  'app_id' => 'FACEBOOK APP ID HERE',
  'app_secret' => 'FACEBOOK APP SECRET HERE',
  'default_graph_version' => 'v2.2',
  ]);

try {
  // Post notification to facebook page
  $response = $fb->post('/me/feed?access_token=
    ACCESS TOKEN HERE
    &message=More Water!');

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

}


?>

