<?php

function addChapterData() {
    $db = dbConnect();
    $chapter = $db->prepare('INSERT INTO chapters(title, content, date_creation) VALUES (?, ?, NOW())');
    $chapter->execute(array($_POST['editor_title'], $_POST['editor_content']));
}



function updateChapterData() {
    $db = dbConnect();
    $newChapter = $db->prepare('UPDATE chapters SET title = ?, content = ? WHERE id = ? ');
    $newChapter->execute(array($_POST['editor_title'], $_POST['editor_content'], $_GET['id']));
}