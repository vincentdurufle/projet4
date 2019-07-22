<?php 
function autoload($class) {
    require './model/' .$class. '.php';
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
    checkUser();
    require('./view/userInterface.php');
}

function loginUserPage() {
    require('./view/loginUserView.php');
}

function createUser() {
    createUserData();
}
