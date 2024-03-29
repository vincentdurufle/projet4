<?php


class UserController extends Manager {
    public function updatePasswordPage() {
        $this->render('updatePasswordPage', []);
    } 

    public function loginAdminPage()
    {
        if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
            $this->render('adminInterface', []);
        } else {
            $this->render('loginAdminView', []);
        }
    }

    public function loginAdmin()
    {
        if (isset($_POST['submit'])) {
            if (!empty($_POST['username'] && !empty($_POST['password']))) {
                $UserManager = new UserManager;
                $user = new User(['username' => $_POST['username']]);
                $req = $UserManager->checkUser($user);
                $this->render('adminInterface', [
                    'req' => $req
                ]);
            } else {
                header('Location: /admin?err=4');
            }
        }
    }

    public function loginUser()
    {
        if (isset($_POST['submit'])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $UserManager = new UserManager;
                $user = new User(['username' => $_POST['username']]);
                $req = $UserManager->checkUser($user);
                if(isset($_SESSION['username'])) {
                    $this->render('userInterface', [
                        'req' => $req
                    ]);
                }
            } else {
                header('Location: /login?err=4');
            }
        }
    }
    public function loginUserPage()
    {
        if (!isset($_SESSION['username'])) {
            $this->render('loginUserView', []);
        } else {
            $this->render('userInterface', []);
        }
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: /');
    }
    
    public function createUser()
    {
        if (isset($_POST['username']) && !empty($_POST['username']) and isset($_POST['email']) && !empty($_POST['email'] && isset($_POST['password']) && !empty($_POST['password']))) {
            $user = new User([
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'token' => 16
            ]);
            $req = new UserManager();
            $req->createUser($user);
        }
    }
    public function updatePassword()
    {
        if(isset($_POST['email'])) {
            $user = new User([
                'email' => $_POST['email'],
                'token' => 16
            ]);
            $email = new UserManager();
            $email->update($user);
        } else {
            header('Location: /password?err=1');
        }
    
    }
    public function resetPage()
    {
        $this->render('resetPasswordPage', []);
    }
    public function resetPassword()
    { 
        if(isset($_GET['email'], $_POST['password'], $_GET['token']) && !empty($_POST['password'])) {
            $user = new User([
                'email' => $_GET['email'],
                'token' => 16,
                'password' => $_POST['password']
            ]);
            $req = new UserManager;
            $req->reset($user);
        } else {
            header('Location: /reset/?email='.$_GET['email'].'&token='.$_GET['token'].'&err=1');
        }
    }
    public function verifyUser()
    {
        $user = new User(['email' => $_GET['email']]);
        $UserManager = new UserManager();
        $UserManager->activateUser($user);
    }
    
    public function addImagePage()
    {
        $this->render('addImageView', []);
    }

    public function addImage()
    {
        if (isset($_SESSION['username'])) {
            $img = new UserManager();
            $img->addImage();
            $img->userImgName();
        }
    }
}

