<?php
session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
$connection = mysqli_connect("db.sice.indiana.edu", "i494f18_team14","my+sql=i494f18_team14","i494f18_team14");
if (!$connection) {
die("Connection failed: " . mysqli_connect_error());
	}


$changeOptions = $_POST["id"];
$changeChoice = $_POST["changeChoice"];
$changeValue = $_POST["changeValue"];
$sql = "UPDATE employee SET " . $changeChoice . " = '" . $changeValue . "' WHERE " . $changeOptions . " = empID;"; 	
if (mysqli_query($connection, $sql)) {
			$output = "Successfully Checked In!";
			
		}else{
			$output = 'SQL Error: ' . mysqli_error($connection);
		}
	
	
	
	
	
	
?>
    <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Change Employee</title>
    <!-- Browser Reset -->
    <link rel="stylesheet" href="css/normalize.css">
	<script type="text/javascript" src="js/quagga/dist/quagga.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript">
    $(function() {
    	// Create the QuaggaJS config object for the live stream
    	var liveStreamConfig = {
    			inputStream: {
    				type : "LiveStream",
    				constraints: {
    					width: {min: 640},
    					height: {min: 480},
    					aspectRatio: {min: 1, max: 100},
    					facingMode: "environment" // or "user" for the front camera
    				}
    			},
    			locator: {
    				patchSize: "medium",
    				halfSample: true
    			},
    			numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
    			decoder: {
    				"readers":[
                        {"format":"ean_reader","config":{}},
                        {"format":"code_128_reader","config":{}},
                        {"format":"code_39_reader","config":{}},
                        {"format":"upc_reader","config":{}},
                        {"format":"code_93_reader","config":{}}
    				]
    			},
    			locate: true
    		};
    	// The fallback to the file API requires a different inputStream option.
    	// The rest is the same
    	var fileConfig = $.extend(
    			{},
    			liveStreamConfig,
    			{
    				inputStream: {
    					size: 800
    				}
    			}
    		);
    	// Start the live stream scanner when the modal opens
    	$('#livestream_scanner').on('shown.bs.modal', function (e) {
    		Quagga.init(
    			liveStreamConfig,
    			function(err) {
    				if (err) {
    					$('#livestream_scanner .modal-body .error').html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> '+err.name+'</strong>: '+err.message+'</div>');
    					Quagga.stop();
    					return;
    				}
    				Quagga.start();
    			}
    		);
        });

    	// Make sure, QuaggaJS draws frames an lines around possible
    	// barcodes on the live stream
    	Quagga.onProcessed(function(result) {
    		var drawingCtx = Quagga.canvas.ctx.overlay,
    			drawingCanvas = Quagga.canvas.dom.overlay;

    		if (result) {
    			if (result.boxes) {
    				drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
    				result.boxes.filter(function (box) {
    					return box !== result.box;
    				}).forEach(function (box) {
    					Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "red", lineWidth: 2});
    				});
    			}

    			if (result.codeResult && result.codeResult.code) {
    				Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 4});
    			}
    		}
    	});

    	// Once a barcode had been read successfully, stop quagga and
    	// close the modal after a second to let the user notice where
    	// the barcode had actually been found.

    	Quagga.onDetected(function(result) {
		if (result.codeResult.code){
			$('#id').val(result.codeResult.code);
			Quagga.stop();
			setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 500);
		}
	});

    	// Stop quagga in any case, when the modal is closed
        $('#livestream_scanner').on('hide.bs.modal', function(){
        	if (Quagga){
        		Quagga.stop();
        	}
        });

    });
    </script>
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
    <div class="bContainer">
        <div class="changePer">
    <h2>Change Permissions</h2>
    <div class="changePerForm">
    <form action ='#' method='POST'>
	<div class="one"><label for="changeOptions">Employee ID: </label><input type=text name="id" id="id" size="54" />
	<button class="btn" type="button" id="button" data-toggle="modal" data-target="#livestream_scanner">
	<i class="fas fa-barcode"></i>
    </button>
   

</select></div>
<div class="two"><label for="changeChoice">Field to be Changed: </label><select name="changeChoice">
<option value="empID">Employee ID</option>
<option value="firstName">First Name</option>
<option value="lastName">Last Name</option>
<option value="Position">Position</option>

</select></div>
<div class="three"><label for="changeValue">Field Change Value: </label><input type="text" name="changeValue" size="54"></div>

<div class="sButton"><button class="bttn" type="submit" name="changeEmpValues" id="changeEmpValues">Change Employee</button></div>
</form></div>
</div>
<div class="modal" id="livestream_scanner">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<div class="modal-body" style="position: static">
        				<div id="interactive" class="viewport"></div>
        				<div class="error"></div>
        			</div>
                </div>
        		</div>
        	</div>
        	</div>
</div><footer>
<img id="kala_login" src="images/kala_white.png" alt="KALA Logo">
    <a href="adminPage.html">Administrator</a>
</footer></div>


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