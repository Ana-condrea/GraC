<?php
session_start();
include("config.php");
	mysqli_set_charset($conn,"utf8");

	$password =  $_POST['password'];
	$firstname = $_POST['name'];
	$lastname = $_POST['lname'];
	$email = $_POST['user_email'];
	$userName = $_POST['user_name'];
	$birthDate =  $_POST['date_birth'];
	$money = $_POST['money'];
	$path = $_POST['apath'];

 	if (isset($_SESSION['Username']) && $_SESSION['Username'] == true){
 	$user = $_SESSION['Username'];
	$query = "SELECT * FROM Users WHERE Username ='$userName'";

	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) >= 1) {
		echo 'Username already in use.';
		ob_end_flush();
		flush();
		sleep(3);
		echo '<script language="javascript"> history.go(-1); </script>';
		
	} else {
		$query = "SELECT * FROM Users WHERE Email ='$email'";

		$result = mysqli_query($conn,$query);
		if (mysqli_num_rows($result) >= 1) {
			echo 'Email already in use.';
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
			
		} else {
			if ($password != NULL)
			{
			$sql = "UPDATE Users SET Password='$password' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}
			if ($firstname != NULL)
			{
			$sql = "UPDATE Users SET FirstName='$firstname' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}
			if ($lastname != NULL)
			{
			$sql = "UPDATE Users SET LastName='$lastname' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}
			if ($email != NULL)
			{
			$sql = "UPDATE Users SET Email='$email' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}
			if ($userName != NULL)
			{
			$sql = "UPDATE Users SET Username='$userName' WHERE Username= '$user'";
			$sql1 = "UPDATE Autograph SET Username='$userName' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE ) {
				header( 'Location: ../FrontEnd/login.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}

			if ($birthDate != NULL)
			{
			$sql = "UPDATE Users SET BirthDate='$birthDate' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}

			if ($money != NULL)
			{
			$sql = "UPDATE Users SET Money='$money' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}

			if ($path != NULL)
			{
			$sql = "UPDATE Users SET Path='$path' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
			}
		}
	}
 }
?>
