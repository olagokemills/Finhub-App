<?php
session_start();
session_regenerate_id();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require('../includes/connect.php');
    $user = $_POST['username'];
    $pass = $_POST['password'];
     $unit = $_POST['unit'];
        $q = "select * FROM users WHERE username='$user' AND password = ('$pass') AND role='Tracker' AND unit = '$unit' ";
        $r = mysqli_query($dbc, $q);
        if(mysqli_num_rows($r) == 1)
        {
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            $_SESSION['tracker'] = $row['id'];
             $_SESSION['tracker_name'] = $row['firstname'] ." ". $row['lastname'];
            $_SESSION['unit'] = $unit;
             
            header('location:view_records.php');
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

    <title>Genesis Finance App | Tracker</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body class="black-bg">

    <div class="middle-box text-center loginscreen animated fadeInUp">
        <div>
            <div>

                <h1 class="logo-name">FN+</h1>

            </div>
            <h3>Welcome, Tracker</h3>
            
            <p>Login in to Proceed</p>
            <form class="m-t" role="form" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div> 
                <div class="form-group">
    
                         <select class="form-control" name="unit" id="exampleFormControlSelect1">
                                  <option>Select Unit</option>
                                  <option value="ICB">ICB</option>
                                  <option value="QSR">QSR</option>
                                  <option value="HR">HR</option>
                                  <option value="IT">IT</option>
                                  <option value="PDC">PDC</option>
                                  <option value="PH Hotels">PH Hotels</option>
                                  <option value="Sojourner">Sojourner</option>
                                  <option value="Cinema">Cinema</option>
                                
                        </select>
                </div>
                <button type="submit" class="btn btn-secondary block full-width m-b">Login</button>

               <a href="forgot-password.php"><small>Forgot password?</small></a>
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
