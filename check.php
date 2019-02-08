<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once "includes/connect.php";

  $dt=date('d/m/Y');

  $td=date('d-m-Y');

 $q = "SELECT * FROM records";
 $r = mysqli_query($dbc, $q);

 if($r)
 {
 	 while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
 	 {
 	 	//$deal = $dt > $row['paydate'] && $row['status'] !== 'paid'
 	 //conditon to check if the payment date has passed
 if($dt > $row['paydate'] && $row['status'] !== 'paid')
  {
 	  $sql = "UPDATE records SET status='overdue' WHERE id =".$row['id'];
	   $q = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
	   $num = mysqli_affected_rows($dbc);
	   for($count = 0;$count<$num;$count++) {
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
	    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
	    $mail->addAddress('olagoke.olawuni@genesisgroupng.com', 'Olagoke');
	    $mail->addAddress('kevin.akaniru@genesisgroupng.com', 'Kevin');
	    
	    $mail->addAddress('olawunigoke@ymail.com', 'Ola');
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Updated';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['paydate']. " is overdue, please check the finance portal to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
 }
   $sqlee = "SELECT * from records WHERE 
 	 			 ".$dt." > ".$row['paydate']." AND status = 'pending'";
 	 $q = mysqli_query($dbc, $sqlee);
 	 $nums = mysqli_num_rows($q);
 	 printf("Result set has %d rows.\n", $nums);
 	$raw = mysqli_fetch_array($q, MYSQLI_ASSOC);
 	for($counts = 0;$counts<$nums;$counts++){
 	    echo $counts;
 	require_once 'PHPMailer3/src/Exception.php';
	require_once 'PHPMailer3/src/PHPMailer.php';
	require_once 'PHPMailer3/src/SMTP.php';
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try { //$mail->SMTPDebug = 2; 
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
	    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
	    $mail->addAddress('olagoke.olawuni@genesisgroupng.com', 'Olagoke');
	    $mail->addAddress('kevin.akaniru@genesisgroupng.com', 'Kevin');
	    $mail->addAddress('olawunigoke@ymail.com', 'Ola');
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Notification';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['paydate']. " is overdue, please check to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
		}
 	
	}

	//condition to check if the current date and the payment date are the same
 	 	if( $dt == $row['paydate'] && ($row['status'] !== 'paid' ))
 	 	{
		 $sql = "UPDATE records SET status='due' WHERE id =".$row['id'];
 	 	 $q = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
 	 	 $num = mysqli_affected_rows($dbc);
	for($count = 0;$count<$num;$count++) 
	{
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
	    $mail->addAddress('olagoke.olawuni@genesisgroupng.com', 'Olagoke');
	    $mail->addAddress('kevin.akaniru@genesisgroupng.com', 'Kevin');
	    $mail->addAddress('olawunigoke@ymail.com', 'Ola');

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Updated';
	    $mail->Body    = "<h4>Hello,</h4><br />

	    	Your payment to ".$row['beneficiary']. " slated for ".$row['paydate']. " is Due, please check  the portal to confirm the payment status;<br /> Cheers";
		$mail->AltBody = strip_tags($mail->Body);
		$mail->send();
	} catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
 	 }

//Repeating the check process and firring the reminder email
 	 if($q)
 	 { $sqle = "SELECT * from records WHERE 
 	 			 ".$dt." = ".$row['paydate']." AND status = 'due'";
 	 $query = mysqli_query($dbc, $sqle);$nums = mysqli_num_rows($query);
 	$raw = mysqli_fetch_array($query, MYSQLI_ASSOC);
 	for($counts = 0;$counts<$nums;$counts++){
 	require_once 'PHPMailer3/src/Exception.php';
	require_once 'PHPMailer3/src/PHPMailer.php';
	require_once 'PHPMailer3/src/SMTP.php';
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try { //$mail->SMTPDebug = 2; 
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
	    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
	    $mail->addAddress('olagoke.olawuni@genesisgroupng.com', 'Olagoke');
	    $mail->addAddress('kevin.akaniru@genesisgroupng.com', 'Kevin');
	    $mail->addAddress('olawunigoke@ymail.com', 'Ola');
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Notification';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['paydate']. " is Due, please check to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
		}
 	 }



 	}

 	 //condtition for current date Lesser Than Three days to the payment date


 	 	if( $dt < $row['paydate'] && ($row['status'] !== 'paid' ))
 	 	{


 	 		 $new = str_replace("/","-", $row['paydate']);

 	 			//echo $new."<br />";

 	 		  $fdate = date('Y-m-d',strtotime($new));


 	 		$date1 = new DateTime($td);
			$date2 = new DateTime($fdate);
			 
			$diff = $date2->diff($date1)->format("%a");

			if($diff <= 3)
			{

 	require_once 'PHPMailer3/src/Exception.php';
	require_once 'PHPMailer3/src/PHPMailer.php';
	require_once 'PHPMailer3/src/SMTP.php';
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try { //$mail->SMTPDebug = 2; 
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
	    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
	    $mail->addAddress('olagoke.olawuni@genesisgroupng.com', 'Olagoke');
	    $mail->addAddress('kevin.akaniru@genesisgroupng.com', 'Kevin');
	    $mail->addAddress('olawunigoke@ymail.com', 'Ola');
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Notification';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['paydate']. " is Due in ".$diff." days , please check to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
		//}


			}
			
 	 	}
 	 }
 }

?>