<?php
    if(!isset($_SESSION['username'])) {
        header('Location: /login');
    }
?>


<?php ob_start() ?>

<section class="interface-container">
    <div class="interface">
        <a href="/picture"><i class="fas fa-portrait"></i> Ajouter une photo de profil</a>
        <a href="/moderate"><i class="far fa-comments"></i> Voir ses commentaires</a>
        <a href="/disconnect"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
    </div>
</section>


<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>