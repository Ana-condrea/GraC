<?php

	function show($category) {
		include("config.php");
		mysqli_set_charset($conn,"utf8");

		$cat_query = "SELECT * FROM Autograph WHERE Category = '$category'";

		$res = mysqli_query($conn, $cat_query);

		if($res) {

		    while($data = mysqli_fetch_assoc($res)) {

		        echo '<div class="content">
	        	<img src="../FrontEnd/img/'.$data['Path'].'" alt="'.$data['Name'].'">
	        	<h3>'.$data['Name'].':</h3>
	        	<p>'.$data['Description'].'</p>
			    <p>Obtaied at: '.$data['Place'].'</p>
			    <p>Geographic location: '.$data['Location'].'</p>
			    <p>Placed on: '.$data['Object'].'</p>
			    <p>Special mention: '.$data['SpecialMention'].'</p>
			    <p>Willing to trade for: '.$data['ExchangeFor'].' in number of: '.$data['ExchangeNr'].'</p>
			    <p>Price: <b class="price">'.$data['Price'].'</b></p>
			    <button type="button">Buy</button>
			    <button type="button">Trade</button>
				</div>';
		    }
		}
	}
?>