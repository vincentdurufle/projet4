<?php 
require('./model/model.php');

function showChapters() {
    $posts = getChapters();
    
    require('./view/home.php');
}

function post() {
    $chapter = getChapter($_GET['id']);
    $comments = getComments($_GET['id']);

    require('./view/chapterView.php');
}
