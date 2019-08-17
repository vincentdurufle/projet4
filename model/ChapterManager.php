<?php
require_once('./model/Manager.php');

class ChapterManager extends Manager
{   
    /**
   * gets all data from chapters
   * @return array
   */
    public function getChapters()
    {
        $db = $this->dbConnect();
        $chapters = $db->query('SELECT id, title, content, date_creation FROM chapters ORDER BY date_creation ASC');
        return $chapters;

        $db = null;
    }

    /**
   * gets all data from selected chapter with id
   * @param int $_GET['id]
   * @return array
   */
    public function getChapter()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, date_creation FROM chapters WHERE id = :id');
        $req->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $req->execute();
        $post = $req->fetch();

        return $post;
        $db = null;
    }

    /**
   * adds preformated chapter to db
   * @param object $chapter
   * @return void
   */
    public function add(Chapter $chapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters(title, content, date_creation) VALUES (:title, :content, NOW())');

        $req->bindValue(':title', $chapter->title());
        $req->bindValue(':content', $chapter->content());

        $req->execute();
        $db = null;
        header('Location: /admin');
    }

    /**
   * updates preformated chapter to db
   * @param object $chapter
   * @return void
   */
    public function update(Chapter $chapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE chapters SET title = :title, content = :content WHERE id = :id ');

        $req->bindValue(':title', $chapter->title());
        $req->bindValue(':content', $chapter->content());
        $req->bindValue(':id', $chapter->id());

        $req->execute();
        $db = null;
    }

    /**
   * delete a column in chapters db
   * @param object $chapter
   * @return void
   */
    public function delete(Chapter $chapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT TRUE FROM comments WHERE chapter_id = :id');
        $req->bindValue(':id', $chapter->id());
        $req->execute();

        $exists = $req->fetch();
        if ($exists) {
            $deleteChapter = $db->prepare('DELETE chapters, comments FROM chapters INNER JOIN comments ON comments.chapter_id = chapters.id WHERE chapters.id = :id');
            $deleteChapter->bindValue(':id', $chapter->id());
            $deleteChapter->execute();
        } else {
            $deleteChapter = $db->prepare('DELETE FROM chapters WHERE id = :id');
            $deleteChapter->bindValue(':id', $chapter->id());
            $deleteChapter->execute();
        }
        header('Location: /updateChapter');
        $db = null;
    }
}
