<?php
	session_start();
	if($_SESSION['CAS'] == false){
	header("Location: https://cgi.soic.indiana.edu/~team14/login.php");
}
	//create connection to database
	$connection = mysqli_connect("db.sice.indiana.edu", "i494f18_team14","my+sql=i494f18_team14","i494f18_team14");
	if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
	}
	
	
	if (isset($_POST['damaged'])) {
		//set all the variables once the submit button is clicked
		$id = mysqli_real_escape_string($connection, $_POST['id']);
		$emp = mysqli_real_escape_string($connection, $_POST['emp']);
		$quant = mysqli_real_escape_string($connection, $_POST['quant']);
		
				//get the requested employee, and see if that's in the database
		$get_emp = mysqli_query($connection, "SELECT empID FROM employee WHERE empID = '" . $emp . "'");
		$emp_result = mysqli_fetch_assoc($get_emp)['empID'];
	
		//get the requested equipment ID to see if that is also in the database
		$get_equip = mysqli_query($connection, "SELECT equipID FROM equipment WHERE equipID = '" . $id . "'");
		$equip_result = mysqli_fetch_assoc($get_equip)['equipID'];
		
		//error handling in case the user enters in anything invalid
		try {
			//if they try to enter an employee ID that doesn't exist
			if ($emp_result == 0){
				$output = "Employee not in database";
			}
			//or if they try to enter an equipment ID that doesn't exist
			else if ($equip_result == 0){
				$output = "Equipment ID not in database";
			}
			//otherwise, go ahead and insert the record into the checkout log, with the current date stamp
			else {
				$damage = "INSERT INTO damagedLog(equipID, empID, reportDate) VALUES('" . $id . "', '" . $emp . "',NOW())";
				if (mysqli_query($connection, $damage)) {
					$output = "It worked!";
				}
				else{
					die('SQL Error: ' . mysqli_error($connection)); 
				}
			}
		} 
		catch (Exception $e) {
			$output = 'Please enter valid values';

		}
		
		
		
		/*
		$damage = "INSERT INTO damagedLog(equipID, empID, reportDate) VALUES('" . $id . "', '" . $emp . "',NOW())";
		if (mysqli_query($connection, $damage)) {
			$output = "It worked!";
		}
		else{
			die('SQL Error: ' . mysqli_error($connection)); 
		}*/
	}
	
	if (isset($_POST['sent'])) {
		//set all the variables once the submit button is clicked
		$id = mysqli_real_escape_string($connection, $_POST['id']);
		$emp = mysqli_real_escape_string($connection, $_POST['emp']);
		$quant = mysqli_real_escape_string($connection, $_POST['quant']);
		

		$get_emp = mysqli_query($connection, "SELECT empID FROM employee WHERE empID = '" . $emp . "'");
		$emp_result = mysqli_fetch_assoc($get_emp)['empID'];
	
		//get the requested equipment ID to see if that is also in the database
		$get_equip = mysqli_query($connection, "SELECT equipID FROM equipment WHERE equipID = '" . $id . "'");
		$equip_result = mysqli_fetch_assoc($get_equip)['equipID'];
		//error handling in case the user enters in anything invalid
		try {
			//if they try to enter an employee ID that doesn't exist
			if ($emp_result == 0){
				$output = "Employee not in database";
			}
			//or if they try to enter an equipment ID that doesn't exist
			else if ($equip_result == 0){
				$output = "Equipment ID not in database";
			}

			//otherwise, go ahead and insert the record into the checkout log, with the current date stamp
			else {
				$sent = "UPDATE damagedLog
						   SET sentDate = NOW()
						   WHERE equipID = '" . $id . "'
						   AND reportDate IS NOT NULL AND recievedDate IS NULL";
				
				if (mysqli_query($connection, $sent)) {
					$output = "It worked!";
				}
				else{
					die('SQL Error: ' . mysqli_error($connection)); 
				}
			}
		} 
		catch (Exception $e) {
			$output = 'Please enter valid values';

		}
		/*sent = "UPDATE damagedLog
				   SET sentDate = NOW()
				   WHERE equipID = '" . $id . "'
				   AND reportDate IS NOT NULL AND recievedDate IS NULL";
		
		if (mysqli_query($connection, $sent)) {
			$output = "It worked!";
		}
		else{
			die('SQL Error: ' . mysqli_error($connection)); 
		}
		*/
	}
	
	if (isset($_POST['repaired'])) {
		//set all the variables once the submit button is clicked
		$id = mysqli_real_escape_string($connection, $_POST['id']);
		$emp = mysqli_real_escape_string($connection, $_POST['emp']);
		$quant = mysqli_real_escape_string($connection, $_POST['quant']);
		
				//so first see how many of the item we own
		$get_quant = mysqli_query($connection, "SELECT quantityOwned FROM equipment WHERE equipID = '" . $id . "'");
		$quantity_owned = mysqli_fetch_assoc($get_quant)['quantityOwned'];
		
				//get the requested employee, and see if that's in the database
		$get_emp = mysqli_query($connection, "SELECT empID FROM employee WHERE empID = '" . $emp . "'");
		$emp_result = mysqli_fetch_assoc($get_emp)['empID'];
	
		//get the requested equipment ID to see if that is also in the database
		$get_equip = mysqli_query($connection, "SELECT equipID FROM equipment WHERE equipID = '" . $id . "'");
		$equip_result = mysqli_fetch_assoc($get_equip)['equipID'];
		//error handling in case the user enters in anything invalid
		try {
						//if they try to enter an employee ID that doesn't exist
			if ($emp_result == 0){
				$output = "Employee not in database";
			}
			//or if they try to enter an equipment ID that doesn't exist
			else if ($equip_result == 0){
				$output = "Equipment ID not in database";
			}
			//otherwise, go ahead and insert the record into the checkout log, with the current date stamp
			else {
				$repair = "UPDATE damagedLog
						   SET recievedDate = NOW()
						   WHERE equipID = '" . $id . "'
						   AND reportDate IS NOT NULL AND sentDate IS NOT NULL";
				
				if (mysqli_query($connection, $repair)) {
					$output = "It worked!";
				}
				else{
					die('SQL Error: ' . mysqli_error($connection)); 
				}
			}
		} 
		catch (Exception $e) {
			$output = 'Please enter valid values';

		}	
		
		/*
		$repair = "UPDATE damagedLog
				   SET recievedDate = NOW()
				   WHERE equipID = '" . $id . "'
				   AND reportDate IS NOT NULL AND sentDate IS NOT NULL";
		
		if (mysqli_query($connection, $repair)) {
			$output = "It worked!";
		}
		else{
			die('SQL Error: ' . mysqli_error($connection)); 
		}
		*/
	}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Radio Damaged</title>
    <!-- Browser Reset -->
    <link rel="stylesheet" href="css/normalize.css">
		<!-- javascript libraries -->
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
    				Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: "red", lineWidth: 4});
    			}
    		}
    	});

    	// Once a barcode had been read successfully, stop quagga and
    	// close the modal after a second to let the user notice where
    	// the barcode had actually been found.
    	var first = "";
	//console.log(first);
	$("#button").click(function(){
	first = "cameraButton1";
	});
	$("#button2").click(function(){
	first = "cameraButton2";
	});
    	Quagga.onDetected(function(result) {
		if (result.codeResult.code && first == "cameraButton1"){
			$('#id').val(result.codeResult.code);
			Quagga.stop();
			setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 500);
		}
		else if(result.codeResult.code && first == "cameraButton2"){
			$('#emp').val(result.codeResult.code);
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

    	// Call Quagga.decodeSingle() for every file selected in the
    	// file input
    	$("#livestream_scanner input:file").on("change", function(e) {
    		if (e.target.files && e.target.files.length) {
    			Quagga.decodeSingle($.extend({}, fileConfig, {src: URL.createObjectURL(e.target.files[0])}), function(result) {alert(result.codeResult.code);});
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
    <div class="bContainer">
        <div class="rdamagedForm">
            <h2>Damaged Equipment</h2>
            <h4>Fill out all fields.</h4>
            <div class="damagedButtons">
            <form action="radioDamaged.php" method="POST">
                <div class="one">
                <label for="id">ID #: </label><input type=text name="id" id="id" size="56" />
				<button class="btn" type="button" id="button" data-toggle="modal" data-target="#livestream_scanner">
								<i class="fas fa-barcode"></i>
							</button>
            </div>
            <div class="two">
                <label for="emp">Employee ID#: </label><input type=text name="emp" id="emp" size="50" /> 
				<button class="btn" type="button" id="button2" data-toggle="modal" data-target="#livestream_scanner">
								<i class="fas fa-barcode"></i>
							</button>
							<br><p>(Employee who is filling out this form)</p>
            </div>
			<div> <?php echo $output; ?> </div>
                <div class="sButtons">
                            <div class="b1d">
                                <button class="bttn" type="submit" name="damaged" id="damaged">Report Damaged</button>
                            </div>
                                <div class="b2d">
                                    <button class="bttn" type="submit" name="sent" id="sent">Report Sent Out</button>
                                </div>
                                <div class="b3d">
                                    <button class="bttn" type="submit" name="repaired" id="repaired">Report Repaired</button>
                                </div>
                            </div>
            </form>
			</div>
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