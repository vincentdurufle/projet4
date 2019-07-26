<?php
if(!isset($_SESSION)) {
    session_start();
}
require_once('./controller/controller.php');
require_once('./controller/userController.php');
require_once('./controller/editController.php');


if(isset($_GET['action'])) {
    if($_GET['action'] == 'showChapters') {
        showChapters();
    } elseif ($_GET['action'] == 'post') {
        if(isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
            echo 'Erreur : bullshit';
        }
    } elseif ($_GET['action'] == 'loginAdmin') {
        loginAdminPage();
    } elseif ($_GET['action'] == 'checkLoginAdmin') {
        if(isset($_POST['submit'])) {
            if (empty($_POST['username'] || empty($_POST['password']))) {
                echo "Veuillez saisir un nom d'utilisateur et mot de passe";
            } else {
                loginAdmin();
            }
        } 
    } elseif ($_GET['action'] == 'addChapter') {
        if(isset($_SESSION) && $_SESSION['username'] == 'admin') {
            addChapterView();
        } else {
            echo 'some shit happened';
        }
    } elseif ($_GET['action'] == 'postChapter') {
        if(isset($_POST['editor_title']) && isset($_POST['editor_content'])) {
            addChapter();
        } else {
            echo 'there was a problem';
        } 
    } elseif ($_GET['action'] == 'showChaptersTitle') {
        showTitles();
    } elseif($_GET['action'] == 'updateChapter') {
        if(isset($_GET['id']) && $_GET['id'] > 0) { 
            showChapter();
        }
    } elseif($_GET['action'] == 'updateChapterData') {
        if(!isset($_GET['id'])) {
            echo 'Erreur';
        } else {
            updateChapter();
            post();
        }
    } elseif($_GET['action'] == 'deleteChapter') {
        if(!isset($_GET['id'])) {
            echo 'Erreur';
        } else {
            deleteChapter();
        }
    } elseif($_GET['action'] == 'createUser') {
        if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['email']) && !empty($_POST['email'] && isset($_POST['password']) && !empty($_POST['password']))){
            createUser();
        }
    } elseif($_GET['action'] == 'verify') {
        verifyUser();
    } elseif($_GET['action'] == 'loginUser') {
        loginUserPage();
    } elseif($_GET['action'] == 'checkLoginUser') {
        if(isset($_POST['submit'])) {
            if (empty($_POST['username'] || empty($_POST['password']))) {
                echo "Veuillez saisir un nom d'utilisateur et mot de passe";
            } else {
                loginUser();
            }
        } 
    } elseif($_GET['action'] == 'disconnect') {
        disconnect();
    }
} else {
    showChapters();
}