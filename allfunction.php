<?php



function add_user($email, $password) {
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'INSERT INTO userss (email, password, role) VALUES (:email, :password, :role)';
    $statement = $db->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user'
    ]);

}


function check_login_user($email){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
  $statement = $db->prepare($sql);
  $statement->execute(['email' => $email]);
  return  $user = $statement->fetch(PDO::FETCH_ASSOC);


}

function enter_login($email, $password) {
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = 'SELECT * FROM userss WHERE email = :email';
    $statement = $db->prepare($sql);
    $statement->execute([ 'email' => $email]);
     $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['status'] = 'Authorized';
        $_SESSION['user']='user';
        header('Location: users.php');
    } else {
        $_SESSION['status'] = 'Not authorized';
        header('Location: page_login.php');

    }
}

function get_user(){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = 'SELECT * FROM userss';
    $statement = $db->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function delete($id){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "DELETE*FROM userss WHERE id=?";
     $stmt= $db->prepare($sql);
   $stmt->execute([$id]);
    header('Location: users.php');
   }
   function security(  $id,  $email,$password,$confirmation){
     if ($confirmation==$password) {
         $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
       $sqll = "UPDATE userss SET email=?, password=?  WHERE id=?";
     	$querys = $db->prepare($sqll);
     	$querys->execute([$email, password_hash($password,PASSWORD_DEFAULT),$id]);
     }


   }


   function edit_info ($id, $fullname, $workplace, $phone, $adress) {
       $data = [
           'id' => $id,
           'fullname' => $fullname,
           'workplace' => $workplace,
           'phone' => $phone,
           'adress' => $adress,
       ];
       $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
       $sql = 'UPDATE userss SET fullname=:fullname, workplace=:workplace, phone=:phone, adress=:adress WHERE id=:id';
       $statement = $db->prepare($sql);
       $statement->execute($data);
   }



   function get_user_by_id($id) {
       $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
       $sql = 'SELECT * FROM userss WHERE id = :id';
       $statement = $db->prepare($sql);
       $statement->execute(['id' => $id]);
       $user = $statement->fetch(PDO::FETCH_ASSOC);
       return $user;
   }


   function upload_media( $id){
     $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
        $uploadname=$_FILES['image']['tmp_name'];
        $path='uploads/'.uniqid().'.jpeg';
       move_uploaded_file($uploadname,$path);
        $sqll = "UPDATE userss SET image=? WHERE id=?";
           $querys = $db->prepare($sqll);
          $querys->execute([$path, $id]);
       }


       function add_social_links($id, $vk, $tg, $insta) {
       $data = [
           'id' => $id,
           'vk' => $vk,
           'tg' => $tg,
           'insta' => $insta,
       ];
        $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
       $sql = 'UPDATE userss SET vk=:vk, tg=:tg, insta=:insta WHERE id=:id';
       $statement = $db->prepare($sql);
       $statement->execute($data);
   }



   function edit_status($id){
     $status=$_POST['status'];
     $sqll = "UPDATE userss SET status=? WHERE id=?";
     $querys = $db->prepare($sqll);
     $querys->execute([$status,$get_id]);

     if ($status=="online") {
     $_SESSION['STATUS']='success';
     }elseif ($status=="goout") {
     $_SESSION['STATUS']='warning';
     }elseif ($status=="bother") {
     $_SESSION['STATUS']='danger';
     }

   }




 ?>
