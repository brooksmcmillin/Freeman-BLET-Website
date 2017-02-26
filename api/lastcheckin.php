<?php

    date_default_timezone_set("America/Chicago");

    $server = "localhost";
    $database = "freeman";
    $username = "freeman";
    $password = "freemanhackdfw";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
    //    die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT beacon_id, device_name, MAX(date) FROM checkin GROUP BY beacon_id;";

    $jsonData = array();

    if ($response = $conn->query($query))
    {
     //   echo "Response is success<br>";
        while ($row = $response->fetch_row())
        {
            $beacon_id = $row[0];
            $device_name = $row[1];
            $box_data = "DATA_HERE";
            $date = $row[2];

            array_push($jsonData, array($beacon_id, $device_name, $box_data, $date));
        }
    }
    else
    {
        error_log("Error: " . $query . "<br>" . $conn->error);
       // echo "Error: " . $query . "<br>" . $conn->error;
    }

    echo '{ "data": ' . json_encode($jsonData) . '}';

    $conn->close();
