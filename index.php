<?php
if (!isset($_SESSION)) {
    session_start();
}

function controller ($controller, $fn) {
    if($controller == 'chapter') {
        $controller = new ChapterController();
        $controller->$fn();
    } elseif($controller == 'comment') {
        $controller = new CommentController();
        $controller->$fn();
    } elseif($controller == 'helpers') {
        $controller = new Manager();
        $controller->$fn();
    } elseif($controller == 'user') {
        $controller = new UserController();
        $controller->$fn();
    }
}

require('./controller/ChapterController.php');
require('./controller/CommentController.php');
require('./controller/UserController.php');

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if ($request_uri[0] == '/') {
    controller('chapter', 'showChaptersHome');
} elseif($request_uri[0] == '/chapitres') {
    controller('chapter', 'showChapters');
} elseif ($request_uri[0] == '/admin') {
    controller('user', 'loginAdminPage');
} elseif ($request_uri[0] == '/chapitre/') {
    controller('chapter', 'post');
} elseif ($request_uri[0] == '/checkAdmin') {
    controller('user', 'loginAdmin');
} elseif ($request_uri[0] == '/addChapter') {
    controller('chapter', 'addChapterView');
} elseif ($request_uri[0] == '/postChapter') {
    controller('chapter', 'addChapter');
} elseif ($request_uri[0] == '/updateChapter') {
    controller('chapter', 'showTitles');
} elseif ($request_uri[0] == '/updateChapter/') {
    controller('chapter', 'showChapter');
} elseif ($request_uri[0] == '/updateChapterData/') {
    $controller = new ChapterController();
    $controller->updateChapter();
    $controller->post();
} elseif ($request_uri[0] == '/deleteChapter/') {
    controller('chapter', 'deleteChapter');
} elseif ($request_uri[0] == '/moderate') {
    controller('comment', 'showComments');
} elseif ($request_uri[0] == '/deleteComment/') {
    controller('comment', 'deleteComment');
} elseif ($request_uri[0] == '/disconnect') {
    controller('user', 'disconnect');
} elseif ($request_uri[0] == '/login') {
    controller('user', 'loginUserPage');
} elseif ($request_uri[0] == '/create') {
    controller('user', 'createUser');
} elseif ($request_uri[0] == '/verify/') {
    controller('user', 'verifyUser');
} elseif ($request_uri[0] == '/loginUser') {
    controller('user', 'loginUser');
} elseif ($request_uri[0] == '/picture') {
    controller('user', 'addImagePage');
} elseif ($request_uri[0] == '/upload') {
    controller('user', 'addImage');
} elseif ($request_uri[0] == '/addComment/') {
    controller('comment', 'addCommentPage');
} elseif ($request_uri[0] == '/addCommentData/') {
    controller('comment', 'addComment');
} elseif ($request_uri[0] == '/report/') {
    controller('comment', 'reportComment');
} elseif ($request_uri[0] == '/password') {
    controller('user', 'updatePasswordPage');
} elseif ($request_uri[0] == '/updatepassword') {
    controller('user', 'updatePassword');
} elseif ($request_uri[0] == '/reset/') {
    controller('user', 'resetPage');
} elseif ($request_uri[0] == '/resetPassword/') {
   controller('user', 'resetPassword');
} else {
    controller('helpers', 'error');
}