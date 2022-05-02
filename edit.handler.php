<?php

session_start();
include 'allfunction.php';

$id = $_POST['id'];
$fullname = $_POST['fullname'];
$workplace = $_POST['workplace'];
$phone = $_POST['number'];
$adress = $_POST['address'];

edit_info ($id, $fullname, $workplace, $phone, $adress);
header('Location: edit.php?id='.$id);






























 ?>
