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
			mail($email, "Bine ai venit!", "Multumim ca te-ai alaturat Autograph Collector.");

			$sql = "INSERT INTO Users (`Id`, `FirstName`, `LastName`, `Email`, `Username`, `Password`, `Attention`, `BirthDate`) VALUES (null,'$firstname','$lastname','$email','$userName','$password','$attention','$birthDate')";

			if ($conn->query($sql) === TRUE) {
				header( 'Location: http://www.autographcoll.com/FrontEnd/login.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

$conn->close();
?>