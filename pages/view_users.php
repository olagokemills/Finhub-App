<?php

session_start();
if(isset($_SESSION['admin']))
{

    include "inc/header.php";
    include "../includes/connect.php";
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
                            <a>View All Users</a>
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
                    <div class="ibox-title" height="200px !important">
                        <h5>Posted Records</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>S/n</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Unit</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>';
                          $q = "SELECT * FROM users";
                            $r = mysqli_query($dbc, $q);
                            $num = mysqli_num_rows($r);
                            if($r){

                                $counter = 1;
                             while($row = mysqli_fetch_array($r, MYSQLI_ASSOC) )
                                {

                            echo ' 
                            <tr class="gradeX">
                                <td>'.$counter.'</td>
                                <td>'.$row['firstname'].'</td>
                                <td>'.$row['lastname'].'</td>
                                <td>'.$row['username'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['role'].'</td>
                                <td>'.$row['unit'].'</td>                                
                                <td><a  href="edit_users.php?id='.$row['id'].'" class="text-success">Edit</span></td>
                                <td><a  href="delete_user.php?id='.$row['id'].'" class="text-danger">Delete</a></td>

                             </tr> ';
                             $counter++;

                                }
                            }
               echo'   
                    </tbody>
                
                    </table>
                        </div>

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
