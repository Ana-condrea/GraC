<?php
  $email = htmlspecialchars($_POST['user_email']);
  $password  = htmlspecialchars($_POST['password']);

  echo  $email, ' ', $password;
?>