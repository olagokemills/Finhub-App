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


 $id = $_POST['id'];

 $sql = "UPDATE users SET username ='$username', password =sha1('$password'), email ='$email', firstname='$firstname', lastname='$lastname', phone='$phone', role='$role', unit='$unit' WHERE id='$id'";
	mysqli_query($dbc, $sql) or die(mysqli_error($dbc));

//Load composer's autoloader
require_once 'PHPMailer3/src/Exception.php';
require_once 'PHPMailer3/src/PHPMailer.php';
require_once 'PHPMailer3/src/SMTP.php';


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
    $mail->Subject = 'Finance Portal Credentials Updated';
    $mail->Body    = "<h4>Hello,</h4> 
					<br /> 
					Your Account has been updated. Here is what you need to know ;<br />

          			Firstname: ".$firstname."<br />
          			Last Name: ".$lastname." <br/ >
                    Role: ".$role."<br />
                    Phone: ".$phone." <br/ >
                    Username: ".$username."<br />
                    Password: ".$password." <br/ >
                    Email: ".$email." <br />
                    Url : http://genesisgroupng.com/finhub+/".$role." <br />

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