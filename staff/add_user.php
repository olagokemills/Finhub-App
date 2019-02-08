<?php

session_start();
if(isset($_SESSION['supervisor']))

{

    include "inc/header.php";
    include "../includes/connect.php";

echo'
 <div class="wrapper wrapper-content">
                 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Supervisor</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="view_users.php">Users</a>
                        </li>
                        <li>
                            <a>Add New User</a>
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
                            <h5>Add A New User</h5>
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
                                                <input name="username" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Password *</label>
                                                <input id="password" name="password" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input name="email" type="email" class="form-control required">
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
                                                <input id="name" name="firstname" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Last name *</label>
                                                <input id="surname" name="lastname" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone *</label>
                                                <input name="phone" type="text" class="form-control">
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
                                    <button type="submit" id="contact" class="btn btn-primary block">Submit</button>

                                    <h2>
                                        
                                </fieldset>
                            </form>
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
