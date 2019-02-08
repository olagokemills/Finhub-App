<?php

session_start();
if(isset($_SESSION['admin']))

{

    include "inc/header.php";
    include "../includes/connect.php";


if(isset($_GET['id']))
{
 $id = $_GET['id'];
  $sql="SELECT * FROM users where id = '$id'";
 $result = mysqli_query($dbc, $sql) or die (mysqli_error($dbc));

echo'
 <div class="wrapper wrapper-content">
                 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Admin</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="view_users.php">Users</a>
                        </li>
                        <li>
                            <a>Edit Existing User</a>
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
                            <h5>Edit existing User</h5>';

                        
                         while($row = mysqli_fetch_array($result, MYSQLI_ASSOC) )
                                {

                            echo '                           
                           
                        </div>
                        <div class="ibox-content">
                        <center> <p class="text-danger mb-5" id="message"></p> </center>
                            <form id="form" action="" method="POST">
                                <fieldset>
                                    <h2>Account Information</h2>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Username *</label>
                                                <input name="username" value="'.$row['username'].'" type="text" class="form-control required">
                                            </div>
                                            <input name="id" value="'.$row['id'].'" hidden /> 
                                            <div class="form-group">
                                                <label>Password *</label>
                                                <input id="password" name="password" type="text" value="'.$row['password'].'" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input name="email" type="email"  value="'.$row['email'].'"  class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-center">
                                                <div style="margin-top: 20px">
                                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <h2>Profile Information</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First name *</label>
                                                <input name="firstname" type="text"  value="'.$row['firstname'].'"  class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Last name *</label>
                                                <input name="lastname" type="text"  value="'.$row['lastname'].'"  class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone *</label>
                                                <input name="phone" type="text" value="'.$row['phone'].'" class="form-control">
                                            </div>
                                             <div class="form-group">
                                                <label>Role *</label>

                                             <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                  <option>Select Option</option>
                                                  <option value="Supervisor">Supervisor</option>
                                                  <option value="Staff">Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <button type="submit" id="edit" class="btn btn-primary block">Submit</button>

                                   <img id="uploadIm" src="load.gif" />                                        
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           </div>
         </div>';
     }

     include 'inc/footer.php';

    }
    else{

        echo "Page accessed wrongly, Please Go Back!";
    }



}
elseif (isset($_SESSION['admin']) AND isset($_SESSION['username'])) {

    echo 'Admin Logged in  <a href="logout.php">Log Out</a>';
    # code...
}
else{
    header("Location:../index.php");
}
