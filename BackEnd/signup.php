<?php
include("config.php");

$password =  $_POST['password'];
$rpassword =  $_POST['rpassword'];

if ($password != $rpassword) {
    print("Passwords aren't the same.");
	ob_end_flush();
	flush();
	sleep(3);
	echo '<script language="javascript"> history.go(-1); </script>';
} else {

	$firstname = $_POST['name'];
	$lastname = $_POST['lname'];
	$email = $_POST['user_email'];
	$userName = $_POST['user_name'];
	$attention =  0;
	$birthDate =  $_POST['date_birth'];

	$query = $conn->prepare('SELECT * FROM Users WHERE Username = ?');
	$query->bind_param('s', $userName);
	$query->execute();

	$result = $query->get_result();

	if($result === FALSE) {
		die(mysqli_error($conn));
	}

	if (mysqli_num_rows($result) >= 1) {
		echo 'Username already in use.';
		ob_end_flush();
		flush();
		sleep(3);
		echo '<script language="javascript"> history.go(-1); </script>';
		
	} else {
		$query = $conn->prepare('SELECT * FROM Users WHERE Email = ?');
		$query->bind_param('s', $email);
		$query->execute();

		$result = $query->get_result();
		if (mysqli_num_rows($result) >= 1) {
			echo 'Email already in use.';
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
			
		} 

		$query = $conn->prepare('SELECT * FROM RestrictedUsers WHERE Email = ?');
		$query->bind_param('s', $email);
		$query->execute();

		$result = $query->get_result();
		if (mysqli_num_rows($result) >= 1) {
			echo 'You are not allowed to make an account.';
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
			
		} else {
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$sql = $conn->prepare("INSERT INTO Users (`Id`, `FirstName`, `LastName`, `Email`, `Username`, `Password`, `Attention`, `BirthDate`) VALUES (null,?,?,?,?,?,?,?)");

			$sql->bind_param('sssssis', $firstname, $lastname, $email, $userName, $hashed_password, $attention, $birthDate);
			
			if ($sql->execute()) {
				header( 'Location: http://www.autographcoll.com/FrontEnd/login.html' );
			} else {
				echo "Error: INSERT INTO Users (`Id`, `FirstName`, `LastName`, `Email`, `Username`, `Password`, `Attention`, `BirthDate`) <br>" . $conn->error;
			}
		}
	}
}

$conn->close();
?>
