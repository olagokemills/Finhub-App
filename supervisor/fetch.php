<?php


include "../includes/connect.php";

if(isset($_POST['id']))

{

	$id = $_POST['id']; 

	$query = "SELECT * FROM records WHERE  id='$id' ";

	$result = mysqli_query($dbc, $query);

	$row = mysqli_fetch_array($result);

	echo json_encode($row);
}


?>