<?php
error_reporting(E_ALL);
require_once('data/api.php');
require_once('data.php');
$regions = ['euw', 'na', 'eune'];
$champdata = json_decode(file_get_contents('data/champdata.json'),true);
$body = "";
$script = "";
$onload = "";
$table1 ="";$table2 ="";
$items0 ="";
$items1 ="";
$items3 ="";
$items4 ="";
$items5 ="";
/*building all the data beforehand in a for cycle*/
for($i = 0; $i < count($regions); $i++){
	$popChamps = champions($regions[$i]);
	usort($popChamps, function($a, $b){
		return $b['played'] - $a['played'];
	});
	$script .='
		var barData'.$i.' ={
			labels : [
			';
			$c0 ="";$c1 ="";$c2 ="";$c3 ="";$c4 ="";$c5 ="";$c6 ="";$c7 ="";$c8 ="";$c9 ="";$c10 ="";$c11 ="";$c12 ="";$c13 ="";$c14 ="";
			$cc0="";$cc1="";$cc2="";$cc3="";$cc4="";$cc5="";$cc6="";$cc7="";$cc8="";$cc9="";$cc10="";$cc11="";$cc12="";$cc13="";$cc14="";
			foreach($champdata as $each){
			if($each['id'] == $popChamps[0]['champId']){ $c0 .=$each['name'];$cc0=$each['key'];}
			if($each['id'] == $popChamps[1]['champId']){ $c1 .= $each['name'];$cc1=$each['key'];}
			if($each['id'] == $popChamps[2]['champId']){ $c2 .= $each['name'];$cc2=$each['key'];}
			if($each['id'] == $popChamps[3]['champId']){ $c3 .= $each['name'];$cc3=$each['key'];}
			if($each['id'] == $popChamps[4]['champId']){ $c4 .= $each['name'];$cc4=$each['key'];}
			if($each['id'] == $popChamps[5]['champId']){ $c5 .= $each['name'];$cc5=$each['key'];}
			if($each['id'] == $popChamps[6]['champId']){ $c6 .= $each['name'];$cc6=$each['key'];}
			if($each['id'] == $popChamps[7]['champId']){ $c7 .= $each['name'];$cc7=$each['key'];}
			if($each['id'] == $popChamps[8]['champId']){ $c8 .= $each['name'];$cc8=$each['key'];}
			if($each['id'] == $popChamps[9]['champId']){ $c9 .= $each['name'];$cc9=$each['key'];}
			if($each['id'] == $popChamps[10]['champId']){ $c10 .= $each['name'];$cc10=$each['key'];}
			if($each['id'] == $popChamps[11]['champId']){ $c11 .= $each['name'];$cc11=$each['key'];}
			if($each['id'] == $popChamps[12]['champId']){ $c12 .= $each['name'];$cc12=$each['key'];}
			if($each['id'] == $popChamps[13]['champId']){ $c13 .= $each['name'];$cc13=$each['key'];}
			if($each['id'] == $popChamps[14]['champId']){ $c14 .= $each['name'];$cc14=$each['key'];}
			}
			$script .= '"'.$c0.'",
						"'.$c1.'",
						"'.$c2.'",
						"'.$c3.'",
						"'.$c4.'",
						"'.$c5.'",
						"'.$c6.'",
						"'.$c7.'",
						"'.$c8.'",
						"'.$c9.'",
						"'.$c10.'",
						"'.$c11.'",
						"'.$c12.'",
						"'.$c13.'",
						"'.$c14.'"
						';
	$items0 = champItems($regions[$i],$popChamps[0]['champId']);		
	$items1 = champItems($regions[$i],$popChamps[1]['champId']);		
	$items2 = champItems($regions[$i],$popChamps[2]['champId']);		
	$items3 = champItems($regions[$i],$popChamps[3]['champId']);		
	$items4 = champItems($regions[$i],$popChamps[4]['champId']);		
	$items5 = champItems($regions[$i],$popChamps[5]['champId']);		
	$table1 ='<tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc0.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[0]['winrate'].'%</td>
				<td>'.$popChamps[0]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[0]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc1.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[1]['winrate'].'%</td>
				<td>'.$popChamps[1]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[1]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc2.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[2]['winrate'].'%</td>
				<td>'.$popChamps[2]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[2]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc3.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[3]['winrate'].'%</td>
				<td>'.$popChamps[3]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[3]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc4.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[4]['winrate'].'%</td>
				<td>'.$popChamps[4]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[4]['champId'].'">More >></a></td>
			</tr>';
	
	$script .='],
			datasets : [
				{
				fillColor : "rgba(30, 102, 174,0.6)",
				/*strokeColor : "rgba(220,220,220,0.8)",*/
				highlightFill: "rgba(30, 102, 174,0.75)",
				/*highlightStroke: "rgba(220,220,220,1)",*/
				data : ['.$popChamps[0]['played'].',
						'.$popChamps[1]['played'].',
						'.$popChamps[2]['played'].',
						'.$popChamps[3]['played'].',
						'.$popChamps[4]['played'].',
						'.$popChamps[5]['played'].',
						'.$popChamps[6]['played'].',
						'.$popChamps[7]['played'].',
						'.$popChamps[8]['played'].',
						'.$popChamps[9]['played'].',
						'.$popChamps[10]['played'].',
						'.$popChamps[11]['played'].',
						'.$popChamps[12]['played'].',
						'.$popChamps[13]['played'].',
						'.$popChamps[14]['played'].'
						]
				}
			]
		}

	';
	usort($popChamps, function($a, $b){
				return $b['winrate'] > $a['winrate'];
				});
	$script .= '
		var barData2'.$i.' ={
			labels : [
			';
			foreach($champdata as $each){
				if($each['id'] == $popChamps[0]['champId']){$c0 = $each['name'];$cc0=$each['key'];}
				if($each['id'] == $popChamps[1]['champId']){$c1 = $each['name'];$cc1=$each['key'];}
				if($each['id'] == $popChamps[2]['champId']){$c2 = $each['name'];$cc2=$each['key'];}
				if($each['id'] == $popChamps[3]['champId']){$c3 = $each['name'];$cc3=$each['key'];}
				if($each['id'] == $popChamps[4]['champId']){$c4 = $each['name'];$cc4=$each['key'];}
				if($each['id'] == $popChamps[5]['champId']){$c5 = $each['name'];$cc5=$each['key'];}
				if($each['id'] == $popChamps[6]['champId']){$c6 = $each['name'];$cc6=$each['key'];}
				if($each['id'] == $popChamps[7]['champId']){$c7 = $each['name'];$cc7=$each['key'];}
				if($each['id'] == $popChamps[8]['champId']){$c8 = $each['name'];$cc8=$each['key'];}
				if($each['id'] == $popChamps[9]['champId']){$c9 = $each['name'];$cc9=$each['key'];}
				if($each['id'] == $popChamps[10]['champId']){$c10 = $each['name'];$cc10=$each['key'];}
				if($each['id'] == $popChamps[11]['champId']){$c11 = $each['name'];$cc11=$each['key'];}
				if($each['id'] == $popChamps[12]['champId']){$c12 = $each['name'];$cc12=$each['key'];}
				if($each['id'] == $popChamps[13]['champId']){$c13 = $each['name'];$cc13=$each['key'];}
				if($each['id'] == $popChamps[14]['champId']){$c14 = $each['name'];$cc14=$each['key'];}
			}
			$script .= '"'.$c0.'",
						"'.$c1.'",
						"'.$c2.'",
						"'.$c3.'",
						"'.$c4.'",
						"'.$c5.'",
						"'.$c6.'",
						"'.$c7.'",
						"'.$c8.'",
						"'.$c9.'",
						"'.$c10.'",
						"'.$c11.'",
						"'.$c12.'",
						"'.$c13.'",
						"'.$c14.'"
						';
	$items0 = champItems($regions[$i],$popChamps[0]['champId']);		
	$items1 = champItems($regions[$i],$popChamps[1]['champId']);		
	$items2 = champItems($regions[$i],$popChamps[2]['champId']);		
	$items3 = champItems($regions[$i],$popChamps[3]['champId']);		
	$items4 = champItems($regions[$i],$popChamps[4]['champId']);		
	$items5 = champItems($regions[$i],$popChamps[5]['champId']);	
	$table2 = '
		<tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc0.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[0]['played'].'</td>
				<td>'.$popChamps[0]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items0['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[0]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc1.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[1]['played'].'</td>
				<td>'.$popChamps[1]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items1['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[1]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc2.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[2]['played'].'</td>
				<td>'.$popChamps[2]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items2['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[2]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc3.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[3]['played'].'</td>
				<td>'.$popChamps[3]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items3['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[3]['champId'].'">More >></a></td>
			</tr><tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$cc4.'.png" style="width:30px;" alt=""></td>
				<td>'.$popChamps[4]['played'].'</td>
				<td>'.$popChamps[4]['pentas'].'</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][0]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][1]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][2]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][3]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][4]['name'].'.png" style="width:30px;"> 
					<img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$items4['items'][5]['name'].'.png" style="width:30px;"> 
				</td>
				<td><a href="http://ehco.planet.ee/BMB/champions.php?id='.$popChamps[4]['champId'].'">More >></a></td>
			</tr>
	';					
						
	$script .= '],
			datasets : [
				{
				fillColor : "rgba(168, 198, 47,0.6)",
				/*strokeColor : "rgba(220,220,220,0.8)",*/
				highlightFill: "rgba(168, 198, 47,0.85)",
				/*highlightStroke: "rgba(220,220,220,1)",*/
				data : ['.$popChamps[0]['winrate'].',
						'.$popChamps[1]['winrate'].',
						'.$popChamps[2]['winrate'].',
						'.$popChamps[3]['winrate'].',
						'.$popChamps[4]['winrate'].',
						'.$popChamps[5]['winrate'].',
						'.$popChamps[6]['winrate'].',
						'.$popChamps[7]['winrate'].',
						'.$popChamps[8]['winrate'].',
						'.$popChamps[9]['winrate'].',
						'.$popChamps[10]['winrate'].',
						'.$popChamps[11]['winrate'].',
						'.$popChamps[12]['winrate'].',
						'.$popChamps[13]['winrate'].',
						'.$popChamps[14]['winrate'].'
						]
				}
			]
		}
	
	';
	usort($popChamps, function($a, $b){
		return $b['pentas'] - $a['pentas'];
	});
	foreach($champdata as $each){
		if($each['id'] == $popChamps[0]['champId']){$c0 = $each['name'];}
		if($each['id'] == $popChamps[1]['champId']){$c1 = $each['name'];}
		if($each['id'] == $popChamps[2]['champId']){$c2 = $each['name'];}
		if($each['id'] == $popChamps[3]['champId']){$c3 = $each['name'];}
		if($each['id'] == $popChamps[4]['champId']){$c4 = $each['name'];}
		if($each['id'] == $popChamps[5]['champId']){$c5 = $each['name'];}
		if($each['id'] == $popChamps[6]['champId']){$c6 = $each['name'];}
		if($each['id'] == $popChamps[7]['champId']){$c7 = $each['name'];}
		if($each['id'] == $popChamps[8]['champId']){$c8 = $each['name'];}
		if($each['id'] == $popChamps[9]['champId']){$c9 = $each['name'];}
	}
	$script .= '
			var doughnut'.$i.' = [
			{
				segmentShowStroke : false,
				value: '.$popChamps[0]['pentas'].',
				color:"#F7464A",
				highlight: "#FF5A5E",
				label: "'.$c0.'"
			},
			{
				value: '.$popChamps[1]['pentas'].',
				color: "#46BFBD",
				highlight: "#5AD3D1",
				label: "'.$c1.'"
			},
			{
				value: '.$popChamps[2]['pentas'].',
				color: "#FDB45C",
				highlight: "#FFC870",
				label: "'.$c2.'"
			},
			{
				value: '.$popChamps[3]['pentas'].',
				color: "#767F8E",
				highlight: "#9199A5",
				label: "'.$c3.'"
			},
			{
				value: '.$popChamps[4]['pentas'].',
				color: "#8963AB",
				highlight: "#AA8FC2",
				label: "'.$c4.'"
			},
			{
				value: '.$popChamps[5]['pentas'].',
				color: "#51AA8D",
				highlight: "#78BEA8",
				label: "'.$c5.'"
			},
			{
				value: '.$popChamps[6]['pentas'].',
				color: "#E68A2E",
				highlight: "#EBA158",
				label: "'.$c6.'"
			},
			{
				value: '.$popChamps[7]['pentas'].',
				color: "#CFCF00",
				highlight: "#DDDD4D",
				label: "'.$c7.'"
			},
			{
				value: '.$popChamps[8]['pentas'].',
				color: "#00B8E6",
				highlight: "#7EDBF2",
				label: "'.$c8.'"
			},
			{
				value: '.$popChamps[9]['pentas'].',
				color: "#73767A",
				highlight: "#A5A8AF",
				label: "'.$c9.'"
			}

		];
	';


	$body .= '<div class="col-xs-12 dataBox">
				<div class="row"><span class="h center col-xs-12">'.strtoupper ($regions[$i]).'</span></div>
				<div class="row dataWrapper">
					
					<div class="row">
					<div class="col-lg-6 col-xs-12">
						<h4 class="panel-heading">Most picked</h4>
						<div class="panel-body">
							<div style="width: 100%;">
								<canvas id="barchart'.$i.'" height="300" width="600"></canvas>
							</div>
						</div>
					</div>
					
					<div class="col-lg-6 col-xs-12">
					<h4 class="panel-heading">  </h4>
						<div class="panel-body">
							<table class="table t">
								<thead>
								  <tr>
									<th></th>
									<th>Winrate</th>
									<th>Pentas</th>
									<th>Most bought items</th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
									'.$table1.'
								</tbody>
							  </table>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-lg-6 col-xs-12">
						<h4 class="panel-heading">Performance by Winrate</h4>
						<div class="panel-body">
							<div style="width: 100%;">
								<canvas id="bar'.$i.'" height="300" width="600"></canvas>
							</div>
						</div>
					</div>
					
					
					<div class="col-lg-6 col-xs-12">
						<h4 class="panel-heading"></h4>
						<div class="panel-body">
							<table class="table t">
								<thead>
								  <tr>
									<th></th>
									<th>Picked</th>
									<th>Pentas</th>
									<th>Most bought items</th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
								'.$table2.'
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-xs-1 col-lg-2"> </div>
					<div class="col-xs-10 col-lg-10">
					<h4 class="panel-heading">Most Pentakills</h4>
						<div class="panel-body">
							<div class="col-xs-4">
							<div style="width: 100%">
								<canvas id="dough'.$i.'" height="300"></canvas>
							</div>
							</div>
							<div class=col-xs-3">
							<div id="legendDiv'.$i.'" class="chart-legend"></div>
							</div>
						</div>
					</div>
					</div>
			</div>
			</div>';
	$popChamps = champions($regions[$i]);
	usort($popChamps, function($a, $b){
		return $b['played'] - $a['played'];
	});

	
	$onload .= '
					var ctx'.$i.' = document.getElementById("barchart'.$i.'").getContext("2d");
					window.myBar = new Chart(ctx'.$i.').Bar(barData'.$i.', {
					responsive : true, scaleFontColor: "#ffffff"
					});
					
				
				
					var bar'.$i.' = document.getElementById("bar'.$i.'").getContext("2d");
					window.myBar = new Chart(bar'.$i.').Bar(barData2'.$i.', {
					responsive : true, scaleFontColor: "#ffffff"
					});
					
					var dgn'.$i.' = document.getElementById("dough'.$i.'").getContext("2d");
					window.myDoughnut'.$i.' = new Chart(dgn'.$i.').Doughnut(doughnut'.$i.', {responsive : true, segmentShowStroke : true, segmentStrokeColor: "rgba(0, 0, 0, 0.5)" });
					document.getElementById("legendDiv'.$i.'").innerHTML = myDoughnut'.$i.'.generateLegend();
				';
	
	
}


?>
<!doctype html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This site is created in the scope of the Riot Games API Challenge and reflects statistics on a set amount of data that was gathered using the API provided by Riot Games">
    <meta name="author" content="EH">
	<link href="favicon.ico" type="image/x-icon" rel="icon" /><link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<title>BMB | Regions</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
	<link href='css/custom.css' rel='stylesheet' type='text/css'>
	<style type="text/css">
	

	</style>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
	
<body class="body">
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://ehco.planet.ee/BMB"><span id="h">Black Market Brawlers</span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="t" class="nav navbar-nav">
            <li class="active"><a href="http://ehco.planet.ee/BMB">Regions</a></li>
            <li><a href="http://ehco.planet.ee/BMB/champions.php">Champions</a></li>
			<li><a href="http://ehco.planet.ee/BMB/about.html" >About</a></li>
          </ul>
        </div>
      </div>
    </nav>


	<div id="pageWrapper" class="container">
		<?echo $body;?>
	</div>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script>
		<?
			echo $script;
		?>
	window.onload = function(){
		<?
			echo $onload;
		?>
	}
	</script>
</body>

</html>
