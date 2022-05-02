<?php

session_start();
require_once 'allfunction.php';

$id = $_POST['id'];
$image = $_FILES['avatar'];

// если файл не выбран
if(empty($image['name'])) {
    set_flash_message('danger', '<strong>Уведомление!</strong> Выберите файл.');
    redirect_to('media.php?id='.$id);
    exit();
}

// загружаем аватарку в папку и сохраняем название в бд
upload_avatar($id, $image);
set_flash_message('success', '<strong>Уведомление!</strong> Аватар успешно загружен.');
redirect_to('media.php?id='.$id);
exit();





























 ?>
