<?php
session_start();
include 'allfunction.php';
$email=$_POST['email'];
$password=$_POST['password'];




check_login_user($email);
if (!empty($user)) {
  $_SESSION['message']='Логин занято!';
   header('Location: page_register.php');
}else {
  add_user($email, $password);
  $_SESSION['message']='Успешная регистрация';
  header('Location: page_login.php');
}

















 ?>
