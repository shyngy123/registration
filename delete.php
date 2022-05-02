<?php
session_start();
require_once 'allfunction.php';

$id = $_GET['id'];

$user = get_user_by_id($id);

if (!is_admin()){
    if(!is_author($_SESSION['user']['id'], $id)) {
        set_flash_message('danger', '<strong>Уведомление!</strong> Редактировать можно только свой профиль.');
        redirect_to('users.php');
        exit();
    }
};

if(is_author($_SESSION['user']['id'], $id)) {
    delete_user($user['id'], $user['avatar']);
    logout();
    redirect_to('page_register.php');
    exit();
}

delete_user($user['id'], $user['avatar']);
set_flash_message('success', '<strong>Уведомление!</strong> Пользователь удален.');

redirect_to('users.php');
exit();
