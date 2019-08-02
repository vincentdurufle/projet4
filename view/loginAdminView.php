<?php
$err = 'Mauvais identifiant ou mot de passe !';
?>

<?php ob_start() ?>
<section class="login-container">
    <?php
    if (isset($_GET['err'])) {
        echo '<div class="error-container"><p>' . $err . '</p></div>';
    }
    ?>
    <form action="/checkAdmin" method="post">
        <h1>Connexion</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>