<?php
/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 24-Mar-18
 * Time: 2:36 PM
 */
//This function will be responsible for page redirections.
function Redirect_to($New_Location){
    header( "Location: ".$New_Location);
    exit;

}


function get_datetime(){
    date_default_timezone_set("Europe/London");
    $CurrentTime= time();
    $DateTime= strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
    return $DateTime;

}