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

		 

	$sql = "INSERT INTO users (username, password, email, firstname, lastname, phone, role) VALUES('$username',sha1('$password'),'$email','$firstname','$lastname','$phone','$role')";
	mysqli_query($dbc, $sql); //or die(mysqli_error());

//Load composer's autoloader
require_once 'PHPMailer3/src/Exception.php';
require_once 'PHPMailer3/src/PHPMailer.php';
require_once 'PHPMailer3/src/SMTP.php';


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
					An account has been created for you on the Finance System. Here are the details <br />
					Username: ".$username."<br />
					Password: ".$password." <br/ >

					Cheers";

    $mail->AltBody = strip_tags($mail->Body);

    $mail->send();
   
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
 echo 'Mailer Error: ' . $mail->ErrorInfo;
}

  echo "Member Added Successfully";
		
 }
 
?>