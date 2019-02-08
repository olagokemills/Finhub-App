<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once "includes/connect.php";

  $dt=date('d/m/Y');

  $td=date('d-m-Y');
	   
	    $q = "SELECT * FROM records WHERE status <> 'paid' ";

			$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));

			if($r)
			{

			 while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))

			 {

			$new = str_replace("/","-", $row['forecastdate']);

 	 			//echo $new."<br />";

 	 		$fdate = date('Y-m-d',strtotime($new));


 	 		$date1 = new DateTime($td);
			$date2 = new DateTime($fdate);

			 if($date1 > $date2 && $row['status'] == 'pending' || $date1 > $date2 && $row['status'] == 'due' )

			{
	   
   $sql = "UPDATE records SET status='overdue' WHERE id =".$row['id'];
   $q = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
   $num = mysqli_affected_rows($dbc);

	  if($q)
	   	
	{

	$query = "SELECT * FROM users WHERE unit='Finance'";
    $result = mysqli_query($dbc, $query);
    $number = mysqli_num_rows($result);

    if($number >= 0)
    {
      while ($raws = mysqli_fetch_array($result, MYSQLI_ASSOC))
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
    $mail->addAddress($raws['email'], $raws['firstname']); 
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Updated';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['forecastdate']. " is overdue, please check the finance portal to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}

		}
		
	}
		}

		}else

		$new = str_replace("/","-", $row['forecastdate']);

 	 			//echo $new."<br />";

 	 		  $fdate = date('Y-m-d',strtotime($new));


 	 		$date1 = new DateTime($td);
			$date2 = new DateTime($fdate);


	 if($date1 > $date2 && $row['status'] == 'overdue')
	{

    $query = "SELECT * FROM users WHERE unit='Finance'";
    $result = mysqli_query($dbc, $query);
    $number = mysqli_num_rows($result);

    if($number >= 0)
    {
      while ($raws = mysqli_fetch_array($result, MYSQLI_ASSOC))
       {
	require_once 'PHPMailer3/src/Exception.php';
	require_once 'PHPMailer3/src/PHPMailer.php';
	require_once 'PHPMailer3/src/SMTP.php';
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try { //$mail->SMTPDebug = 2; 
	 
  //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'genesisgroupng.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'finhub@genesisgroupng.com';                 // SMTP username
    $mail->Password = 'finhub@123';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('finhub@genesisgroupng.com', 'Finhub');
    $mail->addAddress($raws['email'], $raws['firstname']); 
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Notification';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$row['beneficiary']. " slated for ".$row['forecastdate']. " is overdue, please check to confirm the payment status;<br /> Cheers";
	     $mail->AltBody = strip_tags($mail->Body);$mail->send();
	   } catch (Exception $e) {
	    echo 'Message could not be sent.';
	    //commented in case of errors
	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	}

			}
		}

	}

	}
}

	 $query = "SELECT * FROM records WHERE  status <> 'paid'";
		$run = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
		 $nums = mysqli_num_rows($run);

		 if($run){

		 	 while($raw = mysqli_fetch_array($run, MYSQLI_ASSOC))

		 	 {

		 	 if($dt == $raw['forecastdate'] && ($raw['status'] == 'pending' ))
		 	 {
		 	 	 
		 	 		 $sql = "UPDATE records SET status='due' WHERE id =".$raw['id'];
			 	 	 $q = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
			 	 	 $num = mysqli_affected_rows($dbc);

			 	 	if($q){

			 	 		$query = "SELECT * FROM users WHERE unit='Finance'";
					    $result = mysqli_query($dbc, $query);
					    $number = mysqli_num_rows($result);

				    if($number >= 0)
				    {
				      while ($raws = mysqli_fetch_array($result, MYSQLI_ASSOC))
				       {
			 	 	 require_once 'PHPMailer3/src/Exception.php';
					require_once 'PHPMailer3/src/PHPMailer.php';
					require_once 'PHPMailer3/src/SMTP.php';
					$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
					try {
					//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'genesisgroupng.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'finhub@genesisgroupng.com';                 // SMTP username
					$mail->Password = 'finhub@123';                           // SMTP password
					//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 25;                                    // TCP port to connect to
					//Recipients
				    $mail->setFrom('finhub@genesisgroupng.com', 'Finhub');
					$mail->addAddress($raws['email'], $raws['firstname']);   
					    //Content
					    $mail->isHTML(true);                                  // Set email format to HTML
					    $mail->Subject = 'Payment Status Updated';
					    $mail->Body    = "<h4>Hello,</h4><br />

					    	Your payment to ".$raw['beneficiary']. " slated for ".$raw['forecastdate']. " is Due, please check  the portal to confirm the payment status;<br /> Cheers";
						$mail->AltBody = strip_tags($mail->Body);
						$mail->send();
					} catch (Exception $e) {
					    echo 'Message could not be sent.';
					    //commented in case of errors
					 echo 'Mailer Error: ' . $mail->ErrorInfo;
					}

						}
					
					}

				}
		 	 }
		 	 else
		 	 	if($dt == $raw['forecastdate'] && ($raw['status'] == 'due' ))
		 	 {

		 	 	 $sql = "UPDATE records SET status='due' WHERE id =".$raw['id'];
			 	 	 $q = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
			 	 	 $num = mysqli_affected_rows($dbc);

			 	 	 if($q)
			 	 	 {

			 	 	 $query = "SELECT * FROM users WHERE unit='Finance'";
				    $result = mysqli_query($dbc, $query);
				    $number = mysqli_num_rows($result);

				    if($number >= 0)
				    {
				      while ($raws = mysqli_fetch_array($result, MYSQLI_ASSOC))
				       {
			 	 	 require_once 'PHPMailer3/src/Exception.php';
					require_once 'PHPMailer3/src/PHPMailer.php';
					require_once 'PHPMailer3/src/SMTP.php';
					$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
					try {
					   //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					    $mail->isSMTP();                                      // Set mailer to use SMTP
					    $mail->Host = 'genesisgroupng.com';  // Specify main and backup SMTP servers
					   $mail->SMTPAuth = true;                               // Enable SMTP authentication
					    $mail->Username = 'finhub@genesisgroupng.com';                 // SMTP username
					    $mail->Password = 'finhub@123';                           // SMTP password
					    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					    $mail->Port = 25;                                    // TCP port to connect to
					    //Recipients
					    $mail->setFrom('finhub@genesisgroupng.com', 'Finhub');
					    $mail->addAddress($raws['email'], $raws['firstname']);
					    //Content
					    $mail->isHTML(true);                                  // Set email format to HTML
					    $mail->Subject = 'Payment Status Notification';
					    $mail->Body    = "<h4>Hello,</h4><br />

					    	Your payment to ".$raw['beneficiary']. " slated for ".$raw['forecastdate']. " is Due, please check  the portal to confirm the payment status;<br /> Cheers";
						$mail->AltBody = strip_tags($mail->Body);
						$mail->send();
					} catch (Exception $e) {
					    echo 'Message could not be sent.';
					    //commented in case of errors
					 echo 'Mailer Error: ' . $mail->ErrorInfo;
					}

						}
					}

				}

		 	 }
		 	 }
		 }

		$query = "SELECT * FROM records WHERE  status <> 'paid'";
		$run = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
		 $nums = mysqli_num_rows($run);

		 if($run){

		 	 while($raws = mysqli_fetch_array($run, MYSQLI_ASSOC))
		 	 {

		 	 	 if( $dt < $raws['forecastdate'] && ($raws['status'] !== 'paid' ))
		 	 	 {

		 	 	 	 $new = str_replace("/","-", $raws['forecastdate']);

 	 			//echo $new."<br />";

 	 		  $fdate = date('Y-m-d',strtotime($new));


 	 		$date1 = new DateTime($td);
			$date2 = new DateTime($fdate);
			 
			$diff = $date2->diff($date1)->format("%a");

			if($diff <= 3)
			{
				$query = "SELECT * FROM users WHERE unit='Finance'";
			    $result = mysqli_query($dbc, $query);
			    $number = mysqli_num_rows($result);

			    if($number >= 0)
			    {
			      while ($raws = mysqli_fetch_array($result, MYSQLI_ASSOC))
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
	    $mail->addAddress($raws['email'], $raws['firstname']); 
		//Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Payment Status Notification';
	    $mail->Body    = "<h4>Hello,</h4> <br /> Your payment to ".$raws['beneficiary']. " slated for ".$raws['forecastdate']. " is Due in ".$diff." day(s) , please check to confirm the payment status;<br /> Cheers";
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
		 	 }


		 	}

?>
