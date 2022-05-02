<?php

session_start();
require 'allfunction.php';

$email = $_POST['email'];
$password = $_POST['password'];

login($email, $password);










 ?>
