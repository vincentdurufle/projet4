<?php

function addChapterView()
{
    if (isset($_SESSION) && $_SESSION['username'] == 'admin') {
        require('./view/addChapterView.php');
    } else {
        header('Location: /loginUser/?err=$err');
    }
}

function addChapter()
{
    if (isset($_POST['editor_title']) && isset($_POST['editor_content'])) {
        $req = new Chapter([
            'title' => $_POST['editor_title'],
            'content' => $_POST['editor_content']
        ]);
        $addChapter = new ChapterManager();
        $addChapter->add($req);
    }
}

function updateChapter()
{
    if (isset($_SESSION) && $_SESSION['username'] == 'admin') {
        $req = new Chapter([
            'id' => $_GET['id'],
            'title' => $_POST['editor_title'],
            'content' => $_POST['editor_content'],
        ]);
        $updateChapter = new ChapterManager();
        $updateChapter->update($req);
    } else {
        header('Location: /loginUser/?err=$err');
    }
}

function deleteChapter()
{
    if (isset($_GET['id'])) {
        $req = new Chapter(['id' => $_GET['id']]);

        $deleteChapter = new ChapterManager();
        $deleteChapter->delete($req);
    }
}

function addComment()
{
    if(isset($_SESSION['username']) && $_GET['id'] > 0) {
        $req = new Comment([
            'chapter_id' => $_GET['id'],
            'content' => $_POST['editor_content'],
            'name' => $_SESSION['username'],
            'img' => $_SESSION['img']
        ]);
        
        $comment = new CommentManager();
        $comment->add($req);
    }
    header('Location: /chapitre/?id=' . $_GET['id'] . '');
}

function addCommentPage()
{
    if (!isset($_SESSION['username'])) {
        header('Location: /login');
    } else {
        require('./view/addCommentView.php');
    }
}

function deleteComment()
{
    $req = new CommentManager();
    $req->delete();
    header('Location: /moderate');
}

function reportComment()
{
    if(isset($_SESSION['username']) && $_GET['id'] > 0) {
        $report = new CommentManager();
        $report->report();
    }
    
}
