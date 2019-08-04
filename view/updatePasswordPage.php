<?php ob_start() ?>
<section class="login-container">
    <form action="/updatePassword" method="post">
        <h1>Mot de passe oublié</h1>
        <input type="email" name="email" placeholder="Email">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>