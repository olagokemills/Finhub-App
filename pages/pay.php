<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "../includes/connect.php";

if(isset($_POST['id']))

{
	$dt=date('d/m/Y');

	$id = $_POST['id']; 

	$query = "SELECT * FROM records WHERE id='$id'";
	$r = mysqli_query($dbc, $query);
	 $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	 $unit = $row['unit'];

	 if($query)
	 {

	 $q = "UPDATE records SET status='paid', paydate='$dt' WHERE id='$id'";

	$result = mysqli_query($dbc, $q) or die(mysqli_error($dbc));

		 echo "Marked As Paid!";

		 $que = "SELECT * FROM users WHERE unit='$unit'";
		 $res = mysqli_query($dbc, $que) or die(mysqli_error($dbc));

		 while ($raw = mysqli_fetch_array($res, MYSQLI_ASSOC)) 
		 {

		 	if($raw['unit'] == $unit)
		 	{
		 		
//Load Composer's autoloader
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
    $mail->addAddress($raw['email'], $raw['firstname']);     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Payment Status Updated!';
    $mail->Body    = 'Your payment with description: '.$row['description']  .' ; beneficiary '.$row['beneficiary'] .'; has been marked as paid<br /> Thanks';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
	}

	 }

	 }
}


?>