<?php
	session_start();
	include("config.php");

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
			$_SESSION['Username'] = $user;
			header( 'Location: http://www.autographcoll.com/FrontEnd/Proiect.html' );
		}
	}
?>
