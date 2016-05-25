<html>
<head>
<title>ThingseeApp</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/chart.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<h1>Air Humidity Control</h1>
<h2> Latest Value </h2>
<div id="hum_div"></div>
<h2>Water tank level at 

<?php
//Displays the amount of remaining water as a percentage
$amountLeft =  filesize("php/waterlevel.txt");
$percentage = round((1-$amountLeft /26) * 100,2);
echo $percentage."%";
?>

<button><a href='php/reset.php' style="text-decoration:none"> Reset counter</a></button>
</h2>
<h2>Measurements from the last 24 hours </h2>
<div id="averagehum"> </div>
<div id="chart_div2" ></div>



<h2> Set desired humidity </h2>
<form action="php/sethumidity.php" method="post">
<input type="range" type="submit" name="newhum" min="25" max="60" value="0" step="1" onchange="showValue(this.value)" />
<span id="range">25</span>
<script type="text/javascript">
function showValue(newValue)
{
  document.getElementById("range").innerHTML=newValue;
}
</script>
<input type="submit" value="Submit">
</form>
</body>
</html>
