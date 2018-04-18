<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 18/04/18
 * Time: 13:18
 *
 * used to test JWT functionality
 */

// import everything for jwt
require_once 'php-jwt/src/BeforeValidException.php';
require_once 'php-jwt/src/ExpiredException.php';
require_once 'php-jwt/src/SignatureInvalidException.php';
require_once 'php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

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
                http_response_code(200);
                echo '{"data": {"Success": "Token Good"}}';
                exit(0);
            } catch (\Firebase\JWT\ExpiredException $e) {
                http_response_code(401);
                echo '{"data": {"error": "Token Expired", "message": "' . $e->getMessage() . '" }}';
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