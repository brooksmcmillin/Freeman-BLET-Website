<?php

    date_default_timezone_set("America/Chicago");

    $server = "localhost";
    $database = "freeman";
    $username = "freeman";
    $password = "freemanhackdfw";

    $beaconID = $_GET["beaconID"];

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
    //    die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * from checkin WHERE beacon_id = {$beaconID}";

    $jsonData = array();

    if ($response = $conn->query($query))
    {
     //   echo "Response is success<br>";
        while ($row = $response->fetch_row())
        {
            $id = $row[0];
            $beacon_id = $row[1];
            $device_name = $row[2];
            $date = $row[3];
            $latitude = $row[4];
            $longitude = $row[5];

            array_push($jsonData, array($beacon_id, $device_name,
                "<a href='http://maps.google.com/maps?q={$latitude},{$longitude}&ll={$latitude},{$longitude}&z=17'>(" . $latitude . ", " . $longitude . ")</a>",
                $date));
        }
    }
    else
    {
        error_log("Error: " . $query . "<br>" . $conn->error);
       // echo "Error: " . $query . "<br>" . $conn->error;
    }

    echo '{ "data": ' . json_encode($jsonData) . '}';

    $conn->close();
