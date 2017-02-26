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

    $query = "SELECT * FROM beacon ORDER BY beacon_id;";

    $jsonData = array();

    if ($response = $conn->query($query))
    {
     //   echo "Response is success<br>";
        while ($row = $response->fetch_row())
        {
            $id = $row[0];
            $beacon_id = $row[1];
            $box_contents = $row[2];
            $box_location = $row[3];
            $latitude = $row[4];
            $longitude = $row[5];

            array_push($jsonData, array($beacon_id, $box_contents, $box_location,
                "<a href='http://maps.google.com/maps?q={$latitude},{$longitude}&ll={$latitude},{$longitude}&z=17'>(" . $latitude . ", " . $longitude . ")</a>"));
        }
    }
    else
    {
        error_log("Error: " . $query . "<br>" . $conn->error);
       // echo "Error: " . $query . "<br>" . $conn->error;
    }

    echo '{ "data": ' . json_encode($jsonData) . '}';

    $conn->close();
