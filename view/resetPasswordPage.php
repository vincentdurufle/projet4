<?php ob_start() ?>

<section class="login-container">


    <form action="/resetPassword/?email=<?= $_GET['email'] ?>&token=<?= $_GET['token'] ?>" method="post" autocomplete="off">
        <h1>Nouveau mot de passe</h1>
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>

</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>