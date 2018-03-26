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

    //Attempt to decode the incoming RAW post data from JSON.
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);

    if (isset($_POST['CameraId'])) {
        $camera_id_raw = $_POST['CameraId'];
        $camera_id = (int)$camera_id_raw;
        $predator_name = $_POST['PredatorName'];
        $detection_accuracy_raw = $_POST['DetectionAccuracy'];
        $detection_accuracy = $detection_accuracy_raw;
        $predator_image_link = $_POST['PredatorImage'];
        $detection_time = $_POST['DetectionTime'];
        // convert to datetime object
        $detection_time = date("Y-m-d H:i:s", strtotime($detection_time));

        if ($stmt = $conn->prepare("INSERT INTO  detectionreport (CameraId, PredatorName, DetectionAccuracy, PredatorImage, DetectionTime) VALUES (?, ?, ?, ?, ?)")) {
            $stmt->bind_param("isiss", $camera_id, $predator_name, $detection_accuracy, $predator_image_link, $detection_time);
            if ($stmt->execute()) {
                // sql executed successfully
                // return good
                http_response_code(200);
                echo '{"data": {"Success": "Data Sent"}, "echo":"' . print_r($_POST) . '"}';
                // Close the connection
                mysqli_close($conn);
                exit(0);
            } else {
                // DB insert failed; return error
                http_response_code(500);
                echo '{"data": {"error": "Data entry failed: ' . $stmt->error . '", "CameraId":' . $camera_id . ' , "PredatorName":"' . $predator_name . '", "DetectionAccuracy":' . $detection_accuracy . ', "PredatorImage":"' . $predator_image_link . '"}}';
                // Close the connection
                mysqli_close($conn);
                exit(0);
            }
        } else {
            // db entry failed
            http_response_code(500);
            echo '{"data": {"error": ' . $stmt->error . ' }}';
            // Close the connection
            mysqli_close($conn);
            exit(0);
        }
    } else {
        // DB insert failed; retunr error
        http_response_code(500);
        echo '{"data": {"error": "Data entry failed; CameraId missing"}}';
        // Close the connection
        mysqli_close($conn);
        exit(0);
    }
} else {
    // reply 404 for GETs currently
    http_response_code(404);
    echo '{"data": {"error": "Content not Found"}}';
    exit(0);
}