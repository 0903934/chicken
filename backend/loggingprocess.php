<?php
require('db.php');

session_start();

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

        //Do verification here.
        if(password_verify($user_password, $HashedPassword)){
            $_SESSION['username'] = $user_name;//Initializing session
            // Redirect user to index page
            // printf("I got here 1");
            header("Location: C:\Users\Temple\PhpstormProjects\chicken\backend\dashboard.php"); //Redirecting to other page
        }
        else{
            echo "<div class='form'>
            <h3>Username/password is incorrect.</h3>
            <br/>Click here to <a href='../login.html'>Login</a></div>";
        }
    }
else{
    echo "No User found";
    return false;
}
}