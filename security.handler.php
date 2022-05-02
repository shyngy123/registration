<?php

session_start();
require_once 'allfunction.php';

$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];

//задать вопрос почему это не одно и тоже, и почему нельзя получить юзера по айди и пользоваться на проврках всеми его данными в том числе и емейлом
$user = get_user_by_id($id);
$user_by_email = get_user_by_email($email);

if(!empty($user_by_email) && $email !== $user['email']) {
    set_flash_message('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
    redirect_to('security.php?id='.$id);
} else {
    edit_email($id, $email);
    set_flash_message('success', '<strong>Уведомление!</strong> Данные изменены.');
    redirect_to('security.php?id='.$id);
}


if(!empty($password)) {
    edit_password($id, $password);
}



































 ?>
