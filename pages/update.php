<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["updatee"]))
{
	if(empty($_POST) === false){

require_once('../includes/connect.php');

	$beneficiary = mysqli_escape_string($dbc, trim($_POST['beneficiary']));
	$amount = mysqli_escape_string($dbc, trim($_POST['amount']));
	$description = mysqli_escape_string($dbc, trim($_POST['description']));
	$entrydate = mysqli_escape_string($dbc, trim($_POST['entrydate']));
	$forecast = mysqli_escape_string($dbc, trim($_POST['forecast']));
	// $status = mysqli_escape_string($dbc, trim($_POST['status']));
    $id = mysqli_escape_string($dbc, trim($_POST['record_id']));

$query = "UPDATE records SET beneficiary='$beneficiary', amount='$amount', description='$description', entrydate='$entrydate', forecastdate='$forecast' WHERE id='$id'";
 mysqli_query($dbc, $query) or die(mysqli_error($dbc));
       //Load composer's autoloader

            $q = "SELECT * FROM users WHERE role='supervisor' AND unit='Finance'";
            $r = mysqli_query($dbc,$q);
            $num = mysqli_num_rows($r);

            if($num >= 0)
            {
                while ($raw = mysqli_fetch_array($r, MYSQLI_ASSOC))
                {

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
    $mail->addAddress($raw['email'], $raw['firstname']);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Record Edited';
    $mail->Body    = "<h4>Hello,</h4> 
                    <br /> 
                    An Update has occurred on the Finance System. It was carried out by  ".$_SESSION['admin_username'].",  Check the System for More details <br />Cheers";

    $mail->AltBody = strip_tags($mail->Body);
     $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
 echo 'Mailer Error: ' . $mail->ErrorInfo;
}

    }
}

  ?>
        <script>alert('Record Edited Successfully');</script>
        <?php
         }
    }

?>