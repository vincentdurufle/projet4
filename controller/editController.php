<?php

function addChapterView() {
    require('./view/addChapterView.php');
}

function addChapter() {
    $req = new Chapter([
        'title' => $_POST['editor_title'],
        'content' => $_POST['editor_content']
    ]);
    $addChapter = new ChapterManager();
    $addChapter->add($req);

}

function updateChapter() {
    $req = new Chapter([
        'id' => $_GET['id'],
        'title' => $_POST['editor_title'],
        'content' => $_POST['editor_content'],
    ]);
    $updateChapter = new ChapterManager();
    $updateChapter->update($req);

    header('Location: index.php?action=showChaptersTitle');
}

function deleteChapter() {
    $req = new Chapter(['id' => $_GET['id']]);

    $deleteChapter = new ChapterManager();
    $deleteChapter->delete($req);
    
}

function addComment() {
    $req = new Comment([
        'chapter_id'=> $_GET['id'],
        'name'=> $_SESSION['username'],
        'content'=> $_POST['editor_content']
    ]);
    $comment = new CommentManager();
    $comment->add($req);
    header('Location: index.php?action=post&id='.$_GET['id'].'');
}

function addCommentPage() {
    require('./view/addCommentView.php');
}

function deleteComment() {
    $req = new CommentManager();
    $req->delete();
    header('Location: index.php?action=moderateComments');
}

function reportComment() {
    $report = new CommentManager();
    $report->report();
}