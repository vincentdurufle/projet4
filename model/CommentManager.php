<?php

class CommentManager extends Manager
{
    public function getComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, date_creation, img FROM comments WHERE chapter_id = :id ORDER BY date_creation DESC');
        $comments->execute(array(':id' => $_GET['id']));

        return $comments;
    }

    public function getCommentsUser()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, date_creation FROM comments WHERE name = :name ORDER BY date_creation DESC');
        $comments->execute(array(':name' => $_SESSION['username']));

        return $comments;
    }

    public function getCommentsAdmin()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM comments WHERE report = 0 ORDER BY date_creation DESC');
        $reports = $db->query('SELECT * FROM comments WHERE report = 1 ORDER BY date_creation DESC');
        
        return array($comments, $reports);
    }

    public function add(Comment $comment)
    {
        $db = $this->dbConnect();
        $new = $db->prepare('INSERT INTO comments(chapter_id, name, img, content, date_creation) VALUES (:chapter_id, :name, :img, :content, NOW())');

        $new->bindValue(':chapter_id', $comment->chapter_id());
        $new->bindValue(':content', $comment->content());
        $new->bindValue(':name', $comment->name());
        $new->bindValue(':img', $comment->img());
        
        $new->execute();
    }

    public function delete()
    {
        $db = $this->dbConnect();
        
        $deleteChapter = $db->prepare('DELETE FROM comments WHERE id = :id');
        $deleteChapter->bindValue(':id', $_GET['id']);
        $deleteChapter->execute();
    }

    public function report() {
        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE comments SET report = 1 WHERE id = :id');
        $req->bindValue(':id', $_GET['id']);
        $req->execute();
        header('Location: /chapitre/?id='.$_GET['chapterid'].'');
    }
}
