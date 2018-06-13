<?php
	include("login.php");
	header( 'Location: ../FrontEnd/Proiect.html' );
	session_destroy();
	$conn->close();
?>
