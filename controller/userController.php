<?php 
require_once('./model/login.php');

function loginPage() {
    require('./view/loginView.php');
}


function login() {
    checkUser();
    require('./view/userInterface.php');
}