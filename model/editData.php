<?php

function addChapterData()
{
    $db = dbConnect();
    $chapter = $db->prepare('INSERT INTO chapters(title, content, date_creation) VALUES (?, ?, NOW())');
    $chapter->execute(array($_POST['editor_title'], $_POST['editor_content']));
}



function updateChapterData()
{
    $db = dbConnect();
    $newChapter = $db->prepare('UPDATE chapters SET title = ?, content = ? WHERE id = ? ');
    $newChapter->execute(array($_POST['editor_title'], $_POST['editor_content'], $_GET['id']));
}

function deleteChapterData()
{
    $db = dbConnect();
    $check = $db->prepare('SELECT TRUE FROM comments WHERE chapter_id = ?');
    $check->execute(array($_GET['id']));
    $exists = $check->fetch();
    if ($exists) {
        $deleteChapter = $db->prepare('DELETE chapters, comments FROM chapters INNER JOIN comments ON comments.chapter_id = chapters.id WHERE chapters.id = ?');
        $deleteChapter->execute(array($_GET['id']));
    } else {
        $deleteChapter = $db->prepare('DELETE FROM chapters WHERE id = ?');
        $deleteChapter->execute(array($_GET['id']));
    }
}
