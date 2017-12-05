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
		echo "<h2>Indoors</h2>\n<ul>\n";
		echo "<li>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "<li>Humidity: ".$element['humidity']."%</li>\n";
		echo "<li>Pressure: ".round($element['pressure'], 2)."mbar</li>\n";
		echo "<li>CO2: ".$element['co2']."ppm</li>\n";
		echo "<li>Noise: ".$element['noise']."dB</li>\n";
		echo "<li>Link status: ".$element['link_status']."%</li>\n";
		echo "</ul>\n";
	}
	if ($element['name'] == 'Exterior') {
		echo "<h2>Outdoors</h2>\n<ul>\n";
		echo "<li>Temperature: ".round($element['temperature'], 2)."ºC</li>\n";
		echo "<li>Humidity: ".$element['humidity']."%</li>\n";
		echo "<li>Link status: ".$element['link_status']."%</li>\n";
		echo "<li>Battery: ".$element['battery_percent']."%</li>\n";
		echo "</ul>\n";
	}
}
?>
</html>
</body>
