<?php
function dbConnect()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    } catch (Excepetion $e) {
        die('Error: ' . $e->getMessage());
    }
}

function showChaptersTitle() {
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM chapters ORDER BY date_creation DESC');
    return $req;
}

function getChapters()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM chapters ORDER BY date_creation DESC LIMIT 0, 5');
    return $req;
}


function getChapter($chapterId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));
    $post = $req->fetch();

    return $post;
}

function getComments($chapterId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, name, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY date_creation DESC');
    $comments->execute(array($chapterId));

    return $comments;
}
