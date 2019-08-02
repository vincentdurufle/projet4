<?php 

function showChapters() {
    $chapter = new ChapterManager();
    $req = $chapter->getChapters();
    
    require('./view/home.php');
}

function showChapter() {
    if (isset($_GET['id']) && $_GET['id'] > 0 ) {
        $req =  new ChapterManager();
        $chapter = $req->getChapter();
        
        require('./view/updateChapterView.php');
    }
}

function showTitles() {
    $req = new ChapterManager();
    $chapters = $req->getChapters();

    require('./view/showChaptersTitleView.php');
}

function post() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $chapter = new ChapterManager();
        $post = $chapter->getChapter();
    
        $req = new CommentManager();
        $comments = $req->getComments();
    
        require('./view/chapterView.php');
    }
}

function showComments() {
    $req = new CommentManager();
    if($_SESSION['username'] == 'admin') {
        list($comments, $reports) = $req->getCommentsAdmin();
        require('./view/commentsViewAdmin.php');
    } else {
        $comments = $req->getCommentsUser();
        require('./view/commentsViewUser.php');
    }
    
}

