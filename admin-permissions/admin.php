<?php
	session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
	$connection = mysqli_connect("db.sice.indiana.edu", "i494f18_team14","my+sql=i494f18_team14","i494f18_team14");
	if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
	}
	
	if (isset($_POST['addEmp'])) {
		header("location:adminAddEmployee.php");//redirect to this page
	}
	
	if (isset($_POST['removeEmp'])) {
		header("location:adminRemoveEmployee.php");//redirect to this page
	}
	if (isset($_POST['changeEmp'])) {
		header("location:adminChangeEmployee.php");
	}
?>

