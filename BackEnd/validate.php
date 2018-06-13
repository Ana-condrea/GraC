<?php
	include("config.php");
	$id = $_POST['id'];	

	$query = "UPDATE Autograph SET Authenticity = 1 WHERE Id = '$id'";
	$result = mysqli_query($conn,$query);

	if($result === FALSE) {
		die(mysqli_error($conn));
	}

	header( 'Location: http://www.autographcoll.com/FrontEnd/Al.html' );
?>
