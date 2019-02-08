<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();
include_once 'connect.php';
$checkname=$_SESSION['username'];
$dt=date('y-m-d h:i:s');
$dt2 = date('m');
$dt3=date('y');
$fullyear='20'.+$dt3;


if($dt2 == 1)
{$month = 'january';}
if($dt2 == 2)
{$month = 'february';}
if($dt2 == 3)
{$month = 'march';}
if($dt2 == 4)
{$month = 'april';}
if($dt2 == 5)
{$month = 'may';}
if($dt2 == 6)
{$month = 'june';}
if($dt2 == 7)
{$month = 'july';}
if($dt2 == 8)
{$month = 'august';}
if($dt2 == 9)
{$month = 'september';}
if($dt2 == 10)
{$month = 'october';}
if($dt2 == 11)
{$month = 'november';}
if($dt2 == 12)
{$month = 'december';}



if(isset($_POST["upload"]))
{
$filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
		$sales_day=$_POST['sales_day'];
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM user";
		// insert upload data into summary_meta table
		$query2 = "INSERT INTO summary_meta(upload_date, sales_day, user, month) VALUES('$dt','$sales_day','$checkname','$month')";
mysql_query($query2);

//query upload data id 
$query3 = "SELECT * from summary_meta WHERE upload_date='$dt' AND user='$checkname'";
$result=mysql_query($query3) or die(mysql_error());
$result2=mysql_fetch_assoc($result);
$uploadid=$result2['id'];
$upload_date=$result2['upload_date'];
		$count = 0;    
		
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
			$count++; 
			
			if($count>1){  		

$query = "INSERT INTO dailyfin_sales(location, pos_sales, cash_sales, actual_sales, invoice_count, average_invoice_spend, months, upload_id, year) VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$month','$uploadid','$fullyear')";
mysql_query($query) or die(mysql_error());

			}
		
		}
		
		
		$query2 = "UPDATE time_log SET update_time ='$upload_date' WHERE id='1'";
mysql_query($query2) or die(mysql_error());
		// send email to QSR Stakeholders

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

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
$mail->setFrom('genesisappalert@gmail.com', 'Genesis appalert');

    //Recipients
   
    $mail->addAddress('qsrbireport@genesisgroupng.com', 'chinazor oputa');     // Add a recipient
    // $mail->addAddress('chinazor.oputa@genesisgroupng.com', 'chinazor oputa');
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Sales Report>>>New Sales data uploaded';
    $mail->Body    = "A new sales data has been uploaded 
<br />

<h4>DSA Summary</h4> 
Uploaded By: $checkname  <br /> 
Upload Date: $dt <br />
Date of Sales Uploaded: $sales_day <br />  
<br />
Visit http://apps.genesisgroupng.com/dsa for details.
";

    $mail->AltBody = strip_tags($mail->Body);

    $mail->send();
   
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
}

		
		
		
		?>
<script>alert('Upload successful');</script>
<?php

	}

}

?>

<?php include("header.php"); ?>
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Actions</a>
        </li>
        <li class="breadcrumb-item active">Upload Financial Summary Data</li>
      </ol>
<div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Upload Financial Summary Data</div>
      <div class="card-body">
       <form enctype="multipart/form-data" method="post" role="form" >
Click <a href="/dsa/download/SalesTemplate.csv">here</a> to download sales summary CSV template.
<div class="form-group">
<label for="exampleInputPassword1">Sales day </label>
            <input class="form-control" id="exampleInputPassword1" name="sales_day" type="date"  required />
</div>
<div class="form-group">
<label for="exampleInputFile">File Upload</label>
        <input class="form-control" type="file" name="file" id="file" size="150" required>
        </div>
<button type="submit" class="btn btn-primary btn-block" name="upload" value="Import">Upload</button>

</form>
 </div>
    </div>
  </div>
<!--This div below opens in the header include file <div class="container-fluid"> -->
</div>
<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


<?php include("footer.php"); ?>