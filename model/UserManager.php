<?php

require_once('./model/Manager.php');

class UserManager extends Manager {

    public function checkUser() {
        $db = dbConnect();
        $req = $db->prepare('SELECT username, password FROM users WHERE username = :username');
        $req->execute(array(
            'username' => $_POST['username']
        ));
        $result = $req->fetch();
        
        $isPasswordCorrect = password_verify($_POST['password'], $result['password']);
        
        if (!$result) {
            header('Location: index.php?action=loginAdmin&err=$err');
            echo 'Mauvais identifiant ou mot de passe';
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['username'] = $_POST['username'];
            } elseif ($_POST['username'] != 'admin') {
                header('Location: index.php?action=loginUser&err=$err');
            } else {
                header('Location: index.php?action=loginAdmin&err=$err');
            }
        }
    }

}