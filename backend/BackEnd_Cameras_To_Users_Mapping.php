<?php
/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 09-Mar-18
 * Time: 5:18 PM
 */

//Establish connection using connection details maintained in a seperate php file-db.php
require('db.php');

//PARTICULAR CAMERAS ARE TO BE MAPPED TO USERS BY THE ADMIN.
///AN ADMIN SHOULD BE ABLE TO MAP A CAMERA WITH A USER(CameraId-FOREIGN KEY, UserName-FOREIGN KEY)
//WHEN A USER LOGS IN, THIS TABLE WILL BE CHECKED TO RETRIEVE THE CAMERAID HE SHOULD HAVE ACCESS TO.
//Create an Insert prepared statement and run it
$camera_id = 200;
$user_name = 'okosun.temple';

if ($stmt = mysqli_prepare($conn, "INSERT INTO usercameraaccess (CameraId, UserName) VALUES (?, ?)")) {
    mysqli_stmt_bind_param($stmt, 'is', $camera_id, $user_name);
    mysqli_stmt_execute($stmt);
    printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);

?>