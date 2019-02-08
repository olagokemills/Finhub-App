<?php


if($_SERVER['REQUEST_METHOD'] == "POST")
{
	require "../includes/connect.php";

	 $from = $_POST['from'];

	 $from = str_replace("-","/", $from);
	 $from = date('d/m/Y',strtotime($from));

	 $to = $_POST['to'];

	 $to = str_replace("-","/", $to);
	 $to = date('d/m/Y',strtotime($to));

	 // echo $from .' '. $to;


// define the array that will contain all result sets
$array = [];

// create an array for the result set coming from table 1
$array['all']= [];

	 $q = "SELECT SUM(amount) AS total FROM records WHERE forecastdate BETWEEN '$from' AND '$to'";
	$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $array['all'][] = $row;        


$array['paid']= [];

	 $q = "SELECT SUM(amount) AS total FROM records WHERE forecastdate BETWEEN '$from' AND '$to' AND status='paid'";
	$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $array['paid'][] = $row;

$array['pending']= [];

	 $q = "SELECT SUM(amount) AS total FROM records WHERE forecastdate BETWEEN '$from' AND '$to' AND status='pending'";
	$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $array['pending'][] = $row;

$array['overdue']= [];

	 $q = "SELECT SUM(amount) AS total FROM records WHERE forecastdate BETWEEN '$from' AND '$to' AND status='overdue'";
	$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $array['overdue'][] = $row;


// return the results formatted as json
echo json_encode($array);


}

?>