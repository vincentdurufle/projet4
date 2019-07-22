<?php
require_once('./model/Manager.php');

class ChapterManager extends Manager {

    public function get() {
        $db = dbConnect();
        $chapters = $db->query('SELECT id, title, content, date_creation FROM chapters ORDER BY date_creation DESC LIMIT 0, 5');
        return $chapters;
    }

    public function add(Chapter $chapter) {
        $db = dbConnect();
        $chapter = $db->prepare('INSERT INTO chapters(title, content, date_creation) VALUES (?, ?, NOW())');
        $chapter->execute(array($chapter['title'], $chapter['content']));
    }

    
}