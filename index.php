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
} elseif ($request_uri[0] == '/create') {
    createUser();
} elseif ($request_uri[0] == '/verify/') {
    verifyUser();
} elseif ($request_uri[0] == '/loginUser') {
    loginUser();
} elseif ($request_uri[0] == '/picture') {
    addImagePage();
} elseif ($request_uri[0] == '/upload') {
    addImage();
} elseif ($request_uri[0] == '/addComment/') {
    addCommentPage();
} elseif ($request_uri[0] == '/addCommentData/') {
    addComment();
} elseif ($request_uri[0] == '/report/') {
    reportComment();
} elseif ($request_uri[0] == '/updatepwd') {
    updatePasswordPage();
} elseif (request_uri[0] == '/reset/') {
    resetPasswordPage();
} elseif (request_uri[0] == '/newPassword') {
    newPassword();
} else {
    error();
}
