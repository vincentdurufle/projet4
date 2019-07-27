<?php

class CommentManager extends Manager
{
    public function getComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, date_creation FROM comments WHERE chapter_id = :id ORDER BY date_creation DESC');
        $comments->execute(array(':id' => $_GET['id']));

        return $comments;
    }

    public function add() {
        $db = $this->dbConnect();
        
    }
}
