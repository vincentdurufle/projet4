<?php 
require_once('./model/model.php');

function showChapters() {
    $posts = getChapters();
    
    require('./view/home.php');
}

function showChapter() {
    $chapter = getChapter($_GET['id']);
    require('./view/updateChapterView.php');
}

function post() {
    $chapter = getChapter($_GET['id']);
    $comments = getComments($_GET['id']);

    require('./view/chapterView.php');
}

function showTitles() {
    $req = showChaptersTitle();

    require('./view/showChaptersTitleView.php');
}