<?php
    include("config.php");
	mysqli_set_charset($conn,"utf8");

    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $search = htmlspecialchars($search); 
     
    $search = mysqli_real_escape_string($conn, $search);
     
    $query = "SELECT * FROM Autograph WHERE ((Name LIKE '%".$search."%') OR (Description LIKE '%".$search."%') OR (Tags LIKE '%".$search."%')) AND Sold = 1";
    
	$result = mysqli_query($conn, $query);

	if($result === FALSE) { 
		die(mysqli_error($conn)); 
	}

    if(mysqli_num_rows($result) > 0){ 
         
        while($data = mysqli_fetch_array($result)){

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
    else{
        echo '<br><h3>No results found. Try something else.</h3>';
    }
?>