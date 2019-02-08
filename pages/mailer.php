<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    require "../includes/connect.php";

    //uprofile
 $username =  mysqli_real_escape_string($dbc, $_POST['username']);
 $password =  mysqli_real_escape_string($dbc, trim($_POST['password']));
 $email =  mysqli_real_escape_string($dbc, trim($_POST['email']));
 $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
 $lastname =  mysqli_real_escape_string($dbc, trim($_POST['lastname']));
 $phone =  mysqli_real_escape_string($dbc, trim($_POST['phone']));
 $role = mysqli_real_escape_string($dbc, $_POST['role']);

if($_POST['unit'] == 'nill')
 {
    $unit = 'Finance';
 }
 else{

    $unit = $_POST['unit'];
 }

    $query= "SELECT username, email  FROM users WHERE email ='$email' OR username='$username'";
    $run = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
    if(mysqli_num_rows($run) == 0)
    {
    $sql = "INSERT INTO users (username, password, email, firstname, lastname, phone, role, unit) VALUES('$username',sha1('$password'),'$email','$firstname','$lastname','$phone','$role', '$unit')";
    mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
//Load composer's autoloader
require 'PHPMailer3/src/Exception.php';
require 'PHPMailer3/src/PHPMailer.php';
require 'PHPMailer3/src/SMTP.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
     // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'genesisgroupng.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'finhub@genesisgroupng.com';                 // SMTP username
    $mail->Password = 'finhub@123';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('finhub@genesisgroupng.com', 'Finhub');
    //Recipients   
    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
    $mail->addAddress($email, $firstname);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account Credentials For The Finance Portal';
    $mail->Body    = "<h4>Hello,</h4> 
                    <br /> 
                    An account has been created for you on the Finance System. Here are the details <br />

                    Username: ".$username."<br />
                    Password: ".$password." <br/ >
                    Portal Link : http://genesisgroupng.com/financehub+/".$role." <br />Cheers";

    $mail->AltBody = strip_tags($mail->Body);

    $mail->send();
   
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
 echo 'Mailer Error: ' . $mail->ErrorInfo;
}

  echo "Member Added Successfully";
    }

    else
     {
         echo "Username or Email Already Exists";   
    }
 }
 
?>