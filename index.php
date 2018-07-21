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
		if ((time() - $element['time_utc']) > 600) {$freshness = ' style="color: red"';} else {$freshness = '';}
		echo "<h2$freshness>Indoors</h2>\n<ul>\n";
		echo "<li$freshness>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "<li$freshness>Humidity: ".$element['humidity']."%</li>\n";
		echo "<li$freshness>Pressure: ".round($element['pressure'], 2)."mbar</li>\n";
		echo "<li$freshness>CO2: ".$element['co2']."ppm</li>\n";
		echo "<li$freshness>Noise: ".$element['noise']."dB</li>\n";
		echo "<li$freshness>Link status: ".$element['link_status']."%</li>\n";
		echo "<li$freshness>Time: ".date('H:i:s, j/M/Y', $element['time_utc'])."</li>\n";
		echo "</ul>\n";
	}
	if ($element['name'] == 'Exterior') {
		if ((time() - $element['last_seen']) > 600) {$freshness = ' style="color: red"';} else {$freshness = '';}
		echo "<h2$freshness>Outdoors</h2>\n<ul>\n";
		echo "<li$freshness>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "<li$freshness>Humidity: ".$element['humidity']."%</li>\n";
		echo "<li$freshness>Link status: ".$element['link_status']."%</li>\n";
		echo "<li$freshness>Battery: ".$element['battery_percent']."%</li>\n";
		echo "<li$freshness>Last seen: ".date('H:i:s, j/M/Y', $element['last_seen'])."</li>\n";
		echo "</ul>\n";
	}
}
?>
</html>
</body>
