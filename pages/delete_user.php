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

		if($_SERVER['REQUEST_METHOD'] == 'POST')
				{
					$md = $_POST['md'];
					if($_POST['sure'] =='Yes')
					{
						$q = "DELETE FROM users WHERE id='$md'";
						$r = mysqli_query($dbc, $q);
						if($r)
							{
								echo"<p align=\"center\" style=\"color:blue\"><font face=\"comic sans ms\" size=\"4\">User Removed successfully</font><br />
								<a href=\"view_users.php\" style=\"color:blue\" ><font face=\"comic sans ms\" size=\"3\">Click here </font></a></p>";
							}
					}
						if($_POST['sure'] == 'No')
					{
						header("Location: view_users.php");
					}
					
					
				}
				else
				{
				
					if(isset($_GET['id']))
					{
						$mid = $_GET['id'];
					}
					else
					{
						echo"<p align=\"center\" style=\"color:#C00\"><font face=\"comic sans ms\" size=\"4\">Page accessed in error</font><br /></p>";
						exit();
					}
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

			      <br /><br />
						<form action="" method="post">
						<p align="center"><font size="3">Do you really want to delete this User?</font><br />
						<input type="radio" name="sure" value="Yes" />Yes&nbsp&nbsp
						<input type="radio" name="sure" value="No" />No<br /><br />
						<input type="hidden" name="md" value="'.$mid.'" /></p>
						<p align="center">
						<input class="form-control" type="submit" value="submit" style="width:150px" /><br />
						</p>
						</form>
					';
				}
		}else{

			echo "There was an error, please try again";
		}

				?>

	

 <?php include 'inc/footer.php';

}
else{

	header("Location:index.php");
}
?>