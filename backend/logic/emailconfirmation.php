<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/sessions.php");


/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 07-Apr-18
 * Time: 3:41 PM
 */

if(!isset($_REQUEST['email'])|| !isset($_REQUEST['token'])){
    Redirect_to('../../register.html');
    exit();
}
else{
    global $conn;

    $Email = stripslashes($_REQUEST['email']);
    //NB, that if no conn is open, mysqli_real_escape_string() will return an empty string!.Triggering Validation 1
    $Email = mysqli_real_escape_string($conn, $Email);

    $token = stripslashes($_REQUEST['token']);
    //NB, that if no conn is open, mysqli_real_escape_string() will return an empty string!.Triggering Validation 1
    $token = mysqli_real_escape_string($conn, $token);

    $Query="SELECT Email FROM users WHERE Email = '$Email' AND token='$token'";
    $result= mysqli_query($conn, $Query);
    if($DataRow=mysqli_fetch_assoc($result)){
            $AccountToActivate = $DataRow['Email'];
            $UpdateQuery="UPDATE users SET emailactivation='1', token='' WHERE Email= '$AccountToActivate'";
            $UpdateResult= mysqli_query($conn, $UpdateQuery);
            echo "<div class='form'>
            <h3>Your email has been verified. You can login now. </h3>
            <a class='button' href='../../login.html'>  Login.</a>
            </div>";
        }
        else{
            Redirect_to('../../index.html');
        }
    }