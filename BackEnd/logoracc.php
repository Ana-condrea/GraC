<?php
	if(PHP_SESSION_ACTIVE){
		echo '<a href="account.html" class="right">Your Account</a>';
	} else {
		echo '<a href="login.html" class="right">Login</a>';
	}
?>