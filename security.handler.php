<?php

$id = $_GET['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmation = $_POST['confirmation'];
include 'allfunction.php';
session_start();



security(  $id,  $email,$password,$confirmation);





































 ?>
