<?php
    if(!isset($_SESSION['username'])) {
        header('Location: index.php?loginUser');
        echo $_SESSION;
    }
?>


<?php ob_start() ?>

<section class="interface-container">
<h1>Bienvenue, <?= $_SESSION['username'] ?></h1> <img class="profile-picture" src="./upload/<?= $_SESSION['img'] ?>" alt="">

    <a href="?action=addProfilePicture">Ajouter une photo de profil</a>
    <a href="?action=moderateComments">Voir ses commentaires</a>
    <a href="?action=disconnect">Déconnexion</a>
</section>


<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>