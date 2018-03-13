<?php

/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 09-Mar-18
 * Time: 5:18 PM
 */

//THERE IS NEED TO REPLACE THIS PORTION WITH CODE FROM SERVER TO GIVE ACCESS TO DATABASE.
$host = '127.0.0.1';
$username = 'root';
$password = '';
$db_name = 'predatordetection';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
