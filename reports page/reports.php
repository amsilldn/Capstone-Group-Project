<?php
	session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
	$connection = mysqli_connect("db.soic.indiana.edu", "i494f18_akdatar","my+sql=i494f18_akdatar","i494f18_akdatar");
	if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
	}
	
	if (isset($_POST['checkedOut_equip'])) {
		header("location:checkedOut_equip.php");//redirect to CHECKED OUT EQUIPMENT page.
	}
	
	if (isset($_POST['empCheckOut'])) {
		header("location:empCheckOut.php");//redirect to WHO HAS WHAT CHECKED OUT page.
	}
	
	if (isset($_POST['checkOutHist'])) {
		header("location:checkout_history.php");//redirect to CHECK OUT HISTORY page.
	}
	
	if (isset($_POST['inventory'])) {
		header("location:inventory.php");//redirect to CHECKED OUT EQUIPMENT page.
	}
	
	if (isset($_POST['locCheckOut'])) {
		header("location:locCheckOut.php");//redirect to WHO HAS WHAT CHECKED OUT page.
	}
	
	if (isset($_POST['lostReport'])) {
		header("location:lostReport.php");//redirect to CHECK OUT HISTORY page.
	}
	
	if (isset($_POST['notCheckedOut'])) {
		header("location:notCheckedOut.php");//redirect to WHO HAS WHAT CHECKED OUT page.
	}
	
	if (isset($_POST['damagedReport'])) {
		header("location:damagedReport.php");//redirect to CHECK OUT HISTORY page.
	}
	
	if (isset($_POST['outRepair'])) {
		header("location:outRepair.php");//redirect to CHECK OUT HISTORY page.
	}
?>
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

    <!-- 
<form action="reports.php" method="POST">
		<h1>Reports Page</h1>
		<!~~Example<button type="submit" name="Sweater_Vest" value="Sweater Vest">~~>
		<button type="submit" name="checkedOut_equip" value="checkedOut_equip">Checked Out Equipment</button>
        <button type="submit" name="empCheckOut" value="empCheckOut">Checked Out Equipment By Employee</button>
		<!~~THESE DON'T WORK...YET!!!
        <button type="submit" name="inventory" id="inventory">Inventory</button>   
        <button type="submit" name="locCheckOut" id="locCheckOut">Checked Out Equipment By Location</button>
        <button type="submit" name="notCheckedOut" id="notCheckedOut">Equipment Not Checked Out</button>
        <button type="submit" name="checkOutHist" id="checkOutHist">Equipment Checkout History</button>
        <button type="submit" name="lostReport" id="lostReport">Lost Equipment</button>
        <button type="submit" name="damagedReport" id="damagedReport">Damaged Equipment</button>
        <button type="submit" name="outRepair" id="outRepair">Out for Cleaning/Repair</button>
		~~>
    </form>
 -->
    
    <div class="container">
        <div class="reports">
            <div class="reportButtons">
                <form action="reports.php" method="POST">
                    <button id="close-CSS12" type="submit" name="inventory" value="inventory"></button>
                    <button id="close-CSS13" type="submit" name="checkedOut_equip" value="checkedOut_equip"></button>
                    <button id="close-CSS14" type="submit" name="empCheckOut" value="empCheckOut"></button>
                    <button id="close-CSS15" type="submit" name="locCheckOut" value="locCheckOut"></button>
                    <button id="close-CSS16" type="submit" name="notCheckedOut" value="notCheckedOut"></button>
                    <button id="close-CSS17" type="submit" name="checkOutHist" value="checkOutHist"></button>
                    <button id="close-CSS18" type="submit" name="lostReport" value="lostReport"></button>
                    <button id="close-CSS19" type="submit" name="damagedReport" value="damagedReport"></button>
                    <button id="close-CSS20" type="submit" name="outRepair" value="outRepair"></button>
                </form>
            </div>
        </div>
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