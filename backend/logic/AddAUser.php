<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/sessions.php");




// Importing PHP Mailer namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    global $conn;

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

    $usertype = "User";

    $DateTime = get_datetime();
    $EmailActivation= '0';

    //Check if users exist:
    $query = "SELECT * FROM `users` WHERE UserName='$user_name' OR Email='$email'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        echo "<div class='form'>
            <h3>A User with the Username/Email already exist.</h3>
            <br/>Try a different Username/Email. Thank You <a class='button' href='../../register.html'>Back.</a>
            </div>";
    } elseif ($rows == 0) {
        //Generate a token for email activation.
        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLY01234567!$/()*';
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $stmt = mysqli_prepare($conn, "INSERT INTO users (UserName, Password, FirstName, LastName, Email, UserType, emailactivation, token, registrationdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssssssss', $user_name, $user_password, $firstname, $lastname, $email, $usertype, $EmailActivation, $token, $DateTime);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
                //Send an Activation Email. We will use PHP Mailer to avoid our mails been filtered off as Spam.
                include_once "../../backend/resources/PHPMailer/PHPMailer.php";
                include_once "../../backend/resources/PHPMailer/Exception.php";
                include_once "../../backend/resources/PHPMailer/SMTP.php";

                $base_url = "https://foxysnap.azurewebsites.net/backend/logic/";
                $mail= new PHPMailer(true);
                try {
                    $mail_body = "
                                      <p>Hi ".$firstname.",</p>
                                       <p>Thanks for registering. Your account will 
                                       become active only after your email verification.
                                       </p>
                                       <p>Please open this link to activate now - 
                                       <a  href='".$base_url."emailconfirmation.php?email=".$email."&token=".$token."'>Activate Now</a>
                                       <p>Best Regards,<br/>Foxy Snap.</p>  ";
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.mail.yahoo.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'pylinkscomputers@yahoo.com';                 // SMTP username
                    $mail->Password = 'Gatherer123#';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;
                    //Will help handle all these mail servers security issues.
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );


                    $mail->setFrom('pylinkscomputers@yahoo.com', 'Foxy Snap Team');
                    $mail->addAddress($email, $firstname);

                    $mail->Subject =  'Foxy Snap- Account Activation';
                    $mail->isHTML(true);
                    $mail->Body = $mail_body;
                    $mail->send();
                                   }
                catch (Exception $e) {
                    $mail->ErrorInfo;
                }


                    echo "<div class='form'>
                    <h3>Registration Successful. An activation email has been sent to you.</h3>
                    <br/>Click here to:  <a class='button'  href='../../login.html'>Login</a></div>";
                    mysqli_stmt_close($stmt);
                    // Close the connection
                    mysqli_close($conn);
                }
                else{
                    echo "<div class='form'>
                    <h3>OOPs! Something went wrong. Please try again.</h3>
                    <br/>Click here to <a class='button'  href='../../register.html'>Register</a></div>";
                    mysqli_stmt_close($stmt);
                    // Close the connection
                    mysqli_close($conn);

                }
            }
    else {
           echo die('Failed to connect to MySQL: '.mysqli_connect_error());

        //Redirect_to('../../index.html');
    }
}
?>

