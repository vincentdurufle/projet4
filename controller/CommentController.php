<?php

class CommentController extends Manager{
    public function addComment()
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

    public function addCommentPage()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /login');
        } else {
            $this->render('addCommentView', []);
        }
    }
    public function deleteComment()
    {
        $req = new CommentManager();
        $req->delete();
        header('Location: /moderate');
    }
    public function reportComment()
    {
        if(isset($_SESSION['username']) && $_GET['id'] > 0) {
            $report = new CommentManager();
            $report->report();
        }
        
    }
    
    public function showComments() {
        $req = new CommentManager();
        if($_SESSION['username'] == 'admin') {
            list($comments, $reports) = $req->getCommentsAdmin();
            $this->render('commentsViewAdmin', [
                'comments' => $comments,
                'reports' => $reports
            ]);
        } else {
            $comments = $req->getCommentsUser();
            $this->render('commentsViewUser', [
                'comments' => $comments
            ]);
        }
    }
}