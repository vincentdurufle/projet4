<?php

class CommentManager extends Manager
{
    /**
     * gets all data from comments column in db
     *@param object $chapter
     * @return array
     */
    public function getComments(Chapter $chapter)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, date_creation, img FROM comments WHERE chapter_id = :id ORDER BY date_creation DESC');
        $comments->bindValue(':id', $chapter->id());
        $comments->execute();

        return $comments;
        $db = null;
    }

    /**
     * gets all comments from name column in db
     * @param object $comment
     * @return array
     */
    public function getCommentsUser(Comment $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, date_creation FROM comments WHERE name = :name ORDER BY date_creation DESC');
        $comments->bindValue(':name', $comment->name());
        $comments->execute();

        return $comments;
        $db = null;
    }

    /**
     * gets all comments from name column in db sorted by report=0 or 1
     * @return array
     */
    public function getCommentsAdmin()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM comments WHERE report = 0 ORDER BY date_creation DESC');
        $reports = $db->query('SELECT * FROM comments WHERE report = 1 ORDER BY date_creation DESC');

        return array($comments, $reports);
        $db = null;
    }

        /**
     * add comment in db
     * @param object $comment
     * @return void
     */
    public function add(Comment $comment)
    {
        $db = $this->dbConnect();
        $new = $db->prepare('INSERT INTO comments(chapter_id, name, img, content, date_creation) VALUES (:chapter_id, :name, :img, :content, NOW())');

        $new->bindValue(':chapter_id', $comment->chapter_id());
        $new->bindValue(':content', $comment->content());
        $new->bindValue(':name', $comment->name());
        $new->bindValue(':img', $comment->img());

        $new->execute();
        $db = null;
    }


    /**
     * delete comment in db with id
     * @param object $comment
     * @return void
     */
    public function delete(Comment $comment)
    {
        $db = $this->dbConnect();

        $delete = $db->prepare('DELETE FROM comments WHERE id = :id');
        $delete->bindValue(':id', $comment->id());
        $delete->execute();
        $db = null;
    }

    /**
     * sets report=0 in db with id
     * @param object $comment
     * @return void
     */
    public function report(Comment $comment)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE comments SET report = 1 WHERE id = :id');
        $req->bindValue(':id', $comment->id());
        $req->execute();
        $db = null;
        header('Location: /chapitre/?id=' . $_GET['chapterid'] . '');
    }
}
