<?php
	session_start();
	include("config.php");
	mysqli_set_charset($conn,"utf8");
	$photo = $_POST['path'];
	$name = $_POST['autograph_name'];
	$category = $_POST['category'];
	$description = $_POST['story'];
	$obtained = $_POST['Type'];
	$location = $_POST['GeoLoc'];
	$place = $_POST['place'];
	$mention = $_POST['specialM'];
	$trade = $_POST['willing'];
	$number = $_POST['number'];
	$price = $_POST['price'];
	$tags = $_POST['tag'];
	$authenticity = 0;
	$sold = 0;



	 if (($category != 'Sport') And ($category != 'Others') And ($category != 'Movies') And ($category != 'Music')
	  And ($category != 'Authors') And ($category != 'Science')) {
	 	    print('Not a valid category.');
			ob_end_flush();
			flush();
			sleep(3);
			echo '<script language="javascript"> history.go(-1); </script>';
		 }
	else {
	 if (isset($_SESSION['Username']) && $_SESSION['Username'] == true) {
			$user = $_SESSION['Username'];

			$sql = "INSERT INTO  Autograph (`Id`,`Username`, `Name`,`Place`, `Location`, `Object`, `Price`,`Description`,`SpecialMention`, `ExchangeFor`,`ExchangeNr`,`Category`,`Authenticity`, `Sold`,`Path`,`Tags`) VALUES (null,'$user','$name','$place', '$obtained','$location','$price','$description','$mention','$trade','$number','$category','$authenticity','$sold','$photo','$tags')";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: ../FrontEnd/account.html' );
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		}

	}	

?>