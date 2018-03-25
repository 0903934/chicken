<?php

//Establish connection using connection details maintained in a seperate php file-db.php
require($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//THERE IS NEED TO REPLACE THIS "DIRECTLY ENTERED" INPUT WITH CODE TO GET INPUTS FROM THE ADMIN PAGE WHEN A CAMERA IS ADDED.
//AN ADMIN SHOULD BE ABLE TO ADD A NEW CAMERA WITH DETAILS(CameraId-PRIMARY KEY, Location, IpAddress)
//Create an Insert prepared statement and run it
$camera_id= 500;
$location_name = 'KCC';
$ip_address = '182.168.1.124';

if ($stmt = mysqli_prepare($conn, "INSERT INTO  cameras (CameraId, Location, IpAddress) VALUES (?, ?, ?)")) {
    mysqli_stmt_bind_param($stmt, 'iss', $camera_id, $location_name, $ip_address);
    mysqli_stmt_execute($stmt);
    printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);

?>