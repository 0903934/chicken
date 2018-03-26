<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 26/03/18
 * Time: 17:09
 *
 * Very simple API interface to collect data from the remote node
 */

include_once "../backend/resources/db.php";

// set header content type to be JSON
header('Content-Type: application/json; charset=utf-8');

// get the method of the request (GET / POST etc.)
$method = $_SERVER['REQUEST_METHOD'];

if  ($method == 'POST') {
    // post data to db; not going to authenticate yet. need to add strip tags and mysql security
    // get the data from the post data
    $camera_id = $_POST["CameraId"];
    $predator_name = $_POST["PredatorName"];
    $detection_accuracy = $_POST["DetectionAccuracy"];
    $predator_image_link = $_POST["PredatorImage"];
    $detection_time = $_POST["DetectionTime"];

    if ($stmt = mysqli_prepare($conn, "INSERT INTO  detectionreport (CameraId, PredatorName, DetectionAccuracy, PredatorImage, DetectionTime) VALUES (?, ?, ?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt, 'isiss', $camera_id, $predator_name, $detection_accuracy, $predator_image_link, $detection_time);
        mysqli_stmt_execute($stmt);
        printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
        mysqli_stmt_close($stmt);
    }
    // Close the connection
    mysqli_close($conn);
    // return good
    http_response_code(200);
    echo '{"data": {"Success": "Data Sent"}}';
    exit(0);
} else {
    // reply 404 for GETs currently
    http_response_code(404);
    echo '{"data": {"error": "Content not Found"}}';
    exit(0);
}