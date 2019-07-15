<?php

function checkUser()
{
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
        } else {
            header('Location: index.php?action=loginAdmin&err=$err');
        }
    }
}

function createUserData()
{
    $db = dbConnect();
    $hash = md5(rand(0, 1000));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $req = $db->prepare('INSERT INTO users (username, password, email, hash) VALUES(?, ?, ?, ?)');
    $req->execute(array($_POST['username'], $password, $_POST['email'], $hash));

    $to = $_POST['email'];
    $subject = 'Vérification d\'email';
    $message = '
    Merci de vous être inscrit au site de Jean Forteroche.
    Veuillez maintenant valider votre addresse mail pour utiliser votre compte 
    en cliquant sur ce lien : 
    http://localhost/index.php?action=verify?email=' . $_POST['email'] . 'hash=' . $hash . '
    ';
    $headers = 'From:noreply@projet4.vincentdurufle.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}

function verifyData()
{ 
    $db = dbConnect();
    $req = $db->prepare('SELECT email, hash, active FROM users WHERE email = ? AND hash = ?');
    $req->execute(array($_GET['email'], $_GET['hash']));
}
