<?php
//Resets water level counter
function runMyFunction() {
	$humidity = $_POST['newhum'];
	file_put_contents('humiditylevel.txt', $humidity);
	echo "Humidity level set to ".$humidity;



}

runMyFunction();
?>
</br>
<a href="../index.php"> Go back </a> 