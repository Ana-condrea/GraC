<?php
	include("config.php");
	mysqli_set_charset($conn,"utf8");

	$cat_query = "SELECT * FROM Autograph ORDER BY Name";

	$res = mysqli_query($conn, $cat_query);
	$admin = false;

	if (isset($_SESSION['Username']) && $_SESSION['Username'] == true) {
		$user = $_SESSION['Username'];
		$query = "SELECT Admin FROM Users WHERE Username = '$user'";

		$result = mysqli_query($conn, $query);
		if($result) {
			$data = mysqli_fetch_assoc($result);
			$admin = $data['Admin'];
		}
	}

	if($res) {

		if($admin == 1) {
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
				    <p>Price: <b class="price">'.$data['Price'].'$</b></p>
				    <form method="POST" action="../BackEnd/buy.php">
				    	<input type="hidden" name="id" value="'.$data['Id'].'">
		    			<button type="submit">Buy</button>
					</form>
				    <form method="POST" action="../BackEnd/trade.php">
				    	<input type="hidden" name="id" value="'.$data['Id'].'">
		    			<button type="submit">Trade</button>
		    		</form>';

		    	if($data['Authenticity'] == 0)
				    echo '<form method="POST" action="../BackEnd/validate.php">
				    	<input type="hidden" name="id" value="'.$data['Id'].'">
		    			<button type="submit">Validate</button>
					</form>';

				echo '</div>';
			}
		} else {
			while($data = mysqli_fetch_assoc($res)) {
			    if($data['Sold'] == 1) {

			        echo '<div class="content">
			        	<img src="../FrontEnd/img/'.$data['Path'].'" alt="'.$data['Name'].'">
			        	<h3>'.$data['Name'].':</h3>
			        	<p>'.$data['Description'].'</p>
					    <p>Obtaied at: '.$data['Place'].'</p>
					    <p>Geographic location: '.$data['Location'].'</p>
					    <p>Placed on: '.$data['Object'].'</p>
					    <p>Special mention: '.$data['SpecialMention'].'</p>
					    <p>Willing to trade for: '.$data['ExchangeFor'].' in number of: '.$data['ExchangeNr'].'</p>
					    <p>Price: <b class="price">'.$data['Price'].'$</b></p>
					    <form method="POST" action="../BackEnd/buy.php">
					    	<input type="hidden" name="id" value="'.$data['Id'].'">
			    			<button type="submit">Buy</button>
						</form>
					    <form method="POST" action="../BackEnd/trade.php">
					    	<input type="hidden" name="id" value="'.$data['Id'].'">
			    			<button type="submit">Trade</button>
						</form>
					</div>';
				}
			}
		}
	}
?>