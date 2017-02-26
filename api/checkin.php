<?php
	date_default_timezone_set("America/Chicago");
	
	$server = "localhost";
	$database = "freeman";
	$username = "freeman";
	$password = "freemanhackdfw";


	$deviceName = $_POST["deviceName"];
	$beaconID = $_POST["beaconID"];

	echo $deviceName;

	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error) {	
	    error_log("Connection failed: " . $conn->connect_error);
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$deviceName = $conn->real_escape_string($_POST["deviceName"]);

	$query = "INSERT INTO checkin (beacon_id, device_name, date) VALUES ($beaconID, '$deviceName', now());";

	if ($conn->query($query) === TRUE) {
    		error_log( "New record created successfully");
    		echo "New record created successfully";
	} else {
    		error_log("Error: " . $query . "<br>" . $conn->error);
    		echo "Error: " . $query . "<br>" . $conn->error;
	}

	$conn->close();
	


?>
