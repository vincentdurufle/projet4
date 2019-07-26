<?php 
function autoload($class) {
    if(preg_match('#^Swift_#',$class)) {
        require './vendor/autoload.php';
    } else {
        require './model/' .$class. '.php';
    }
}
spl_autoload_register('autoload');

function loginAdminPage() {
    require('./view/loginAdminView.php');
}

function loginAdmin() {
    $admin = new UserManager;
    $req = $admin->checkUser();
    require('./view/adminInterface.php');
}
function loginUser() {
    $user = new UserManager;
    $req = $user->checkUser();
    require('./view/userInterface.php');
}

function loginUserPage() {
    require('./view/loginUserView.php');
}

function disconnect() {
    session_destroy();
}

function createUser() {
    $user = new User([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'token' => 16
    ]);
    $req = new UserManager();
    $req->createUser($user);
}

function verifyUser() {
    $user = new UserManager();
    $user->activateUser();
}
