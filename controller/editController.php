<?php
require_once('./model/editData.php');

function addChapterView() {
    require('./view/addChapterView.php');
}

function addChapter() {
    addChapterData();
}

function updateChapter() {
    updateChapterData();
    header('Location: index.php?action=showChaptersTitle');
}

function deleteChapter() {
    deleteChapterData();
    header('Location: index.php?action=showChaptersTitle');
}