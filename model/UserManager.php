<?php

require_once('./model/Manager.php');

class UserManager extends Manager
{
    private $imgName;

    public function checkUser()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, password, img FROM users WHERE username = :username AND active = "1"');
        $req->execute(array(':username' => $_POST['username']));

        $result = $req->fetch();

        $isPasswordCorrect = password_verify($_POST['password'], $result['password']);


        if (!$result && $_POST['username'] == 'admin') {
            header('Location: /loginAdmin/?err=$err');
        } elseif (!$result && $_POST['username']  != 'admin') {
            header('Location: /loginUser/?err=$err');
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['img'] = $result['img'];
            } elseif (!$isPasswordCorrect) {
                header('Location: /loginUser/?err=$err');
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
    public function addImage()
    {
        $file = $_FILES['image']['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = time();
        $folderPath = "./upload/";
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


        // move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
        echo "Image Resize Successfully.";
        

    }
    public function imageResize($imageResourceId, $width, $height)
    {
        $targetWidth = 200;
        $targetHeight = 200;


        $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);


        return $targetLayer;
    }

    public function setImgName($imgName) {
         $this->imgName = $imgName;
    }
    public function imgName() {
        return $this->imgName;
    }

    public function userImgName() {
        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE users SET img = :img WHERE username = :username ');
        $req->bindValue(':img', $this->imgName);
        $req->bindValue('username', $_SESSION['username']);

        $req->execute();
        
    }
}
