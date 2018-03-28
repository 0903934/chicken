<?php
/**
 * Created by PhpStorm.
 * User: 1611866
 * Date: 28/03/2018
 * Time: 14:54
 *
 * Used for uploading images to the collector. uses form data for the image type
 */

include_once "../backend/resources/FileUpload.php";

// get the method of the request (GET / POST etc.)
$method = $_SERVER['REQUEST_METHOD'];

if  ($method == 'POST') {
    // not going to authenticate yet. need to add strip tags and mysql security
    // TODO: secure API
    if (isset($_POST['image'])){
        $target_directory = "uploaded_images/";
        $upload_result = fileUpload($target_directory);
        // check the result of the upload
        if ($upload_result['uploadOk'] == false){
            // something went wrong, retunr the error
            http_response_code(500);
            echo '{"data": {"error": "Image upload failed: ' . $upload_result['error'] . '"}}';
            exit(0);
        }
    } else {
        // DB insert failed; retunr error
        http_response_code(500);
        echo '{"data": {"error": "Data entry failed; Required fields missing. sent' . print_r($_POST) . '"}}';
        exit(0);
    }
} else {
    // reply 404 for GETs currently
    http_response_code(404);
    echo '{"data": {"error": "Content not Found"}}';
    exit(0);
}

