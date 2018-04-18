<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/sessions.php");


// get the method of the request (GET / POST etc.)
$method = $_SERVER['REQUEST_METHOD'];

?>

<?php

    global $conn;

    $table = 'detectionreport';
    $primaryKey = 'id';

    $viewReport = "SELECT * FROM detectionreport ORDER BY id  DESC";
    $result = mysqli_query($conn, $viewReport);
    $columns = array();

    $columns = array(
        array('db' => 'id', 'dt' => 'id'),
        array('db' => 'CameraId', 'dt' => 'CameraId'),
        array('db' => 'PredatorName', 'dt' => 'PredatorName'),
        array('db' => 'DetectionAccuracy', 'dt' => 'DetectionAccuracy'),
        array('db' => 'PredatorImage', 'dt' => 'PredatorImage'),
        array('db' => 'DetectionTime', 'dt' => 'DetectionTime')
    );




    //Getting database details for Azure to be sent along with the json file.
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
        $AZusername = $connectstr_dbusername;
        $AZpassword = $connectstr_dbpassword;
        $AZhostname = $connectstr_dbhost;
        $AZdbname = $connectstr_dbname;

        $sql_details = array(
            'user' => $AZusername,
            'pass' => $AZpassword,
            'db' => $db_name,
            'host' => $AZhostname
        );

    require('../backend/resources/ssp.class.php');

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
