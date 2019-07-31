<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('./controller/controller.php');
require_once('./controller/userController.php');
require_once('./controller/editController.php');

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if ($request_uri[0] == '/') {
    showChapters();
} elseif ($request_uri[0] == '/admin') {
    loginAdminPage();
} elseif ($request_uri[0] == '/chapitre/') {
    post();
} elseif ($request_uri[0] == '/checkAdmin') {
    loginAdmin();
} elseif ($request_uri[0] == '/addChapter') {
    addChapterView();
} elseif ($request_uri[0] == '/postChapter') {
    addChapter();
} elseif ($request_uri[0] == '/updateChapter') {
    showTitles();
} elseif ($request_uri[0] == '/updateChapter/') {
    showChapter();
} elseif ($request_uri[0] == '/updateChapterData/') {
    updateChapter();
    post();
} elseif ($request_uri[0] == '/deleteChapter/') {
    deleteChapter();
} elseif ($request_uri[0] == '/moderate') {
    showComments();
} elseif ($request_uri[0] == '/deleteComment/') {
    deleteComment();
} elseif ($request_uri[0] == '/disconnect') {
    disconnect();
} elseif ($request_uri[0] == '/login') {
    loginUserPage();
} elseif($request_uri[0] == '/create') {
    createUser();
}


//  elseif ($_GET['action'] == 'createUser') {
//         if (isset($_POST['username']) && !empty($_POST['username']) and isset($_POST['email']) && !empty($_POST['email'] && isset($_POST['password']) && !empty($_POST['password']))) {
//             createUser();
//         }
//     } elseif ($_GET['action'] == 'verify') {
//         verifyUser();
//     } elseif ($_GET['action'] == 'loginUser') {
//         loginUserPage();
//     } elseif ($_GET['action'] == 'checkLoginUser') {
//         if (isset($_POST['submit'])) {
//             if (empty($_POST['username'] || empty($_POST['password']))) {
//                 echo "Veuillez saisir un nom d'utilisateur et mot de passe";
//             } else {
//                 loginUser();
//             }
//         }
//     } elseif ($_GET['action'] == 'addComment') {
//         if(!isset($_SESSION['username'])) {
//             loginUserPage();
//         }else {
//             addCommentPage();
//         }
//     } elseif ($_GET['action'] == 'addCommentData') {
//         addComment();
//     } elseif ($_GET['action'] == 'addProfilePicture') {
//         addImagePage();
//     } elseif($_GET['action'] == 'uploadImg') {
//         addImage();
//     }
// } 
