<?php
session_start();
require_once 'allfunction.php';
$name = $_POST['fullname'];
$workplace = $_POST['workplace'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];

$email = $_POST['email'];
$password = $_POST['$password'];
$status = $_POST['status'];
$image = $_FILES['avatar'];
$email = $_POST['email'];

$vk = $_POST['vk'];
$tg = $_POST['tg'];
$insta = $_POST['insta'];


check_login_user($email);
if (!empty($user)) {
  $_SESSION['message']='Логин занято!';
   header('Location: page_register.php');
}

add_user($email, $password);
edit_info ($id, $fullname, $workplace, $phone, $adress);






if(!empty($image['name'])) {
     upload_media( $id);
}

add_social_links($id, $vk, $tg, $insta)















































 ?>
