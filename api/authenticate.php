<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 17/04/18
 * Time: 20:47
 *
 * Authenticate to the API initially with authentication header. If authenticated successfully, this will return
 * a JWT token
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
    // validate the auth header
    // user needs to log in, check for basic auth in request header
    if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW'])){
        // basic auth is set in header, check the credentials

        $is_logged_in = checkLoginApi($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

        if ($is_logged_in != true){
            // not logged in, return
            // set the response code from the returned array and set the data
            http_response_code(401);
            echo '{"data": {"error": "Authentication failed"}}';
            exit(0);
        } else {
            // log in good. Generate JWT and send to client
            http_response_code(200);
            $jwt = generateJWT($user_name);
            echo '{"data": {"login": "Authentication good", "Token": "' . $jwt . '"}}';
            exit(0);
        }
    } else {
        // auth header not set; return unauthorised
        // set the response code from the returned array and set the data
        http_response_code(401);
        echo '{"data": {"error": "Auth header details not supplied"}}';
        exit(0);
    }
} else {
    // reply 404 for GETs currently
    http_response_code(405);
    echo '{"data": {"error": "Method not allowed"}}';
    exit(0);
}

function checkLoginApi($user, $password){
    //Contains Database connection info.
    require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

    // removes backslashes
    $user_name = stripslashes($user);
    $user_name = mysqli_real_escape_string($conn, $user_name);
    $user_password = stripslashes($password);
    $user_password = mysqli_real_escape_string($conn, $user_password);
    //Checking if user is existing in the database or not.
    $query = "SELECT * FROM `users` WHERE UserName='$user_name'";
    $result = mysqli_query($conn,$query);
    $numRows = mysqli_num_rows($result);

    if($numRows==1){
        //Set-up an array to represent the row that is returned.
        $row = mysqli_fetch_assoc($result);
        //Get the column corresponding to the password of the user. This gets and stores the hashed password.
        $HashedPassword = $row['Password'];

        //Do verification here.
        if(password_verify($user_password, $HashedPassword)){
            // log in good. return true
            return true;
        }else{
            // log in failed. return false
            return false;
        }
    }else{
        // user not found. return false
        return false;
    }
}

function generateJWT($user_name){

    // get the timne now to add to the token
    $time_now = time();
    // hard code the secret key for now
    $key = "example_key";
    // define token data
    $token = array(
        "iss" => "https://foxysnap.azurewebsites.net", // server name for who issued the token
        "iat" => $time_now, // time issued at
        "nbf" => $time_now, // time not before
        "exp" => $time_now  + 60, // token expires now plus 1 minute
        "data" => ["user_name" => $user_name] // add user name so we can identify
    );

    // encode the token
    $jwt = JWT::encode($token, $key, 'HS256');
    // decoded is an array
    // $decoded = JWT::decode($jwt, $key, array('HS256'));
    //print_r($decoded);

    // return the token
    return $jwt;
}