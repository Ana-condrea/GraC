<?php
	session_start();
	include("config.php");
	$id = $_POST['id'];

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
		echo 'You are not logged in.';
		ob_end_flush();
		flush();
		sleep(3);
		echo '<script language="javascript"> history.go(-1); </script>';
	} else {
		if (isset($_SESSION['Username']) && $_SESSION['Username'] == true) {
		
			$user = $_SESSION['Username'];
			$query = "SELECT Username, Authenticity,ExchangeFor,ExchangeNr FROM Autograph WHERE Id ='$id'";
			$result = mysqli_query($conn, $query);

			if($result === FALSE) { 
				die(mysqli_error($conn)); 
			}
			
			if (mysqli_num_rows($result) >= 1) {
				while($row = mysqli_fetch_array($result)){
					if($user == $row['Username']) {
						echo 'You are already the owner of the autograph.';
						ob_end_flush();
						flush();
						sleep(3);
						echo '<script language="javascript"> history.go(-1); </script>';
						exit();
					}
					else {
						$row1 = $row['ExchangeFor'];
						$query1 = "SELECT * FROM Autograph WHERE Username ='$user' AND Name = '$row1' ";
						$result1 = mysqli_query($conn, $query1);
								if($result1 === FALSE) { 
										die(mysqli_error($conn)); 
									}
								$count = 0;
								if (mysqli_num_rows($result1) >= 1) {
									while($rows = mysqli_fetch_array($result1)){
											$count = $count + 1;
									}
								}
						if ( $count != $row['ExchangeNr']){
						echo 'Not enough items';
						ob_end_flush();
						flush();
						sleep(3);
						echo '<script language="javascript"> history.go(-1); </script>';
						exit();
						}

						if($rows['Authenticity'] == 0) {
						echo 'The autograph has not been authenticated yet.You can not trade it.';
						ob_end_flush();
						flush();
						sleep(3);
						echo '<script language="javascript"> history.go(-1); </script>';
						exit();
					}
					}
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

			$query = "UPDATE Autograph SET Username ='$user', Sold = 0 WHERE Id = '$id'";
			$result = mysqli_query($conn,$query);
			header( 'Location: ../FrontEnd/account.html' );
		}
	}
?>