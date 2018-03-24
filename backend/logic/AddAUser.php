<?php
//Require Database Connection.
require($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/db.php");
?>

<?php
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes

    $user_name = stripslashes($_REQUEST['username']);
    $user_name = mysqli_real_escape_string($conn, $user_name);

    $user_password = stripslashes($_REQUEST['password']);
    $user_password = mysqli_real_escape_string($conn, $user_password);
    // hash the password
    $user_password = password_hash($user_password, PASSWORD_BCRYPT);

    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($conn, $firstname);

    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($conn, $lastname);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $usertype = stripslashes($_REQUEST['usertype']);
    $usertype = mysqli_real_escape_string($conn, $usertype);

    //Check if users exist:
    $query = "SELECT * FROM `users` WHERE UserName='$user_name'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        echo "<div class='form'>
            <h3>A User with the Username already exist.</h3>
            <br/>Try a different Username. Thank You <a href='../../register.html'>Register</a></div>";

    } elseif ($rows == 0) {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (UserName, Password, FirstName, LastName, Email, UserType) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $user_name, $user_password, $firstname, $lastname, $email, $usertype);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<div class='form'>
            <h3>You are registered successfully.</h3>
            <br/>Click here to <a href='../../login.html'>Login</a></div>";

            mysqli_stmt_close($stmt);

            // Close the connection
            mysqli_close($conn);
        }

    } else {


        ?>

        <div class="form">
            <h1>Registration</h1>
            <form name="registration" action="AddAUser.php" method="post">
                <input type="text" name="username" placeholder="Username" required/>
                <input type="password" name="password" placeholder="Password" required/>
                <input type="email" name="email" placeholder="Email" required/>

                <input type="text" name="firstname" placeholder="First Name" required/>
                <input type="text" name="lastname" placeholder="Last Name" required/>
                <input type="text" name="usertype" placeholder="User Type (Admin or User)" required/>

                <input type="submit" name="submit" value="Register"/>
            </form>
        </div>


    <?php }

}

?>


