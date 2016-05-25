<?php
  //Resets water level counter
  function runMyFunction() {
    $file = 'waterlevel.txt';
    $current = "";
    file_put_contents($file, $current);
  }
  runMyFunction();
?>
<p> Watertank refilled!</p>
<a href="../index.php"> Go back </a> 