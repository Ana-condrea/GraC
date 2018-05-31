<?php
	session_start();
	include("config.php");
	$id = $_POST['id'];

		if (isset($_SESSION['Username']) && $_SESSION['Username'] == true) {
		
			$user = $_SESSION['Username'];
			$query = "SELECT Username, Authenticity FROM Autograph WHERE Id ='$id'";
			$result = mysqli_query($conn, $query);

			if($result === FALSE) { 
				die(mysqli_error($conn)); 
			}
			
			if (mysqli_num_rows($result) >= 1) {
				while($row = mysqli_fetch_array($result)){

					if($row['Authenticity'] == 0) {
						echo 'The autograph has not been authenticated yet.';
						ob_end_flush();
						flush();
						sleep(3);
						echo '<script language="javascript"> history.go(-1); </script>';
						exit();
					}
				}
			}

			$query = "UPDATE Autograph SET  Sold = 1 WHERE Username ='$user' and Id = '$id'";
			$result = mysqli_query($conn,$query);
			header( 'Location: http://www.autographcoll.com/FrontEnd/account.html' );
		}
?>