<?php

function checkUser() {
    $db = dbConnect();
    $req = $db->prepare('SELECT username, password FROM users WHERE username = :username');
    $req->execute(array( 
        'username' => $_POST['username']));
    $result = $req->fetch();
    
    $isPasswordCorrect = password_verify($_POST['password'], $result['password']);

    if(!$result) {
        header('Location: index.php?action=login&err=$err');
        echo 'Mauvais identifiant ou mot de passe';
    } else {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['username'] = $_POST['username'];
        } else {
            header('Location: index.php?action=login&err=$err');
            
        }
    }
}