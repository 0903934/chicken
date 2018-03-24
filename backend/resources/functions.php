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