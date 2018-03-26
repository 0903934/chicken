<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 26/03/18
 * Time: 17:09
 *
 * Very simple API interface to collect data from the remote node
 */

//include_once "../backend/resources/db.php";

// set header content type to be JSON
//header('Content-Type: application/json; charset=utf-8');

http_response_code(200);
print_r($_POST);
exit(0);

// get the method of the request (GET / POST etc.)
//$method = $_SERVER['REQUEST_METHOD'];

//
//if  ($method == 'POST') {
//    // post data to db; not going to authenticate yet. need to add strip tags and mysql security
//    // get the data from the post data
//    exit(0);
//    if (isset($_POST['CameraId'])) {
//        $camera_id = $_REQUEST["CameraId"];
//        $predator_name = $_REQUEST["PredatorName"];
//        $detection_accuracy = $_REQUEST["DetectionAccuracy"];
//        $predator_image_link = $_REQUEST["PredatorImage"];
//        $detection_time = $_REQUEST["DetectionTime"];
//
//        if ($stmt = mysqli_prepare($conn, "INSERT INTO  detectionreport (CameraId, PredatorName, DetectionAccuracy, PredatorImage, DetectionTime) VALUES (?, ?, ?, ?, ?)")) {
//            mysqli_stmt_bind_param($stmt, 'isiss', $camera_id, $predator_name, $detection_accuracy, $predator_image_link, $detection_time);
//            if ($stmt->execute()) {
//                // sql executed successfully
//                // return good
//                http_response_code(200);
//                echo '{"data": {"Success": "Data Sent"}, "echo": %d}', json_encode($_REQUEST);
//                // Close the connection
//                mysqli_close($conn);
//                exit(0);
//            } else {
//                // DB insert failed; retunr error
//                http_response_code(500);
//                echo '{"data": {"error": "Data entry failed"}}';
//                // Close the connection
//                mysqli_close($conn);
//                exit(0);
//            }
//        }
//    } else {
//        // DB insert failed; retunr error
//        http_response_code(500);
//        echo '{"data": {"error": "Data entry failed; CameraId missing"}}';
//        // Close the connection
//        mysqli_close($conn);
//        exit(0);
//    }
//} else {
//    // reply 404 for GETs currently
//    http_response_code(404);
//    echo '{"data": {"error": "Content not Found"}}';
//    exit(0);
//}