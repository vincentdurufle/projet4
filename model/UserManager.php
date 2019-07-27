<?php

require_once('./model/Manager.php');

class UserManager extends Manager
{
    public function checkUser()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, password FROM users WHERE username = :username AND active = "1"');
        $req->execute(array(':username' => $_POST['username']));

        $result = $req->fetch();

        $isPasswordCorrect = password_verify($_POST['password'], $result['password']);


        if (!$result && $_POST['username'] == 'admin') {
            header('Location: index.php?action=loginAdmin&err=$err');
        } elseif (!$result && $_POST['username']  != 'admin') {
            header('Location: index.php?action=loginUser&err=$err');
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['username'] = $_POST['username'];
            } elseif (!$isPasswordCorrect) {
                header('Location: index.php?action=loginUser&err=$err');
            }
        }
    }

    public function createUser(User $user)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO users (username, password, email, token) VALUES(:username, :password, :email, :token)');
        $req->bindValue(':username', $user->username());
        $req->bindValue(':password', $user->password());
        $req->bindValue(':email', $user->email());
        $req->bindValue(':token', $user->token());


        $to = $user->email();
        $subject = 'Vérification d\'email';
        $message = '
    Merci de vous être inscrit au site de Jean Forteroche.
    Veuillez maintenant valider votre addresse mail pour utiliser votre compte 
    en cliquant sur ce lien : 
    http://localhost/?action=verify&email=' . $user->email() . '&token=' . $user->token() . '
    ';
        $headers = 'From:noreply@projet4.vincentdurufle.com' . "\r\n";
        $headers .= 'Content-Type: text/plain; charset="utf-8"' . " ";
        mail($to, $subject, $message, $headers);

        $req->execute();
    }

    public function activateUser()
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT email, token, active FROM users WHERE email = ? AND token = ? AND active = 0');
        $res = $req->execute(array($_GET['email'], $_GET['token']));
        if ($res) {
            $update = $db->prepare('UPDATE users SET active = 1 WHERE email = ? AND token = ?');
            $update->execute(array($_GET['email'], $_GET['token']));
        } else {
            header('Location: index.php?action=loginUser&err=$err');
        }
    }
}
