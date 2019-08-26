<?php

require('./model/Manager.php');

class ChapterController extends Manager
{
    public function showChaptersHome()
    {
        $ChapterManager = new ChapterManager();
        $req = $ChapterManager->getChapters();

        $this->render('home', [
            'chapters' => $req
        ]);
    }
    
    public function showChapters()
    {
        $ChapterManager = new ChapterManager();
        $req = $ChapterManager->getChapters();

        $this->render('chaptersView', [
            'chapters' => $req
        ]);
    }

    public function showChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $Chapter = new Chapter([
                'id' => $_GET['id']
            ]);
            $ChapterManager =  new ChapterManager();
            $req = $ChapterManager->getChapter($Chapter);
            $this->render('updateChapterView', [
                'chapter' => $req
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
            $Chapter = new Chapter([
                'id' => $_GET['id']
            ]);
            $ChapterManager =  new ChapterManager();
            $postChapter = $ChapterManager->getChapter($Chapter);

            $CommentManager = new CommentManager();
            $postComments = $CommentManager->getComments($Chapter);

            $this->render('chapterView', [
                'post' => $postChapter,
                'comments' => $postComments
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
