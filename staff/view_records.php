<?php
session_start();
if(isset($_SESSION['staff']))
{
    include "inc/header.php";
    include "../includes/connect.php";
echo'
<div class="wrapper wrapper-content">
                 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>Staff Member</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="view_records.php">Records</a>
                        </li>
                        <li>
                            <a>View All Posted Records</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                <form class="form-group" method="POST" action="range.php">
                    <label>From</label>
                     <input class="form-control" type="date" name="from"/>
                    <label>To</label>
                    <input class="form-control" type="date" name="to" /><br />
                    <button type="submit" name="range" class="btn btn-danger block">Range</button>
                </form>
                </div>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">';
                   


                          $q = "SELECT * FROM records";            

                            $r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
                            
                    echo '
                            
                    <div class="ibox-title" height="200px !important">
                        <h5>All Posted Records</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>S/n</th>
                        <th>Beneficiary</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Entry Date</th>
                        <th>Forecast Date</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Unit</th>
                    </tr>
                    </thead>
                    <tbody>';
                    
                            if($r){

                         $counter = 1;

                         while($row = mysqli_fetch_array($r, MYSQLI_ASSOC) )
                                {

                            echo ' 
                            <tr class="gradeX">

                                <td>'.$counter.'</td>
                                <td>'.$row['beneficiary'].'</td>
                                <td>'.$row['amount'].'</td>
                                <td>'.$row['description'].'</td>
                                <td>'.$row['entrydate'].'</td>
                                <td>'.$row['forecastdate'].'</td>
                                <td>'.$row['paydate'].'</td>
                                <td>'.$row['status'].'</td>
                                <td>'.$row['unit'].'</td>

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
    </div>


<!-- Modal for Deleting -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
                        <p align="center"><font size="3">Do you really want to delete this Record?</font><br />
                        <input type="radio" name="sure" value="Yes" />Yes&nbsp&nbsp
                        <input type="radio" name="sure" value="No" />No<br /><br />
                        <input type="hidden" name="id" id="id" /></p>
                        <p align="center">
                        <input class="form-control btn btn-primary" type="submit" name="deletee" value="submit" style="width:150px" /><br />
                        </p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal for editing -->

<!-- Modal for Editing -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Record </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" class="form-horizontal">
       <div class="form-group">
            <label for="recipient-name" class="col-form-label">Beneficiary:</label>
            <input type="text" class="form-control" id="beneficiary" name="beneficiary">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount">
        </div>
        <input name="record_id" id="record_id" class="form-control" type="hidden" />
        <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Entry Date:</label>
            <input type="text" class="form-control" id="entrydate" name="entrydate" placeholder="DD/MM/YYYY">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Payment Date:</label>
            <input type="text" class="form-control" id="paydate" name="paydate" placeholder="DD/MM/YYYY">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Payment Status:</label>
        <select class="form-control m-b" name="status">
        <option value="nill">SELECT AN OPTION</option>
        <option value="pending">Pending</option>
        <option value="due">Due</option>
        <option value="paid">Paid</option>
        <option value="overdue">OverDue</option>
         </select>
         </div>

          <button class="btn btn-primary" type="submit" name="updatee">Save Changes</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';

     include 'inc/footer.php';

}
else{
    header("Location:index.php");
}
