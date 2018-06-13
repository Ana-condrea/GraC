<?php

	function show_path($info) {
		session_start();
		include("config.php");
		mysqli_set_charset($conn,"utf8");
 		if (isset($_SESSION['Username']) && $_SESSION['Username'] == true && $info == 'path'){

 		$user = $_SESSION['Username'];
		$my_query = "SELECT * FROM Users WHERE Username = '$user'";

		$res = mysqli_query($conn, $my_query);

		if($res) {

		    while($data = mysqli_fetch_assoc($res)) {

			        echo '
			        <div class="container">
  					<img src="../FrontEnd/img/'.$data['Path'].'" alt="Avatar" class="image">
  					<div class="overlay">
   					<a href= "../FrontEnd/setting.html"  class="text" >Change photo</a>
    				</div>
   					</div> 
				    ';
					
		    }
		}
	}
}
?>