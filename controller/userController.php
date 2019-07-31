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
        if (!empty($_POST['username'] || !empty($_POST['password']))) {
            $admin = new UserManager;
            $req = $admin->checkUser();
            require('./view/adminInterface.php');        
        }
    }
}
function loginUser()
{
    $user = new UserManager;
    $req = $user->checkUser();
    require('./view/userInterface.php');
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
    $user = new User([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'token' => 16
    ]);
    $req = new UserManager();
    $req->createUser($user);
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
    $img = new UserManager();
    $img->addImage();
    $img->userImgName();
}
