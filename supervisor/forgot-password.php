<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require('../includes/connect.php');
    $email = $_POST['email'];
    $pass = $_POST['password'];
         $q = "SELECT * FROM users WHERE email='$email'";
        $r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
        if(mysqli_num_rows($r) == 1)
        {
            $query = "UPDATE users SET password = sha1('$pass') WHERE email= '$email'";
            $run = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
            if($run)
            {
                 echo "<script type=\"text/javascript\">
            alert(\"Password Changed Successfully.\");
             window.location = \"index.php\"
          </script>";

            }
        }
        else
        {
            echo "<p align=\"center\" style=\"color:#C00\"><font size=\"4\">Wrong Entry<br />Access Denied..</font></p>";
        }
}

?>
<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Genesis Finance App | Supervisor</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">FN+</h1>

            </div>
            <h3>Password Recovery</h3>
            
            <p>To reset your password, Please Input your Email and desired password</p>
            <form class="m-t" role="form" method="POST">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-danger block full-width m-b">Reset</button>

                <a href="index.php"><small>Login Instead?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a href="mailto:kevin.akaniru@genesisgroupng.com.com">Request For An Account</a>
            </form>
            <p class="m-t"> <small>Genesis Finance App</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../assets/js/jquery-3.1.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>
