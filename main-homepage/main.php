<?php
session_start();
if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Main</title>
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
            <li><a href="main.php"  class="active">Home</a></li>
            <li><a href="checkout.php">Check Out</a></li>
            <li><a href="checkin.php">Check In</a></li>
            <li><a href="reports.php">Reports</a></li>
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

<div class="container">
    <div class="main">
        <div class="mainForm">
            <form action="checkout.php" method="POST">
    <button id="close-CSS1" type="submit" name="checkout" value="checkout"></button>
</form>
<form action="checkin.php" method="POST">
    <button id="close-CSS2" type="submit" name="checkin" value="checkin"></button>
</form>
<form action="reports.php" method="POST">
    <button id="close-CSS3" type="submit" name="reports" value="reports"></button>
</form>
<form action="lost.php" method="POST">
    <button id="close-CSS4" type="submit" name="lost" value="lost"></button>
</form>
<form action="damaged.php" method="POST">
    <button id="close-CSS5" type="submit" name="damaged" value="damaged"></button>
</form>
<form action="database.php" method="POST">
    <button id="close-CSS6" type="submit" name="database" value="login"></button>
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
