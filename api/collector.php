<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 26/03/18
 * Time: 17:09
 *
 * Very simple API interface to collect data from the remote node
 */

// import everything for jwt
require_once 'php-jwt/src/BeforeValidException.php';
require_once 'php-jwt/src/ExpiredException.php';
require_once 'php-jwt/src/SignatureInvalidException.php';
require_once 'php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

// include DB stuff
include_once "../backend/resources/db.php";

// set header content type to be JSON
header('Content-Type: application/json; charset=utf-8');


// get the method of the request (GET / POST etc.)
$method = $_SERVER['REQUEST_METHOD'];

if  ($method == 'POST') {
    // hard code the secret key for now
    $key = "secret_key";

    // get the headers form the request
    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            try {
                $decoded = JWT::decode($matches[1], $key, array('HS256'));

                // token is valid
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
                            echo '{"data": {"Success": "Data Sent", "echo":{"CameraId":' . $camera_id . ' , "PredatorName":"' . $predator_name . '", "DetectionAccuracy":' . $detection_accuracy . ', "PredatorImage":"' . $predator_image_link . '"}}}';
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
                    echo '{"data": {"error": "Data entry failed; Required fields missing"}}';
                    exit(0);
                }
            } catch (\Firebase\JWT\ExpiredException $e) {
                http_response_code(401);
                echo '{"data": {"error": "Token Expired", "message": "' . $e->getMessage() . '" }}';
                exit(0);
            } catch (\Firebase\JWT\SignatureInvalidException $e) {
                http_response_code(401);
                echo '{"data": {"error": "Token Not Valid", "message": "' . $e->getMessage() . '" }}';
                exit(0);
            } catch (Exception $e) {
                http_response_code(500);
                echo '{"data": {"error": "Error", "message": "' . $e->getMessage() . '" }}';
                exit(0);
            }
        } else {
            http_response_code(401);
            echo '{"data": {"error": "Bearer Token Not Found"}}';
            exit(0);
        }
    } else {
        http_response_code(401);
        echo '{"data": {"error": "No auth token found"}}';
        exit(0);
    }
} else {
    // reply 404 for GETs currently
    http_response_code(405);
    echo '{"data": {"error": "Method not allowed"}}';
    exit(0);
}