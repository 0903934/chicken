<?php

/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 09-Mar-18
 * Time: 5:18 PM
 */

//THERE IS NEED TO REPLACE THIS PORTION WITH CODE FROM SERVER TO GIVE ACCESS TO DATABASE.
//$host = '127.0.0.1';
//$username = 'root';
//$password = '';
$db_name = 'predatordetection';

//Establishes the connection
//$conn = mysqli_init();
//mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
//if (mysqli_connect_errno($conn)) {
//    die('Failed to connect to MySQL: '.mysqli_connect_error());
//}

/**
 * Created by PhpStorm.
 * User: 1611866
 * Date: 07/03/2017
 * Time: 15:50
 *
 * Azure db connection script
 */
/** Method for connecting the the Database. returns the connection if successful or false if not
 * @return bool|mysqli: returns the DB link if successful of false if not
 */
//function dbConnect()
//{
    $connectstr_dbhost = '';
    $connectstr_dbname = '';
    $connectstr_dbusername = '';
    $connectstr_dbpassword = '';
    foreach ($_SERVER as $key => $value) {
        if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
            continue;
        }
        $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
        $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
        $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
        $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
    }
    //$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname);
    //$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, 'predatordetection');

    //Establishes the connection
    $conn = mysqli_init();
    mysqli_real_connect($conn, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $db_name, 3306); 
    if (mysqli_connect_errno($conn)) {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
    
    //if (!$link) {
        // return boolean false for the failed connection
    //    return false;
    //}
    // return the DB connection
    //return $link;
//}
