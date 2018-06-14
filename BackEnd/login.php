<?php
	session_start();
	include("config.php");

  	$user = $_POST['user'];
  	$pwd = $_POST['password'];

  	$query = $conn->prepare('SELECT Username, Password FROM Users WHERE Username = ?');
	$query->bind_param('s', $user);
	$query->execute();

	$result = $query->get_result();

	if (mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);

		if(password_verify($pwd, $row['Password'])) {
			$_SESSION['loggedin'] = true;
			$_SESSION['Username'] = $user;
			header( 'Location: ../FrontEnd/Proiect.html' );
		} else {
			echo "Wrong password.";
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
		}
	}
?>
