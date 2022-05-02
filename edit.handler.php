<?php

session_start();
require_once 'allfunction.php';

$id = $_POST['id'];
$fullname = $_POST['fullname'];
$workplace = $_POST['workplace'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];

edit_info($id, $fullname, $workplace, $phone, $adress);

set_flash_message('success', '<strong>Уведомление!</strong> Данные успешно обновлены.');
redirect_to('edit.php?id='.$id);





























 ?>
