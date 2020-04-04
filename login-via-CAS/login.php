#!/usr/local/bin/php  //needed on Webserve otherwise remove
<?session_start();
if (isset($_POST['login'])) {
	$sid = SID; //Session ID #
	$authenticated = $_SESSION['CAS'];
	//send user to CAS login if not authenticated
	if (!$authenticated) {
	  $_SESSION['CAS'] = true;
	  header("Location: https://cas.iu.edu/cas/login?cassvc=IU&casurl=https://cgi.soic.indiana.edu/~team14/main.php");
	  exit;
	}
	if ($authenticated) {
	  
	  //validate since authenticated
	  if (isset($_GET["casticket"])) {
		//set up validation URL to ask CAS if ticket is good
		$_url = 'https://cas.iu.edu/cas/validate';
		$cassvc = 'IU';  //search kb.indiana.edu for "cas application code" to determine code to use here in place of "appCode"
		$casurl = 'https://cgi.soic.indiana.edu/~team14/main.php'; //same base URLsent
		$params = "cassvc=$cassvc&casticket=$_GET[casticket]&casurl=$casurl";
		$urlNew = "$_url?$params";
		//CAS sending response on 2 lines.  First line contains "yes" or "no".  If "yes", second line contains username (otherwise, it is empty).
		$ch = curl_init();
		$timeout = 5; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $urlNew);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		ob_start();
		curl_exec($ch);
		curl_close($ch);
		$cas_answer = ob_get_contents();
		ob_end_clean();
		
		//split CAS answer into access and user
		list($access,$user) = split("\n",$cas_answer,2);
		$access = trim($access);
		$user = trim($user);
			
		//set user and session variable if CAS says YES
		if ($access == "yes") {
			$_SESSION['user'] = $user;
			echo "Welcome to our home page $user, now we can authorize you with our user database.";
		}
		else {
			echo "CAS ticket validation failed";
		}
	  }
	  else
	  {
		 echo "Reauthenticating";
		 $_SESSION['CAS'] = true;
		 header("Location: https://cas.iu.edu/cas/login?cassvc=IU&casurl=https://cgi.soic.indiana.edu/~team14/main.php");
		 exit;
	  }
	}
}
?>


<!doctype html>
<html lang="en" class="login_page">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="top">
        <div class="align">
            <img id="align_login" src="images/align_white.png" alt="Align Logo">
        </div>
        <div class="slogan">
            <p>This inventory management tool is for use by authorized Event Services personnel.</p>
        </div>
        <div class="signin">
            <form action="" method="POST">
                <button id="sign_in_button" type="submit" name="login" id="login"></button>
            </form>
        </div>
    </div>
    <div class="login_footer">
        <img id="kala_login" src="images/kala_spice.png" alt="KALA Logo">
    </div>

</body>

</html>