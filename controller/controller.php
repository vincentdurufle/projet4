<?php 

function showChapters() {
    $chapter = new ChapterManager();
    $req = $chapter->getChapters();
    
    require('./view/home.php');
}

function showChapter() {
    $chapter =  new ChapterManager();
    
    require('./view/updateChapterView.php');
}

function post() {
    $chapter = new ChapterManager();
    $post = $chapter->getChapter();

    $req = new CommentManager();
    $comments = $req->getComments();

    require('./view/chapterView.php');
}

function showTitles() {
    $req = showChaptersTitle();

    require('./view/showChaptersTitleView.php');
}