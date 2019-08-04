<?php ob_start() ?>

<section class="login-container">


    <form action="/newPassword" method="post" autocomplete="off">
        <h1>Entrez un nouveau mot de passe</h1>
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>

</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>