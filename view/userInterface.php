<?php $title='Boobs' ?>
<?php ob_start() ?>

<section class="interface-container">
<h1>Bienvenue</h1>
    <a href="./addChapter.php">Ajouter un chapitre</a>
    <a href="">Mettre à jour un chapitre</a>
    <a href="">Voir les commentaires</a>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./template.php') ?>