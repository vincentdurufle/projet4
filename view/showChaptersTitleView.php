<?php
    if(!isset($_SESSION['username'])) {
        header('Location: index.php?login');
    }
?>

<?php ob_start() ?>

    <section class="chapters-containers">
    <h1>Veuillez séléctionner un chapitre pour le mettre à jour.</h1>
    <div class="chapter">
    

<?php
while ($chapter = $req->fetch()) {
    echo '<div class="title"><h1><a href="?action=updateChapter&id='. $chapter['id'] .'">' . $chapter['title'] . '</a></h1><span>' . get_time_ago(strtotime($chapter['date_creation'])) .'</span> <a class="delete" href="?action=deleteChapter&id=' . $chapter['id'] .' ">X</a></div>';
}
?>

</div>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>