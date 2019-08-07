<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?login');
}
?>

<?php ob_start() ?>

<section class="chapter-containers">
    <h1 class="title-container">Veuillez séléctionner un chapitre pour le mettre à jour.</h1>
    <div class="chapter">


        <?php
        while ($chapter = $chapters->fetch()) {
            ?>
            <div class="title">
                <h1><a href="/updateChapter/?id=<?= htmlspecialchars($chapter['id']) ?>"><?= htmlspecialchars($chapter['title']) ?></a></h1>
                <span><?= $this->get_time_ago(strtotime($chapter['date_creation'])) ?></span> 
                <a class="delete" href="/deleteChapter/?id=<?= htmlspecialchars($chapter['id']) ?>">X</a>
            </div>
        <?php
        }
        ?>

    </div>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>