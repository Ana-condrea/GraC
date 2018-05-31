<?php
	include("login.php");
	header( 'Location: http://www.autographcoll.com/FrontEnd/Proiect.html' );
	session_destroy();
	$conn->close();
?>