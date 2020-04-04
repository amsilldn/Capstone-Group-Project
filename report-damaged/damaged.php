<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Damaged</title>
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
            <li><a href="reports.php">Reports</a></li>
            <li><a href="lost.php">Lost</a></li>
            <li><a href="damaged.php"  class="active">Damaged</a></li>
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

    <div class="container">
        <div class="eqForm">
            <div class="eqButtons">
            <form action="#" method="POST">
                <button class="close-CSS7" type="submit" name="radio" id="radio"></button>
                <button class="close-CSS8" type="submit" name="polo" id="polo"></button>
                <button class="close-CSS9" type="submit" name="vest" id="vest"></button>
                <button class="close-CSS10" type="submit" name="jacket" id="jacket"></button>
                <button class="close-CSS11" type="submit" name="blazer" id="blazer"></button>
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

<?php
session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
	if (isset($_POST['radio'])) {
		$apparel = $_POST['radio'];
		$_SESSION['apparel'] = $apparel;
		header("location:radioDamaged.php");
	}
	
	
	else if (isset($_POST['vest'])) {
		$apparel = $_POST['vest'];
		$_SESSION['apparel'] = $apparel;
		header("location:apparelDamaged.php");
	}
	
	else if (isset($_POST['jacket'])) {
		$apparel = $_POST['jacket'];
		$_SESSION['apparel'] = $apparel;
		header("location:apparelDamaged.php");
	}
	
	else if (isset($_POST['blazer'])) {
		$apparel = $_POST['blazer'];
		$_SESSION['apparel'] = $apparel;
		header("location:apparelDamaged.php");
	}
	
	else if (isset($_POST['polo'])) {
		$ReportLost = $_POST['polo'];
		$_SESSION['ReportLost'] = $ReportLost;
		header("location:apparelDamaged.php");
	}

?>
