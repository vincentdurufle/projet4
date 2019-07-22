<?php 
require_once('./model/model.php');
require_once('./model/chapter.php');
require_once('./model/chapterManager.php');

function showChapters() {
    $chapter = new ChapterManager();
    $req = $chapter->get();
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