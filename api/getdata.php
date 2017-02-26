<?php

date_default_timezone_set("America/Chicago");

$server = "localhost";
$database = "freeman";
$username = "freeman";
$password = "freemanhackdfw";

$beaconID = $_POST["beaconID"];

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    //    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM beacon WHERE beacon_id = {$beaconID};";

$jsonData = array();

if ($response = $conn->query($query))
{
    //   echo "Response is success<br>";
    while ($row = $response->fetch_row())
    {

        array_push($jsonData, $row);
    }
}
else
{
    error_log("Error: " . $query . "<br>" . $conn->error);
    // echo "Error: " . $query . "<br>" . $conn->error;
}

echo '{ "data": ' . json_encode($jsonData) . '}';

$conn->close();
