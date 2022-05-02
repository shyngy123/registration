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



// Проверяем на пустоту поля емейл и пароль
if(empty($email) && empty($password)) {
    set_flash_message('danger', '<strong>Уведомление!</strong> Эл. адрес и пароль - должны быть заполнены.');
    redirect_to('create_user.php');
    exit();
}

// Получаем юзера и проверяем есть ли введенный емейл в базе
$user = get_user_by_email($email);
if(!empty($user)) {
    set_flash_message('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
    redirect_to('create_user.php');
    exit();
}

// добавляем пользователя и получаем его айди
$last_user_id = add_user($email, $password);

// записываем в бд информацию
edit_info ($last_user_id, $name, $workplace, $phone, $adress);

// записываем в бд статус юзера
set_status($last_user_id, $status);

// загружаем аватарку в папку и сохраняем название в бд
if(!empty($image['name'])) {
    upload_avatar($last_user_id, $image);
}

// записываем в бд соцсети
add_social_links($last_user_id, $vk, $tg, $insta);

set_flash_message('success', '<strong>Уведомление!</strong> Пользователь успешно добавлен.');
redirect_to('users.php');
exit();











































 ?>
