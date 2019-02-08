<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_SESSION['admin']))
{

if (isset($_POST["Import"]))
{

include "../includes/connect.php";

 $filename=$_FILES["file"]["tmp_name"];
    

     if($_FILES["file"]["size"] > 0)
     {

        $file = fopen($filename, "r");

        $count= 0;
           while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
           {

             $count++; 
          
           if($count>1){ 


            $emapData[0] = mysqli_real_escape_string($dbc, trim($emapData[0]));
            $emapData[1] = mysqli_real_escape_string($dbc, trim($emapData[1]));
            $emapData[2] = mysqli_real_escape_string($dbc, trim($emapData[2]));
            $emapData[3] = mysqli_real_escape_string($dbc, trim($emapData[3]));
            $emapData[4] = mysqli_real_escape_string($dbc, trim($emapData[4]));
            $emapData[5] = mysqli_real_escape_string($dbc, trim($emapData[5]));
            $emapData[6] = mysqli_real_escape_string($dbc, trim($emapData[6]));
            $emapData[7] = mysqli_real_escape_string($dbc, trim($emapData[7]));

      
            //It wiil insert a row to our subject table from our csv file`
              $sql = "INSERT into records (beneficiary,description,amount,entrydate,forecastdate,paydate, status,unit) 
                values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]', '$emapData[6]','$emapData[7]')";
           //we are using mysql_query function. it returns a resource on true else False on error
            $result = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));


        if(!$result )
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"add_records.php\"
            </script>";
        
        }

           }
         }
           fclose($file);
           //throws a message if data successfully imported to mysql database from excel file          

    $q = "SELECT * FROM users WHERE role='supervisor' OR role='staff' AND unit='Finance'";
    $r = mysqli_query($dbc, $q);
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
    //Server settings
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
    //Recipients
    //$mail->addAddress('qsrbireport@genesisgroupng.com', 'qsrbi');     // Add a recipient
    $mail->addAddress($raw['email'], $raw['firstname']);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New Record Uploaded';
    $mail->Body    = "<h4>Hello,</h4> 
          <br /> 
          A new Record has been uploaded to the finance Portal by ".$_SESSION['admin_username'].", please check the system for more details <br />
          Cheers";

    $mail->AltBody = strip_tags($mail->Body);

    $mail->send();
   
} catch (Exception $e) {
    echo 'Message could not be sent.';
    //commented in case of errors
 echo 'Mailer Error: ' . $mail->ErrorInfo;
}

           echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"add_records.php\"
          </script>";

           }
    }

}

}


 include "inc/header.php";

echo'
 <div class="wrapper wrapper-content">
                 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Admin</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="view_records.php">Records</a>
                        </li>
                        <li>
                            <a>Add New Record</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Upload New DataSet</h5>
                           
                        </div>
                        <div class="ibox-content">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                 <div class="form-group">
                                <label for="exampleFormControlFile1">Upload New Record</label>
                                  <div class="col-sm-5">
                                      <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx">
                                </div>
                              </div>
                              <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                       <button class="btn btn-primary" type="submit" name="Import">Submit</button>
                                    </div>
                                </div><br />
                            </form>
                            <p class="text-danger">Sample CSV document found  <a href="../download/try.csv">here</a></p>
                        </div>
                    </div>
                </div>
            </div>
           </div>
         </div>';

     include 'inc/footer.php';

}
else{
    header("Location:index.php");
}
