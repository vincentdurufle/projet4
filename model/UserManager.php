<?php

require_once('./model/Manager.php');

class UserManager extends Manager
{

    public function checkUser()
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
            } elseif ($_POST['username'] != 'admin') {
                header('Location: index.php?action=loginUser&err=$err');
            } else {
                header('Location: index.php?action=loginAdmin&err=$err');
            }
        }
    }

    public function createUser(User $user)
    {
        $db = dbConnect();

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
    http://localhost/?action=verify?email=' . $user->email() . '&token=' . $user->token() . '
    ';
        $headers = 'From:noreply@projet4.vincentdurufle.com' . "\r\n";
        $headers .= 'Content-Type: text/plain; charset="utf-8"' . " ";
        mail($to, $subject, $message, $headers);

        $req->execute();
        // $transport = (new Swift_SmtpTransport('mail.vincentdurufle.com', 26))
        //     ->setUsername('projet4@vincentdurufle.com')
        //     ->setPassword('vincent(durufle)12');

        // // Create the Mailer using your created Transport
        // $mailer = new Swift_Mailer($transport);


        // // Create a message
        // $message = (new Swift_Message('Vérification d\'email'))
        //     ->setFrom('projet4@vincentdurufle.com')
        //     ->setTo($user->email())
        //     ->setBody('
        //     Merci de vous être inscrit au site de Jean Forteroche.
        //     Veuillez maintenant valider votre addresse mail pour utiliser votre compte 
        //     en cliquant sur ce lien : 
        //     http://localhost/?action=verify?email=' . $user->email() . '&token=' . $user->token() . '
        //     ');

        // // Send the message
        // $result = $mailer->send($message);


    }
}
