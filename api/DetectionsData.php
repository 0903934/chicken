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

    $viewReport = "SELECT * FROM detectionreport ORDER BY DetectionTime DESC ";
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


    $sql_details = array(
        'user' => 'root',
        'pass' => '',
        'db' => 'predatordetection',
        'host' => '127.0.0.1'
    );

    require('../backend/resources/ssp.class.php');

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
