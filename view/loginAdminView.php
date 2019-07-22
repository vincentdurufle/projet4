<?php
    $err = 'Mauvais identifiant ou mot de passe !';
?>

<?php ob_start() ?>
<section class="login-container">
<?php 
    if(isset($_GET['err'])) {
        echo '<div class="error-container"><p>' . $err . '</p></div>';
    }
?>
    <form action="?action=checkLoginAdmin" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>