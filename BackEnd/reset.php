<?php
include("config.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$password =  $_POST['password'];
$rpassword =  $_POST['rpassword'];
if ($password != $rpassword) {
    	echo "Wrong combination.";
		ob_end_flush();
		flush();
		sleep(5);
		echo '<script language="javascript"> history.go(-1); </script>';
} else {
	$email = $_POST['user_email'];
	$query = "SELECT * FROM Users WHERE Email ='$email'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);
		$sql = "UPDATE Users SET Password='$password' WHERE Email= '$email'";
		if ($conn->query($sql) === TRUE) {
			header( 'Location: ../FrontEnd/login.html' );
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
$conn->close();
?>
