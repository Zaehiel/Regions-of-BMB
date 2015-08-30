<?php
session_start();
error_reporting(E_ALL);
require_once('api.php');

$region = 'na'; 
$file = "na.json"; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(isset($_REQUEST['q']) && !isset($_REQUEST['w'])){
		$matchId = $_REQUEST['q'];
		
		get_json($matchId, $region);

	} else if(isset($_REQUEST['w']) && !isset($_REQUEST['q'])){
		if($_REQUEST[w]){
			$fp = fopen($file, 'w+');
			/*parse to json again for printing*/
			$champs = json_encode($_SESSION['champs']);
			fwrite($fp, $champs);
			fclose($fp);
		}
	}
}

/* get the json data returned and start messing with it*/
function get_json($id, $region) {
	global $apikey;
	$url = 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v2.2/match/'.$id.'?api_key='.$apikey;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
	$content = curl_exec($ch); //returned data
	curl_close($ch);
	$json_output = json_decode($content, true);
	
	
	foreach($json_output['participants'] as &$each_champion){
		$c = 0;
		if($each_champion['stats']['winner'] == true){
			$win = 1;
			$loss = 0;
		} else {
			$loss = 1;
			$win = 0;
		}

		/*function just started initializing the array*/
		if(!isset($_SESSION['champs']) || count($_SESSION['champs']) < 1){
			$_SESSION['champs'] = array();
			array_push($_SESSION['champs'], array(
				"champId" => $each_champion['championId'], 
				"wins" => $win,
				"loss" => $loss,
				"gold" => $each_champion['stats']['goldEarned'],
				"kills" => $each_champion['stats']['kills'],
				"deaths" => $each_champion['stats']['deaths'],
				"pentas" => $each_champion['stats']['pentaKills'],
				"towers" => $each_champion['stats']['towerKills'],
				"items" => array(
					array("name" => $each_champion['stats']['item0'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item1'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item2'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item3'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item4'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item5'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item6'], "count" => 1, "wins" => $win, "loss" => $loss)
					)
				)
			
			);
		} else if (count($_SESSION['champs']) > 0){
			/* check for existing champion entries and items*/
			$exists = false;
			foreach($_SESSION['champs'] as &$cached){
				
				if($cached['champId'] === $each_champion['championId']){
					$exists = true;
					$cached['wins'] += $win;
					$cached['loss'] = $cached['loss'] +$loss;
					$cached['gold'] = $cached['gold'] +$each_champion['stats']['goldEarned'];
					$cached['kills'] = $cached['kills'] +$each_champion['stats']['kills'];
					$cached['deaths'] = $cached['deaths'] +$each_champion['stats']['deaths'];
					$cached['pentas'] = $cached['pentas'] +$each_champion['stats']['pentaKills'];
					$cached['towers'] = $cached['towers'] +$each_champion['stats']['towerKills'];
					$itemC = 0;
					$item0=0;$item1=0;$item2=0;$item3=0;$item4=0;$item5=0;$item6=0;
					foreach($cached['items'] as &$each_item){
						for($itemC = 0;$itemC < 7; $itemC++){
							$itemString = 'item'.$itemC;
							if($each_item['name'] === $each_champion['stats'][$itemString]){
								$each_item['count'] = $each_item['count'] +1;
								$each_item['wins'] = $each_item['wins'] +$win;
								$each_item['loss'] = $each_item['loss'] +$loss;
								if($itemC == 0){$item0=1;}
								if($itemC == 1){$item1=1;}
								if($itemC == 2){$item2=1;}
								if($itemC == 3){$item3=1;}
								if($itemC == 4){$item4=1;}
								if($itemC == 5){$item5=1;}
								if($itemC == 6){$item6=1;}
							} 

						}
					}
					if($item0 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item0'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item1 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item1'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item2 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item2'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item3 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item3'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item4 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item4'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item5 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item5'], "count" => 1, "wins" => $win, "loss" => $loss));}
					if($item6 == 0){array_push($cached['items'], array("name" => $each_champion['stats']['item6'], "count" => 1, "wins" => $win, "loss" => $loss));}
					break;
				} 
			} if(!$exists){
				/* entry didn't exist, just push*/
				array_push($_SESSION['champs'], array(
				"champId" => $each_champion['championId'], 
				"wins" => $win,
				"loss" => $loss,
				"gold" => $each_champion['stats']['goldEarned'],
				"kills" => $each_champion['stats']['kills'],
				"deaths" => $each_champion['stats']['deaths'],
				"pentas" => $each_champion['stats']['pentaKills'],
				"towers" => $each_champion['stats']['towerKills'],
				"items" => array(
					array("name" => $each_champion['stats']['item0'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item1'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item2'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item3'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item4'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item5'], "count" => 1, "wins" => $win, "loss" => $loss),
					array("name" => $each_champion['stats']['item6'], "count" => 1, "wins" => $win, "loss" => $loss)
					)
				)
			
			);
			}
		}
		
	}
	
	echo "done";
	
}
?>