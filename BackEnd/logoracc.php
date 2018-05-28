<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo '<a href="account.html" class="right">Your Account</a>';
	} else {
		echo '<a href="login.html" class="right">Login</a>';
	}
?>
