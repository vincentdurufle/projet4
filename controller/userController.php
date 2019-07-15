<?php 
require_once('./model/login.php');

function loginAdminPage() {
    require('./view/loginAdminView.php');
}


function login() {
    checkUser();
    require('./view/userInterface.php');
}

function loginUserPage() {
    require('./view/loginUserView.php');
}

function createUser() {
    createUserData();
}