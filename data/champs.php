<?php
session_start();
error_reporting(E_ALL);
require_once('api.php');

$region = 'na'; 
$file = "champdata.json"; 

/* using cookies to cache & work with the data as it is retrieved */
if(!isset($_SESSION['champdata'])){
$_SESSION['champdata'] = array();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(isset($_REQUEST['q']) && !isset($_REQUEST['w'])){
		$champId = $_REQUEST['q'];
		
		get_json($champId, $region);

	} else if(isset($_REQUEST['w'])){
		
			$fp = fopen($file, 'w+');
			$champs = json_encode($_SESSION['champdata']);
			fwrite($fp, $champs);
			fclose($fp);
			echo "printed";
		
	}
}

/* get the json data returned and start messing with it*/
function get_json($id, $region) {
	global $apikey;
	$url = 'https://'.$region.'.api.pvp.net/api/lol/static-data/'.$region.'/v1.2/champion/'.$id.'?api_key='.$apikey;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
	$content = curl_exec($ch); //returned data
	curl_close($ch);
	$json_output = json_decode($content, true);
	
	$try = false;
	foreach($json_output as $each){
		/*foreach = dodgy way to determine wether data was received or not*/
		$try = true;
		
	}
	if($try){array_push($_SESSION['champdata'],$json_output); echo "done";}
	
}


/** BELOW is to just echo all the champions and the total count, just a quick check to see if it worked : D**/
/*
$data = json_decode(file_get_contents('champdata.json'),true);
$count = 0;
usort($data, function($a, $b){
	return strcmp($a['name'], $b['name']);
});
foreach($data as $each){
	if($each['name'] != null){
	$count++;
	}
	
	echo $each['name']."<br>";
}
echo  $count;

*/
?>