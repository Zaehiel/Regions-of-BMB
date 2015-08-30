<?php
error_reporting(E_ALL);
require_once('data/api.php');
require_once('data.php');
$regions = ['euw', 'na', 'eune'];
$champdata = json_decode(file_get_contents('data/champdata.json'),true);
usort($champdata, function($a, $b){
	return strcmp($a['name'], $b['name']);
});
$body = "";
$index = "";
$champId = "";
$region = "";
$items = "";
$item = "";
$valid = false;
$stack = count($champdata);
$stack2 = count($regions);
$champion = array();
if(isset($_GET['id'])){
	$get = $_GET['id'];
	for($i=0;$i<$stack;$i++){
		if($champdata[$i]['id'] == $get){
			$valid = true;
			$index = $i;
			$champId = $champdata[$i]['id'];
		}
	}
}

if($valid){
	/*echo champion data contents*/
	for($y=0;$y<$stack2;$y++){
		
		$champ = champions($regions[$y]);
		foreach($champ as $each){
			if($each['champId'] == $champId){
				array_push($champion, $each);
				break;
			}
		}
	}
	for($z=0;$z<$stack2;$z++){
		$items = champItems2($regions[$z], $champId);
		$region .= '
			<tr>
				<td>'.strtoupper($regions[$z]).'</td>
				<td>'.$champion[$z]['played'].'</td>
				<td>'.$champion[$z]['winrate'].' %</td>
				<td>'.$champion[$z]['pentas'].'</td>
				<td>'.$champion[$z]['kills'].'</td>
				<td>'.$champion[$z]['deaths'].'</td>
				<td>'.$champion[$z]['kd'].'</td>
				<td>'.number_format($champion[$z]['gold']/$champion[$z]['played'],0).'</td>
			</tr>
		';
		
		$item .= '
			<div class="col-xs-4">
				<table class="table t col-xs-8">
				<thead>
				  <tr>
					<th>'.strtoupper($regions[$z]).'</th>
					<th>Bought</th>
					<th>Winrate</th>
				  </tr>
				</thead>
				<tbody>
			';
		$c=0;
		$k=0;
		/*if contains basically all the boots/trinkets and anything else that's not a full complete item, it's not really nice looking, but I got no time wait and fetch items from the api and do it better T_T rip in pepperonis*/
		while($c<10){
			$name = $items['items'][$k]['name'];
			if($name != 1054 && $name != 1056 && $name != 1055 && $name != 1324 && $name != 1319 && $name != 1329 && $name != 1316 && $name != 1334 && $name != 1309 && $name != 1321 && $name != 1334 && $name != 1304 
				&& $name != 1324 && $name != 1053 && $name !=1038 && $name !=1037 && $name !=2003 && $name !=3086 && $name !=1042 && $name !=1018 && $name !=2004 
				&& $name !=1036 && $name !=3093 && $name !=1051 && $name !=1031 && $name !=3144 && $name !=1043 && $name !=1011 && $name !=1029 
				&& $name !=3044 && $name !=3134 && $name !=3070 && $name !=3110 && $name !=2041 && $name !=3057 && $name !=1001 && $name !=1314 && $name !=1311 && $name !=1026 && $name !=1027 && $name !=1058&& $name !=1052
				&& $name !=3136 && $name !=2044 && $name !=3340 && $name !=3361 && $name !=3362 && $name !=3342 && $name !=3341 && $name !=3364 && $name !=3363
				&& $name !=3211
				&& $name !=3111 && $name !=3047 && $name !=3009 && $name !=3117 && $name !=3158 && $name !=3006 && $name !=3020 && $name !=1300
				&& $name !=3097 && $name !=1028 && $name !=3303 && $name !=3097 && $name !=2045 && $name !=3113 && $name !=3067 && $name !=3155 && $name !=3077
				&& $name !=3082 && $name !=3098 && $name !=2010 && $name !=3108 && $name !=3801 && $name !=3024 && $name !=3433 && $name !=2043 && $name !=1301
				&& $name !=3085){
				$item .= '
				<tr>
					<td><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/item/'.$name.'.png" alt="" style="width:30px;"></td>
					<td>'.number_format(($items['items'][$k]['count']/$champion[$z]['played'])*100, 1) .' %</td>
					<td>'.$items['items'][$k]['winrate'].' %</td>
				</tr>
				';
				$c++;
			}
			$k++;
		}

		$item .= '
			</tbody>
			</table>
		</div>';
		
	}
	
	$body .= '
		<div class="row">
			<div class="col-xs-11 dataBox dataWrapper">
				<div class="col-lg-5 col-xs-12">
					<img class="sqBorder mrg" src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$champdata[$index]['key'].'.png" alt="" />
					<h1>'.$champdata[$index]['name'].'</h1>
					<h4>'.$champdata[$index]['title'].'</h4>
				</div>
				<div class="col-lg-7 col-xs-12">
				<table class="table t">
				<thead>
				  <tr>
					<th>Region</th>
					<th>Picked</th>
					<th>Winrate</th>
					<th>Pentas</th>
					<th>Kills</th>
					<th>Deaths</th>
					<th>K/D</th>
					<th>Avg gold</th>
				  </tr>
				</thead>
				<tbody>
		';
	$body .= $region;	
	$body.= '</tbody>
		</table>
		</div>
				
				
			</div>
		</div>
		<div class="row">
		<div class="col-xs-11 dataBox dataWrapper">
		
	';
		$body .= '<div class="col-xs-12"><h4>Top items based on purchase popularity, excluding boots and trinkets</h4></div>';
		$body .= $item;
	$body .=	'
			</div>
		';
} elseif(!$valid){
	/*echo champion list*/
	for($x=0;$x<$stack;$x++){
		$body .= '
			<li class="champSq">
				<a href="http://ehco.planet.ee/BMB/champions.php?id='.$champdata[$x]['id'].'"><img src="http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/'.$champdata[$x]['key'].'.png" alt="" /></a>
			</li>
		';
	}
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
	<title>BMB | Champions</title>
	
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
            <li><a href="http://ehco.planet.ee/BMB">Regions</a></li>
            <li class="active"><a href="http://ehco.planet.ee/BMB/champions.php">Champions</a></li>
			<li><a href="http://ehco.planet.ee/BMB/about.html" >About</a></li>
            
          </ul>
        </div>
      </div>
    </nav>


	<div id="pageWrapper" class="container" style="padding-bottom:20px;">
		<ul class="champSqHolder">
		<?echo $body;?>
		</ul>
	</div>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script>

	</script>
</body>

</html>
