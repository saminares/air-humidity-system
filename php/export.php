<?php
$servername = "127.0.0.1";
$username = "root";
$password = "mysql";
$dbname = "thingsee";
$humidity = Array();
$type = $_GET['type'];
$sql_add = 'Kuvaus = \'';
switch ($type) {
    case 'temp':
        $sql_add = $sql_add.'Temperature\'';
        break;
    case 'hum':
        $sql_add = $sql_add.'Humidity\'';
        break;
    case 'press':
        $sql_add = $sql_add.'Pressure\'';
        break;
    case 'lum':
        $sql_add = $sql_add.'Luminance\'';
        break;
    case '':
        $sql_add = $sql_add.'Temperature\'';
        break;
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM ts_events where ".$sql_add." ORDER BY timestamp DESC LIMIT 25";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $value=$row['value'];
        $timestamp=$row['timestamp']; 
        array_unshift($humidity, array($timestamp, $value));
    }
} else {
    echo "[]";
}
//Echo json encoded temparature data for chart.js
echo json_encode($humidity);
$conn->close();


?>






