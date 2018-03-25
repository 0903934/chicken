<?php

/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 09-Mar-18
 * Time: 5:18 PM
 */

// set db mane
$db_name = 'predatordetection';

// set empty variables for the connection
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

// get log in details from azure
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $db_name, 3306); 
if (mysqli_connect_errno($conn)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
