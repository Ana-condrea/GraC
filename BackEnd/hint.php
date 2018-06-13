<?php
	$a = array("Dinner", "Concert", "Auction", "Football game", "Basketball game", "Club", "Party", "Game");

	$q = $_REQUEST["q"];

	$hint = "";

	if ($q != "") {

	    $q = strtolower($q);
	    $len=strlen($q);

	    foreach($a as $name) {

	        if (stristr($q, substr($name, 0, $len))) {

	            if ($hint === "") {
	                $hint = $name;
	            } else {
	                $hint = $hint.", $name";
	            }
	        }
	    }
	}

	echo $hint === "" ? "no suggestion" : $hint;
?>
