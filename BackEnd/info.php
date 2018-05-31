<?php

	function show_account($info) {
		session_start();
		include("config.php");
		mysqli_set_charset($conn,"utf8");
 		if (isset($_SESSION['Username']) && $_SESSION['Username'] == true && $info == 'account'){

 		$user = $_SESSION['Username'];
		$my_query = "SELECT * FROM Users WHERE Username = '$user'";

		$res = mysqli_query($conn, $my_query);

		if($res) {

		    while($data = mysqli_fetch_assoc($res)) {

			        echo '
				    <p>FirstName: '.$data['FirstName'].'</p>
				    <p>LastName: '.$data['LastName'].'</p>
				    <p>Email: '.$data['Email'].'</p>
				    <p>Username: '.$data['Username'].'</p>
				    <p>BirthDate: '.$data['BirthDate'].'</p>
					';
					
		    }
		}
	}
}
?>