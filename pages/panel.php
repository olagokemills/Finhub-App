<?php
session_start();
if(isset($_SESSION['admin']))

{
    include "inc/header.php";
    include "../includes/connect.php";
echo'
<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Recently Added Users</h5>
                                        <div class="ibox-tools">
                                            <span class="label label-warning-light pull-right">Latest</span>
                                           </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">';

                                                    $query = "SELECT * FROM users ORDER BY `id` DESC LIMIT 10";
                                                    $run = mysqli_query($dbc,$query);

                                                    if($run)
                                                    {

                                        while($row = mysqli_fetch_array($run, MYSQLI_ASSOC) )
                                                 {

                                                echo '

                                                <div class="feed-element">
                                                    <div class="media-body ">
                                                        <small class="text-danger">new</small>
                                                        <strong>'.$row['firstname']. ' '. $row['lastname'].'</strong> was Added <br>
                                                        <small class="mb-4">Role: '.$row['role'].' </small>

                                                    </div>
                                                </div>


                                                ';

                                                 }
                                                    
                                             } 
                                             echo '
                                            </div>

                                       </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                       <h5>Recent Records</h5>
                                        <div class="ibox-tools">
                                            <span class="label label-warning-light pull-right">Latest</span>
                                           </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">';

                                                   $query = "SELECT * FROM records ORDER BY `id` DESC LIMIT 10";
                                                    $run = mysqli_query($dbc,$query);

                                                    if($run)
                                                    {

                                        while($row = mysqli_fetch_array($run, MYSQLI_ASSOC) )
                                                 {

                                                echo '

                                                <div class="feed-element">
                                                    <div class="media-body ">
                                                        <strong>'.$row['beneficiary']. ' To be Paid #'. $row['amount'].'</strong><br>
                                                        <small class="">Forecast Date:'.$row['forecastdate'].'</small><br/>
                                                        <small class="text-danger">Payment Status</small>: ' .$row['status'].'

                                                    </div>
                                                </div>
                                                ';

                                                 }
                                             }
                                             echo ' 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Record Statistics</h5>
                        <div class="ibox-tools">
                            <span class="label label-danger pull-right">Filters</span>
                           </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-3">
                                <small class="stats-label">All Records</small>';

                                $query = "SELECT * FROM records ";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'

                                <h4 class="text-danger">'.$num.'</h4>
                            </div>

                            <div class="col-xs-3">
                                <small class="stats-label">Total Paid</small>';

                                $query = "SELECT * FROM records WHERE status='paid'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Pending</small>';

                                $query = "SELECT * FROM records WHERE status='pending'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Overdue</small>';

                                $query = "SELECT * FROM records WHERE status='overdue'";
                                $run = mysqli_query($dbc,$query);

                                $num = mysqli_num_rows($run);

                                echo'
                                <h4 class="text-danger">'.$num.'</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payment Statistics</h5>
                        <div class="ibox-tools">
                            <span class="label label-danger pull-right">Filters</span>
                           </div>
                    </div>
                    <div class="ibox-content fil animated fadeInDown">
                        <div class="row">
                            <div class="col-xs-3">';
                                if(!isset($_POST['filter']))
                                {
                                $query = "SELECT SUM(amount) AS total FROM records ";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);

                                echo'<small class="stats-label">Total Amount </small>

                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                             <div class="col-xs-3">
                                <small class="stats-label">Total Paid</small>';
                                 $query = "SELECT SUM(amount) AS total FROM records WHERE status='paid'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);
                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Pending</small>';
                                $query = "SELECT SUM(amount) AS total FROM records WHERE status='pending'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);
                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Overdue</small>';
                                $query = "SELECT SUM(amount) AS total FROM records WHERE status='overdue'";
                                $run = mysqli_query($dbc,$query);
                                $row = mysqli_fetch_array($run, MYSQLI_ASSOC);
                                echo'
                                <h4 class="text-danger">#'.$row['total'].'</h4>
                            </div>';
                                }else
                                if(isset($_POST['filter'])){
                                    echo "Filter seen!";
                                }
                                echo '
                        </div>
                    </div>

                     <div class="ibox-content result animated slideInLeft">
                        <div class="row">
                            <div class="col-xs-3">
                            <small class="stats-label">Total Amount </small>
                            <h4 class="text-danger">#<b class="total"></b></h4>
                            </div>
                             <div class="col-xs-3">
                                <small class="stats-label">Total Paid</small>
                                <h4 class="text-danger">#<b class="paid"></b></h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Pending</small>
                                <h4 class="text-danger">#<b class="pending"></b></h4>
                            </div>
                            <div class="col-xs-3">
                                <small class="stats-label">Total Overdue</small>
                                <h4 class="text-danger">#<b class="overdue"></b></h4>
                            </div>
                        </div>
                    </div>


                    <h3>Filter</h3>
                    <form class="form-group">

                        <input type="date" name="from" id="from" class="form-control" />

                         <input type="date" name="to" id="to" class="form-control" />

                         <button type="submit" class="btn btn-sm" name="filter" id="filter">Filter</button>

                    </form>
                    <h3 id="filters">Click</h3>
                    fdjdf
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

