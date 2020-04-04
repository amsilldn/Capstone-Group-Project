<?php
session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
$connection = mysqli_connect("db.sice.indiana.edu", "i494f18_team14","my+sql=i494f18_team14","i494f18_team14");
if (!$connection) {
die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['removeEmpSQL'])) {
	$id = mysqli_real_escape_string($connection, $_POST['empID']);
	$remove= "UPDATE employee SET Position='Removed' WHERE empID = '" . $id . "'";
	if (mysqli_query($connection, $remove)) {
		echo "Employee Removed from Database!";
		header("location: adminPage.html");
		}else{
			die('SQL Error: ' . mysqli_error($connection));
			}
		
}

?>