<?php
/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 20-Mar-18
 * Time: 10:22 PM
 */


date_default_timezone_set("Europe/London");
$CurrentTime= time();
$DateTime= strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);

echo  $DateTime;