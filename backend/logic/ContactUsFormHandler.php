<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/sessions.php");

?>

<?php

/**
 * Created by PhpStorm.
 * User: Temple
 * Date: 13-Apr-18
 * Time: 4:35 AM
 */

//Import PHPMailer Library for mails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

global $conn;

//Set Notifications Variable initially empty
$msg ='';

//Get inputs from the Contact Us form.
if(isset($_REQUEST['Submit'])){
    $Name = stripslashes($_REQUEST['Name']);
    //NB, that if no conn is open, mysqli_real_escape_string() will return an empty string!.Triggering Validation 1
    $Name = mysqli_real_escape_string($conn, $Name);

    $Email = stripslashes($_REQUEST['Email']);
    //NB, that if no conn is open, mysqli_real_escape_string() will return an empty string!.Triggering Validation 1
    $Email = mysqli_real_escape_string($conn,  $Email);

    $Message = stripslashes($_REQUEST['Message']);
    //NB, that if no conn is open, mysqli_real_escape_string() will return an empty string!.Triggering Validation 1
    $Message = mysqli_real_escape_string($conn,  $Message);

    //Validations on contact us form.
    if(empty($Name) || empty($Email) || empty($Message)){
        $msg= 'Input errors! Ensure you have entered all fields!';
    }

    else{
            //Send an Email. We will use PHP Mailer to avoid our mails been filtered off as Spam.
            include_once "../../backend/resources/PHPMailer/PHPMailer.php";
            include_once "../../backend/resources/PHPMailer/Exception.php";
            include_once "../../backend/resources/PHPMailer/SMTP.php";

            $base_url = "https://foxysnap.azurewebsites.net/";
            $mail= new PHPMailer(true);
            try {


                $mail_body = "
                               <p>Hi dear, <br>
                               Trust you are doing great.
                               </p> 
                               <p> ".$Name. " sent us the message below: <br>
                                ".$Message. "
                               </p>
                               <p>Click here to get to our homepage - <a  href='".$base_url."index.html'>Foxy Snap</a>
                               <p>Best Regards,<br/>Foxy Snap.</p> ";

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
                $mail->addAddress('t.okosun@rgu.ac.uk', 'Temple Okosun');
                $mail->addAddress('e.okogu@rgu.ac.uk', 'Ejiro Okogu');
                $mail->addAddress('p.clark1@rgu.ac.uk', 'Peter Clark');
                $mail->addAddress('stucos@hotmail.com', 'Stuart Cossar');
                $mail->addAddress('m.a.aljuwaiser@gmail.com', 'Muhammed Aljuwaiser');
                $mail->Subject =  'Foxy Snap- Contact Us.';
                $mail->isHTML(true);
                $mail->Body = $mail_body;
                $mail->send();
                $msg = "Message sent successfully!";

            }
            catch (Exception $e) {
                    $msg = 'OOPs! Something went wrong. Please try again.';
                    $mail->ErrorInfo;
                }
        }
   }

Redirect_to('../../thankyou_response_contact_form.html');

