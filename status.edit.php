<?php

session_start();
require_once 'allfunction.php';

$id = $_POST['id'];
$status = $_POST['status'];

set_status($id, $status);
set_flash_message('success', '<strong>Уведомление!</strong> Статус успешно обновлен.');
redirect_to('status.php?id='.$id);
exit();



































 ?>
