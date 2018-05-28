<?php
	include("config.php");
	session_start();


	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

  	$user = $_POST['user'];
  	$pwd = $_POST['password'];

  	$query = "SELECT * FROM Users WHERE Username ='$user'";

	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);

		if($pwd != $row['Password']) {
			echo "Wrong password.";
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
		} else {
			$_SESSION['loggedin'] = true;
			header( 'Location: http://www.autographcoll.com/FrontEnd/Proiect.html' );
		}
	}
?>
