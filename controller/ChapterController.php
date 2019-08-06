<?php

require('./model/Manager.php');

class ChapterController extends Manager
{
    public function showChaptersHome()
    {
        $chapter = new ChapterManager();
        $req = $chapter->getChapters();

        $this->render('home', [
            'chapters' => $req
        ]);
    }
    
    public function showChapters()
    {
        $chapter = new ChapterManager();
        $req = $chapter->getChapters();

        $this->render('chaptersView', [
            'chapters' => $req
        ]);
    }

    public function showChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $req =  new ChapterManager();
            $chapter = $req->getChapter();
            $this->render('updateChapterView', [
                'chapter' => $chapter
            ]);
        }
    }

    public function showTitles()
    {
        $req = new ChapterManager();
        $chapters = $req->getChapters();

        $this->render('showChaptersTitleView', [
            'chapters' => $chapters
        ]);
    }

    public function post()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $chapter = new ChapterManager();
            $post = $chapter->getChapter();

            $req = new CommentManager();
            $comments = $req->getComments();

            $this->render('chapterView', [
                'post' => $post,
                'comments' => $comments
            ]);
        }
    }

    public function addChapter()
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
    public function updateChapter()
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

    public function deleteChapter()
    {
        if (isset($_GET['id'])) {
            $req = new Chapter(['id' => $_GET['id']]);

            $deleteChapter = new ChapterManager();
            $deleteChapter->delete($req);
        }
    }

    public function addChapterView()
    {
        if (isset($_SESSION) && $_SESSION['username'] == 'admin') {
            $this->render('addChapterView', []);
        } else {
            header('Location: /loginUser/?err=$err');
        }
    }
}
