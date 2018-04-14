<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/sessions.php");



// If form submitted, insert values into the database.
if (isset($_POST['username'])){
    // removes backslashes

    $user_name = stripslashes($_REQUEST['username']);
    $user_name = mysqli_real_escape_string($conn, $user_name);

    $user_password = stripslashes($_REQUEST['password']);
    $user_password = mysqli_real_escape_string($conn, $user_password);

    //Checking if user is existing in the database or not.
    $query = "SELECT * FROM `users` WHERE UserName='$user_name'";
    $result = mysqli_query($conn,$query);
    $numRows = mysqli_num_rows($result);


    if($numRows==1){
        //Set-up an array to represent the row that is returned.
        $row = mysqli_fetch_assoc($result);
        //Get the column corresponding to the password of the user. This gets and stores the hashed password.
        $HashedPassword = $row['Password'];
        $EmailConfirmation = $row['emailactivation'];

        //Do verification here.
        if(password_verify($user_password, $HashedPassword) && ($EmailConfirmation=='1')){
            $_SESSION['username'] = $user_name;//Initializing session
            // DashBoard
            Redirect_to("../../backend/pages/dashboard.php");
        }
        elseif(password_verify($user_password, $HashedPassword) && ($EmailConfirmation=='0')){
            echo "<div class='form'>
            <h3>Account is yet to be activated.</h3>
            <br/>Click here to <a href='../../login.html'>Login</a></div>";
        }
        else{
            echo "<div class='form'>
            <h3>Username/Password is incorrect.</h3>
            <br/>Click here to <a href='../../login.html'>Login</a></div>";
        }

        }
else{
    echo "<div class='form'>
            <h3>No User Found.</h3>
            <br/>Click here to <a href='../../register.html'>Register</a></div>";
   }
}