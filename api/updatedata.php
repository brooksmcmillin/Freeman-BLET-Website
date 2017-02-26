<?php
	date_default_timezone_set("America/Chicago");
	
	$server = "localhost";
	$database = "freeman";
	$username = "freeman";
	$password = "freemanhackdfw";


	$beaconID = $_POST["beaconID"];
	$contents = $_POST["contents"];
	$location = $_POST["location"];
	$latitude = $_POST["latitude"];
	$longitude = $_POST["longitude"];

	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error) {	
	    error_log("Connection failed: " . $conn->connect_error);
	    die("Connection failed: " . $conn->connect_error);
	} 
	
//	$deviceName = $conn->real_escape_string($_POST["deviceName"]);

	$query = "UPDATE beacon SET box_contents = '{$contents}', box_location = '{$location}', latitude={$latitude}, longitude={$longitude} WHERE beacon_id = {$beaconID}";

	if ($conn->query($query) === TRUE) {
    		error_log( "New record created successfully");
    		echo "New record created successfully";
	} else {
    		error_log("Error: " . $query . "<br>" . $conn->error);
    		echo "Error: " . $query . "<br>" . $conn->error;
	}

	$conn->close();
	


?>
