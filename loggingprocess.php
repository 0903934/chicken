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

    //Checking is user existing in the database or not
    $query = "SELECT * FROM `users` WHERE UserName='$user_name' and Password='$user_password'";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($result);


    if($rows==1){
        $_SESSION['username'] = $user_name;//Initializing session
        // Redirect user to index page

        // printf("I got here 1");

        header("Location: dashboard.php"); //Redirecting to other page
    }else{
        echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='loggingprocess.php'>Login</a></div>";
    }
}

else{
?>

<?php } ?>