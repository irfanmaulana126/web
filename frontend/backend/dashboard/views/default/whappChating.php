<?php 
/* 	// Pull messages (for push messages please go to settings of the number) 
$my_apikey = "[THE NUMBER'S APIKEY]"; 
$number = "[DESTINATION]"; 
$type = "[TYPE OF MESSAGE: IN or OUT]"; 
$markaspulled = "[1 or 0]"; 
$getnotpulledonly = "[1 or 0]"; 
$api_url  = "http://panel.apiwha.com/get_messages.php"; 
$api_url .= "?apikey=". urlencode ($my_apikey); 
$api_url .=	"&number=". urlencode ($number); 
$api_url .= "&type=". urlencode ($type); 
$api_url .= "&markaspulled=". urlencode ($markaspulled); 
$api_url .= "&getnotpulledonly=". urlencode ($getnotpulledonly); 
$my_json_result = file_get_contents($api_url, false); 
$my_php_arr = json_decode($my_json_result); 
foreach($my_php_arr as $item) 
{ 
  $from_temp = $item->from; 
  $to_temp = $item->to; 
  $text_temp = $item->text; 
  $type_temp = $item->type; 
  echo "<br>". $from_temp ." -> ". $to_temp ." (". $type_temp ."): ". $text_temp; 
  // Do something 
} */	

// Send Message 
$my_apikey = "NDSR76NFU903SN5BJLMW"; 

//$destination = "6285883319929"; 
$destination = "62816906080"; 
$message = "test dari wh api "; 
$api_url = "http://panel.apiwha.com/send_message.php"; 
$api_url .= "?apikey=". urlencode ($my_apikey); 
$api_url .= "&number=". urlencode ($destination); 
$api_url .= "&text=". urlencode ($message); 
$my_result_object = json_decode(file_get_contents($api_url, false)); 
echo "<br>Result: ". $my_result_object->success; 
echo "<br>Description: ". $my_result_object->description; 
echo "<br>Code: ". $my_result_object->result_code; 

?>