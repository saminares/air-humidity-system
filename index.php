<html>
<head>
<title>ThingseeApp</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script language="JavaScript" src="scriptcam/scriptcam.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="chart.js"></script>
</head>
<body>
<h1>Humidity Monitor</h1>
<h2> Latest Value </h2>

  <div id="hum_div"></div>

<?php

  //Resets water level counter
  function runMyFunction() {
    
    $file = 'waterlevel.txt';
    $current = file_get_contents('waterlevel.txt', true);
    $current = "";
    file_put_contents($file, $current);
    echo "clear";
  }
  if (isset($_GET['hello'])) {
    runMyFunction();
  }

?>

<h2>Water tank level at 

<?php

//Displays the amount of remaining water as a percentage
$current = file_get_contents('waterlevel.txt', true); 
$amountLeft =  filesize("waterlevel.txt");
$percentage = round((1-$amountLeft /26) * 100,2);
echo $percentage."%";

?>
  </h2>
Reset: <button><a href='index.php?hello=true' style="text-decoration:none">
Tank Refilled!
              </a>
      </button>
</br>
</br>
</br>
<h2>Measurements from the last 24 hours </h2>
<div id="chart_div2"></div>
</body>
</html>
