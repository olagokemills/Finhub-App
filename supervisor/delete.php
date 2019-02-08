<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST["deletee"]))
{
    if(empty($_POST) === false){

require_once('../includes/connect.php');

    $id = mysqli_escape_string($dbc, trim($_POST['id']));

        if($_POST['sure'] =='Yes')
        {
        $query = "DELETE FROM  records WHERE id='$id'";
         mysqli_query($dbc, $query) or die(mysqli_error($dbc));

         $q = "SELECT * FROM users WHERE role='supervisor' AND unit='Finance'";
            $r = mysqli_query($dbc,$q);
            $num = mysqli_num_rows($r);

            if($num >= 0)
            {
                while ($raw = mysqli_fetch_array($r, MYSQLI_ASSOC))
                {

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
    $mail->addAddress($raw['email'], $raw['firstname']);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Record Deleted';
    $mail->Body    = "<h4>Hello,</h4> 
                    <br /> 
                    A Record has been deleted from the Finance System by ".$_SESSION['sup_name'].", Please check the system for more details<br />Cheers";

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
        <script>alert('Record Deleted Successfully');</script>
    
    <?php

    }else{

        header("Location: view_records.php");
    }

 
        }else{
            //
        }

}

?>