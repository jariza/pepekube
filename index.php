<!DOCTYPE html>
<html>

<head>
	<title>Pepe house</title>
	<meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
	<h1>Pepe House</h1>
<?php
$data=(json_decode(file_get_contents("http://houseapi.default.svc.cluster.local:31500/weather"), true));
foreach ($data['wd'] as $element) {
	if ($element['name'] == 'Indoor') {
		if ((time() - $element['time_utc']) > 660) {$freshness = ' style="color: red"';} else {$freshness = '';}
		echo "\t<h2$freshness>Indoors</h2>\n\t<ul>\n";
		echo "\t\t<li$freshness>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "\t\t<li$freshness>Humidity: ".$element['humidity']."%</li>\n";
		echo "\t\t<li$freshness>Pressure: ".round($element['pressure'], 2)."mbar</li>\n";
		echo "\t\t<li$freshness>CO2: ".$element['co2']."ppm</li>\n";
		echo "\t\t<li$freshness>Noise: ".$element['noise']."dB</li>\n";
		echo "\t\t<li$freshness>Link status: ".$element['link_status']."%</li>\n";
		echo "\t\t<li id=\"time\"$freshness></li>\n";
		echo "\t</ul>\n";
		echo "\t<script>\n";
		echo "\t\tdtime = new Date(".date('\'M/j/Y G:i:s \U\T\C\'', $element['time_utc']).")\n";
		echo "\t\tdocument.getElementById('time').innerHTML = 'Time: ' + dtime.toString()\n";
		echo "\t</script>\n";
	}
	if ($element['name'] == 'Exterior') {
		if ((time() - $element['last_seen']) > 660) {$freshness = ' style="color: red"';} else {$freshness = '';}
		echo "\t<h2$freshness>Outdoors</h2>\n\t<ul>\n";
		echo "\t\t<li$freshness>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "\t\t<li$freshness>Humidity: ".$element['humidity']."%</li>\n";
		echo "\t\t<li$freshness>Link status: ".$element['link_status']."%</li>\n";
		echo "\t\t<li$freshness>Battery: ".$element['battery_percent']."%</li>\n";
		echo "\t\t<li id=\"lastseen\"$freshness></li>\n";
		echo "\t</ul>\n";
		echo "\t<script>\n";
		echo "\t\tdlastseen = new Date(".date('\'M/j/Y G:i:s \U\T\C\'', $element['last_seen']).")\n";
		echo "\t\tdocument.getElementById('lastseen').innerHTML = 'Time: ' + dlastseen.toString()\n";
		echo "\t</script>\n";
	}
}
?>
	<h2>Camera</h2>
	<div class="camera">
		<img id="traffic_camera" src='http://ctrafico.movilidad.malaga.eu/cst_ctrafico/camara1070.jpg' /><br />
		<a href="http://movilidad.malaga.eu/es/servicios/camaras-de-trafico/">Moar camera</a>
	</div>
	<script>
		function reloadImage() {
			document.getElementById("traffic_camera").src = 'http://ctrafico.movilidad.malaga.eu/cst_ctrafico/camara1070.jpg' + '?dummy='+(new Date()).getTime()
		}
		var camaraTimer=setInterval('reloadImage()',(5*1000));
	</script>

</body>
</html>
