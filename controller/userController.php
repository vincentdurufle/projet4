<?php
function autoload($class)
{
    if (preg_match('#^Swift_#', $class)) {
        require './vendor/autoload.php';
    } else {
        require './model/' . $class . '.php';
    }
}
spl_autoload_register('autoload');

function loginAdminPage()
{
    if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
        require('./view/adminInterface.php');
    } else {
        require('./view/loginAdminView.php');
    }
}

function loginAdmin()
{
    if (isset($_POST['submit'])) {
        if (!empty($_POST['username'] && !empty($_POST['password']))) {
            $admin = new UserManager;
            $req = $admin->checkUser();
            require('./view/adminInterface.php');
        } else {
            header('Location: /admin?err');
        }
    }
}
function loginUser()
{
    if (isset($_POST['submit'])) {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = new UserManager;
            $req = $user->checkUser();
            require('./view/userInterface.php');
        } else {
            header('Location: /login?err');
        }
    }
}

function loginUserPage()
{
    if (!isset($_SESSION['username'])) {
        require('./view/loginUserView.php');
    } else {
        require('./view/userInterface.php');
    }
}

function disconnect()
{
    session_destroy();
    header('Location: /');
}

function createUser()
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

function updatePassword() {
    $req = new User([
        'email' => $_POST['email'],
        'token' => 16
    ]);
    
}

function verifyUser()
{
    $user = new UserManager();
    $user->activateUser();
}

function addImagePage()
{
    require('./view/addImageView.php');
}

function addImage()
{
    if(isset($_SESSION['username'])) {
        $img = new UserManager();
        $img->addImage();
        $img->userImgName();
    }
}
