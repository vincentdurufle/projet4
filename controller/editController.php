<?php

require_once('./model/editData.php');

function addChapterView() {
    require('./view/addChapterView.php');
}

function addChapter() {
    $req = new Chapter([
        'title' => $_POST['editor_title'],
        'content' => $_POST['editor_content']
    ]);
    echo $req->title();
    // $req = new ChapterManager();
    // $req->add($chapter);
}

function updateChapter() {
    updateChapterData();
    header('Location: index.php?action=showChaptersTitle');
}

function deleteChapter() {
    deleteChapterData();
    header('Location: index.php?action=showChaptersTitle');
}