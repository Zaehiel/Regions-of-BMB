<?php
$dir = "data/";
$eune = "eune.json";
$euw = "euw.json";
$na = "na.json";

function champions($region){
	/*overall champion data, popularity, kills, gold, pentas, towers*/
	global $eune;
	global $euw;
	global $na;
	global $dir;
	$source = "";
	if($region=="eune"){
		$source = $eune;
	} else if($region=="euw"){
		$source = $euw;
	} else if($region=="na"){
		$source = $na;
	}
	
	$data = json_decode(file_get_contents($dir.$source),true);
	$cpool = array();
	foreach($data as $each_champ){
		$wr = number_format($each_champ['wins']/($each_champ['wins']+$each_champ['loss']),4);
		$wr = $wr * 100;
		$kd = number_format($each_champ['kills']/$each_champ['deaths'],2);
		$count = $each_champ['wins']+$each_champ['loss'];
		array_push($cpool, array(
			"champId" => $each_champ['champId'],
			"played" => $count,
			"wins" => $each_champ['wins'],
			"loss" => $each_champ['loss'],
			"winrate" => $wr,
			"gold" => $each_champ['gold'],
			"kills" => $each_champ['kills'],
			"deaths" => $each_champ['deaths'],
			"kd" => $kd,
			"pentas" => $each_champ['pentas'],
			"towers" => $each_champ['towers'],
		));
	}
	return $cpool;
}

function champItems($region, $champId){
	global $eune;
	global $euw;
	global $na;
	global $dir;
	$source ="";
	if($region=="eune"){
		$source = $eune;
	} else if($region=="euw"){
		$source = $euw;
	} else if($region=="na"){
		$source = $na;
	}
	
	$data = json_decode(file_get_contents($dir.$source),true);
	foreach($data as $champ){
		if($champ['champId'] == $champId){
			$champion = array(
			"champId" => $champ['champId'],
			"items" => array()
			);
			foreach($champ['items'] as $item){
				if($item['name'] != 0 && $item['name'] != 3340 && $item['name'] != 1314 && $item['name'] != 1304 && $item['name'] != 1329 && $item['name'] != 1055 && $item['name'] != 3006 && $item['name'] != 3020 && $item['name'] != 1056 && $item['name'] != 2003 && $item['name'] != 1001 && $item['name'] != 3341 && $item['name'] != 3361 && $item['name'] != 3117 && $item['name'] != 3111 && $item['name'] != 1058 && $item['name'] != 1052 && $item['name'] != 1037 && $item['name'] != 1053 && $item['name'] != 1028 && $item['name'] != 1026 && $item['name'] != 1038 && $item['name'] != 2004 && $item['name'] != 1036 && $item['name'] != 3009 && $item['name'] != 3047 && $item['name'] != 1054 && $item['name'] != 1324 && $item['name'] != 1319 && $item['name'] != 3362 && $item['name'] != 1011 && $item['name'] != 1033 && $item['name'] != 3801 && $item['name'] != 3302){
					$wins = $item['wins'];
					$count = $item['count'];
					$wr = number_format($wins/$count,4);
					$wr = $wr * 100;
					array_push($champion['items'], 
					array(
					"name" => $item['name'],
					"winrate" => $wr,
					"count" => $item['count'],
					"wins" => $item['wins'],
					"loss" => $item['loss']
					));
				}
			}
			usort($champion['items'], function($a, $b){
				return $b['count'] - $a['count'];
			});
			break;
		}
	}
	return $champion;
}
function champItems2($region, $champId){
	/*basically same as above, but doesnt remove certain items.. wtb more time*/
	global $eune;
	global $euw;
	global $na;
	global $dir;
	$source ="";
	if($region=="eune"){
		$source = $eune;
	} else if($region=="euw"){
		$source = $euw;
	} else if($region=="na"){
		$source = $na;
	}
	
	$data = json_decode(file_get_contents($dir.$source),true);
	foreach($data as $champ){
		if($champ['champId'] == $champId){
			$champion = array(
			"champId" => $champ['champId'],
			"items" => array()
			);
			foreach($champ['items'] as $item){
				if($item['name'] != 0){
					$wins = $item['wins'];
					$count = $item['count'];
					$wr = number_format($wins/$count,4);
					$wr = $wr * 100;
					array_push($champion['items'], 
					array(
					"name" => $item['name'],
					"winrate" => $wr,
					"count" => $item['count'],
					"wins" => $item['wins'],
					"loss" => $item['loss']
					));
				}
			}
			usort($champion['items'], function($a, $b){
				return $b['count'] - $a['count'];
			});
			break;
		}
	}
	return $champion;
}
?>