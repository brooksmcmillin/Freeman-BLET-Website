<?php
	date_default_timezone_set("America/Chicago");
	
	$server = "localhost";
	$database = "freeman";
	$username = "freeman";
	$password = "freemanhackdfw";


	$deviceName = $_POST["deviceName"];
	$beaconID = $_POST["beaconID"];
	$latitude = $_POST["latitude"];
	$longitude = $_POST["longitude"];

	echo $deviceName;

	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error) {	
	    error_log("Connection failed: " . $conn->connect_error);
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$deviceName = $conn->real_escape_string($_POST["deviceName"]);

	$query = "INSERT INTO checkin (beacon_id, device_name, latitude, longitude, date) VALUES ($beaconID, '$deviceName', {$latitude}, {$longitude}, CONVERT_TZ(NOW(), '+00:00','-06:00'));";

	if ($conn->query($query) === TRUE) {
    		error_log( "New record created successfully");
    		echo "New record created successfully";
	} else {
    		error_log("Error: " . $query . "<br>" . $conn->error);
    		echo "Error: " . $query . "<br>" . $conn->error;
	}

	$conn->close();
	


?>
