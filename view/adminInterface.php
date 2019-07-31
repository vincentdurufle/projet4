<?php
    if(!isset($_SESSION['username'])) {
        header('Location: index.php?login');
    }
?>


<?php ob_start() ?>

<section class="interface-container">
<h1>Bienvenue, <?= $_SESSION['username'] ?></h1>
    <a href="/addChapter">Ajouter un chapitre</a>
    <a href="/updateChapter">Mettre à jour un chapitre</a>
    <a href="/moderate">Voir les commentaires</a>
    <a href="/disconnect">Déconnexion</a>
</section>


<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>