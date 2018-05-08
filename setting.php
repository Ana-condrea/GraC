<?php
  $text = htmlspecialchars($_POST['full_name']);
  $email = htmlspecialchars($_POST['user_email']);
  $date =  htmlspecialchars($_POST['date_birth']);
  $text = htmlspecialchars($_POST['user_name']);
  $password  = htmlspecialchars($_POST['password']);

  echo  $text, ' ', $email, ' ',$date, ' ',$text, ' ', $password;
?>