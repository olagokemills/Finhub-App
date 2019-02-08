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

 $id = $_POST['id'];

		 

 $sql = "UPDATE users SET username ='$username', password ='$password', email ='$email', firstname='$firstname', lastname='$lastname', phone='$phone', role='$role' WHERE id='$id'";
	mysqli_query($dbc, $sql) or die(mysqli_error($dbc));

//Load composer's autoloader
require 'PHPMailer3/src/Exception.php';
require 'PHPMailer3/src/PHPMailer.php';
require 'PHPMailer3/src/SMTP.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
     //$mail->SMTPDebug = 2; 
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'tls://smtp.gmail.com:587';
$mail->SMTPOptions = array(
   'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
    )
);

    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'genesisappalert@gmail.com';                 // SMTP username
    $mail->Password = 'headoffice198';                           // SMTP password
   // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('kevin.akaniru@genesisgroupng.com', 'Finance App');

    //Recipients
   
    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
    $mail->addAddress($email, $firstname);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Access Granted';
    $mail->Body    = "<h4>Hello,</h4> 
					<br /> 
					Your Account has been edited. Here is what you need to know ;<br />

					Firstname: ".$firstname."<br />
					Last Name: ".$lastname." <br/ >
                    Role: ".$role."<br />
                    phone: ".$phone." <br/ >
                    Username: ".$username."<br />
                    Password: ".$password." <br/ >
                    Email: ".$email." 

					Cheers";

    $mail->AltBody = strip_tags($mail->Body);

    $mail->send();
   
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
 echo 'Mailer Error: ' . $mail->ErrorInfo;
}

  echo "Account edited Successfully";
		
 }
 
?>