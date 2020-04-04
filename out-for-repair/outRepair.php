<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reports</title>
    <!-- Browser Reset -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <nav id="sidenav">
        <ul class="nav_ul">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <li><a href="main.php">Home</a></li>
            <li><a href="checkout.php">Check Out</a></li>
            <li><a href="checkin.php">Check In</a></li>
            <li><a href="reports.php"  class="active">Reports</a></li>
            <li><a href="lost.php">Lost</a></li>
            <li><a href="damaged.php">Damaged</a></li>
            <li><a href="database.php">Database</a></li>
        </ul>
    </nav>

    <div id="main">
        <span class="menu-icon" onclick="openNav()"><i class="fas fa-bars fa-3x"></i><br><span class="menu-icon-title">menu</span></span>

    <header>
        <div class="logout">
            <a href="https://cas.iu.edu/cas/logout">Logout</a>
        </div>
        <div class="logo">
            <a href="main.php"><img id=align_logo src="images/align_white.png" alt="Align Logo"></a>
        </div>
    </header>
<?php
session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
$connection = mysqli_connect("db.sice.indiana.edu", "i494f18_team14","my+sql=i494f18_team14","i494f18_team14");
if(!$connection) {
	die("Can't Connect: " . mysql_error());
}
?>
<div class="container">
<form method='post' action='downloadOutRepair.php'>
<div class="report_top_group">
<h1>Out for Repair</h1>
<div id="downloadBttn" >
<input class="bttn" type='submit' value='Download CSV' name='Export'></input>
</div>
</div>
<table>
<tr>
<th>Equipment ID</th>
<th>Equipment Type</th>
<th>Quantity Damaged</th>
<th>Sent Date</th>
</tr>

<?php
$sql = mysqli_query($connection,"Select d.equipID, eq.type, d.quantityDamaged, d.sentDate, d.empID, d.recievedDate, d.reportDate 
								 From damagedLog as d, equipment as eq, employee as e
								 Where d.sentDate IS NOT NULL and eq.equipID = d.equipID
								 AND d.empID = e.empID AND d.reportDate IS NOT NULL
								 AND d.recievedDate IS NULL
								 ORDER BY d.sentDate");

$user_arr = array(array('Equipment ID', 'Equipment Type', 'Quantity Damaged', 'Sent Date'));

while($record = mysqli_fetch_assoc($sql)) {
	$user_arr[] = array($record['equipID'], $record['type'], $record['quantityDamaged'], $record['sentDate']);
	echo "<tr><td>" . $record['equipID'] . "</td><td>" . $record['type'] . "</td><td>" . $record['quantityDamaged'] . "</td><td>" . $record['sentDate'] . "</td></tr>";	
}
?>
</table>
<?php
$serialize_user_arr = serialize($user_arr);
?>
<textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
</form>

<?php
mysqli_close($connection);

?>
</div>
<footer>
        <img id="kala_login" src="images/kala_white.png" alt="KALA Logo">
        <a href="adminPage.html">Administrator</a>
</footer>
</div>
<!-- javascript for navigation -->
    <script>
        function openNav() {
            document.getElementById("sidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("sidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>
