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

		$sql = "UPDATE Users SET Password='$password',FirstName='$firstname',LastName='$lastname',Email='$email', Username='$userName',BirthDate='birthDate' WHERE Username= '$user'";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;

			}
		}
	}
 }
?>
