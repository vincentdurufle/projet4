<?php

require_once('./model/Manager.php');

class UserManager extends Manager
{
    private $imgName;
    /**
     * query data from user with username if account is active and verifies password
     * @param object $user
     * @param string $_POST['password']
     * @return void
     */
    public function checkUser(User $user)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, password, img FROM users WHERE username = :username AND active = "1"');
        $req->bindValue(':username', $user->username());
        $req->execute();

        $result = $req->fetch();

        $isPasswordCorrect = password_verify($_POST['password'], $result['password']);


        if (!$result && $user->username() == 'admin') {
            header('Location: /admin?err=4');
        } elseif (!$result && $user->username()  != 'admin') {
            header('Location: /login?err=4');
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['username'] = $user->username();
                $_SESSION['img'] = $result['img'];
            } elseif (!$isPasswordCorrect) {
                header('Location: /login?err=4');
            }
        }
        $db = null;
    }

    /**
     * inserts new user in db from object and sends email
     * @param object $user
     * @return void
     */
    public function createUser(User $user)
    {
        $db = $this->dbConnect();

        $check = $db->prepare('SELECT username, email FROM users WHERE username = :username OR email = :email');
        $check->bindValue(':username', $user->username());
        $check->bindValue(':email', $user->email());

        $check->execute();
        $res = $check->fetch();

        if ($res) {
            header('Location: /login?err=2');
        } else {
            $req = $db->prepare('INSERT INTO users (username, password, email, token) VALUES(:username, :password, :email, :token)');
            $req->bindValue(':username', $user->username());
            $req->bindValue(':password', $user->password());
            $req->bindValue(':email', $user->email());
            $req->bindValue(':token', $user->token());

            $req->execute();

            $to = $user->email();
            $subject = 'Vérification d\'email';
            $message = '
            Merci de vous être inscrit au site de Jean Forteroche.

            Veuillez maintenant valider votre addresse mail pour utiliser votre compte 
            en cliquant sur ce lien : 

                https://projet4.vincentdurufle.com/verify/?email=' . $user->email() . '&token=' . $user->token() . '

            Merci.
            ';
            
            $headers = 'From:noreply@projet4.vincentdurufle.com' . "\r\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"' . " ";
            mail($to, $subject, $message, $headers);

            $db = null;
            header('Location: /login?success=1');
        }
    }

    /**
     * sets active column in user to 1
     * @param object $user
     * @param int $_GET['token']
     * @return void
     */
    public function activateUser(User $user)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT email, token, active FROM users WHERE email = :email AND token = :token AND active = 0');
        $req->bindValue(':email', $user->email());
        $req->bindValue(':token', $_GET['token']);
        $res = $req->execute();
        if ($res) {
            $update = $db->prepare('UPDATE users SET active = 1 WHERE email = :email');
            $update->bindValue(':email', $user->email());
            $update->execute();
            header('Location: /login?success=3');
        }
        $db = null;
    }

    /**
     * updates token of user in db and sends email
     * @param object $user
     * @return void
     */
    public function update(User $user)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT email, token FROM users WHERE email = :email AND active = "1"');
        $req->execute(array(':email' => $user->email()));


        $res = $req->fetch();
        if ($res) {
            $token = $db->prepare('UPDATE users SET token = :token WHERE email = :email');
            $token->bindValue(':email', $user->email());
            $token->bindValue(':token', $user->token());

            $token->execute();

            $to = $user->email();
            $subject = 'Vérification d\'email';
            $message = '
        Merci de vous être inscrit au site de Jean Forteroche.
    
        Pour réinitialiser votre mot de passe veuillez cliquez sur le lien ci-dessous : 
        https://projet4.vincentdurufle.com/reset/?email=' . $user->email() . '&token=' . $user->token() . '
        ';
            $headers = 'From:noreply@projet4.vincentdurufle.com' . "\r\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"' . " ";
            mail($to, $subject, $message, $headers);

            header('Location: /password?success=1');
        } else {
            header('Location: /password?err=3');
        }
        $db = null;
    }

    /**
     * updates password of user
     * @param object $user
     * @param string $_GET['token']
     * @return void
     */
    public function reset(User $user)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT email, token FROM users WHERE email = :email AND token = :token');
        $req->bindValue(':email', $user->email());
        $req->bindValue(':token', $_GET['token']);
        $req->execute();

        $res = $req->fetch();
        if ($res) {
            $update = $db->prepare('UPDATE users SET token = :token, password = :password WHERE email = :email');
            $update->bindValue(':token', $user->token());
            $update->bindValue(':password', $user->password());
            $update->bindValue(':email', $user->email());

            $update->execute();

            header('Location: /login?success=2');
        }
        $db = null;
    }

    /**
     * upload an image, rename it, resizes it and moves it to publc/img folder
     * @param array $_FILES
     * @return void
     */
    public function addImage()
    {
        $file = $_FILES['image']['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = time();
        $folderPath = "./public/img/";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];


        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file);
                $targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                imagepng($targetLayer, $folderPath . $fileNewName . "_thump." . $ext);
                $this->setImgName($fileNewName . "_thump." . $ext);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file);
                $targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                imagegif($targetLayer, $folderPath . $fileNewName . "_thump." . $ext);
                $this->setImgName($fileNewName . "_thump." . $ext);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file);
                $targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                imagejpeg($targetLayer, $folderPath . $fileNewName . "_thump." . $ext);
                $this->setImgName($fileNewName . "_thump." . $ext);
                break;


            default:
                echo "Invalid Image type.";
                exit;
                break;
        }
        $db = null;
    }

    /**
     * resize an img
     * @param string $imageresourceid 
     * @param int $width
     * @param int $height
     * @return img
     */
    public function imageResize($imageResourceId, $width, $height)
    {
        $targetWidth = 200;
        $targetHeight = 200;


        $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);


        return $targetLayer;
    }

    public function setImgName($imgName)
    {
        $this->imgName = $imgName;
    }
    public function imgName()
    {
        return $this->imgName;
    }

    /**
     * updates img column of user and comments where there is user
     * @param string $_SESSION['username']
     * @param var $this->imgName
     * @return void
     */
    public function userImgName()
    {
        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE users SET img = :img WHERE username = :username ');
        $req->bindValue(':img', $this->imgName);
        $req->bindValue('username', $_SESSION['username']);

        $update = $db->prepare('UPDATE comments SET img = :img WHERE name = :name');
        $update->bindValue(':img', $this->imgName);
        $update->bindValue(':name', $_SESSION['username']);

        $update->execute();
        $req->execute();

        $_SESSION['img'] = $this->imgName;
        header('Location: /login');
        $db = null;
    }
}
