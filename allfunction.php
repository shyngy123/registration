<?php

function get_user_by_email($email) {

    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_user_by_id($id) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'SELECT * FROM users WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_users(){
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'SELECT * FROM userss';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function add_user($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'INSERT INTO users (email, password, role) VALUES (:email, :password, :role)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user'
    ]);

    return $pdo->lastInsertId();
}

function edit_info ($id, $fullname, $workplace, $phone, $adress) {
    $data = [
        'id' => $id,
        'fullname' => $fullname,
        'workplace' => $workplace,
        'phone' => $phone,
        'adress' => $adress,
    ];
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'UPDATE users SET fullname=:fullname, workplace=:workplace, phone=:phone, adress=:adress WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
}

function set_status($id, $status) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'UPDATE users SET status=:status WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
        'status' => $status
    ]);
}

function upload_avatar($id, $image) {

        $pathinfo = pathinfo($image['name']);
        $tmp_name = $image['tmp_name'];
        $file_extension = $pathinfo['extension'];
        $filename = uniqid() .'.'. $file_extension;

        $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
        $sql = 'UPDATE users SET avatar=:avatar WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
            'avatar' => $filename
        ]);

        move_uploaded_file($tmp_name, 'uploads/' . $filename);

}

function add_social_links($id, $vk, $tg, $insta) {
    $data = [
        'id' => $id,
        'vk' => $vk,
        'tg' => $tg,
        'insta' => $insta,
    ];
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'UPDATE users SET vk=:vk, tg=:tg, insta=:insta WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
}

function set_flash_message($key, $message) {
    $_SESSION[$key] = $message;
}

function display_flash_message($key) {
    if(isset($_SESSION[$key])){
        echo '<div class="alert alert-'.$key.' text-dark" role="alert">'.$_SESSION[$key].'</div>';
        unset($_SESSION[$key]);
    }
}

function redirect_to($path) {
    header('Location: ' .$path);
}

function login($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if(empty($user)) {
        set_flash_message('danger', 'Неверный логин или пароль');
        redirect_to('page_login.php');
    }

    $hashed_pass = $user['password'];

    if(password_verify($password, $hashed_pass)) {
        $_SESSION['user'] = $user;
        redirect_to('users.php');
    }

}

function logout(){
    $_SESSION = [];
}

function is_admin(){
    if ($_SESSION['user']['role'] == 'admin') return true;
}

function is_author($logged_user_id, $user_id) {
    if ($logged_user_id == $user_id) return true;
}

function edit_email($id, $email) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'UPDATE users SET email=:email WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
        'email' => $email
    ]);
}

function edit_password($id, $password) {
  $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'UPDATE users SET password=:password WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
}

function delete_user($id, $filename) {
    $pdo = new PDO('mysql:host=localhost;dbname=regis', 'root', '');

    unlink('uploads/'.$filename);


    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
}

 ?>
