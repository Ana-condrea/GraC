<?php
	session_start();
	include("config.php");
	$id = $_POST['id'];


		if (isset($_SESSION['Username']) && $_SESSION['Username'] == true) {
		
			$user = $_SESSION['Username'];
			$query = "SELECT Username FROM Autograph WHERE Id ='$id'";
			$result = mysqli_query($conn, $query);

			if($result === FALSE) { 
				die(mysqli_error($conn)); 
			}
			
			$query = "DELETE FROM Autograph WHERE Username = '$user' and Id= '$id'";
			$result = mysqli_query($conn,$query);
			header( 'Location: ../FrontEnd/account.html' );
		}
?>
