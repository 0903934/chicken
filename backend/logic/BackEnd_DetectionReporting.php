<?php

//Establish connection using connection details maintained in a seperate php file-db.php
require('db.php');

//THE DETECTION SYSTEM WILL BE COMMUNICATING TO THE CAMERA REPORT TABLE THROUGH THIS CODE.
//CAMERA_ID IS A FOREIGN KEY ON THIS TABLE SO IF THE CAMERA_ID DOES NOT EXIST IN THE cameras TABLE IT WILL NOT INSERT.
//Create an Insert prepared statement and run it
$camera_id= 200;
$predator_name = 'temporary';
$detection_accuracy = 90;
$predator_image_link = 'www.myimagelink.com';
$detection_time = '2018-03-10 12:05:0';

if ($stmt = mysqli_prepare($conn, "INSERT INTO  detectionreport (CameraId, PredatorName, DetectionAccuracy, PredatorImage, DetectionTime) VALUES (?, ?, ?, ?, ?)")) {
    mysqli_stmt_bind_param($stmt, 'isiss', $camera_id, $predator_name, $detection_accuracy, $predator_image_link, $detection_time);
    mysqli_stmt_execute($stmt);
    printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);

?>