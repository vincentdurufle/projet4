<?php
    $err = 'Mauvais identifiant ou mot de passe';
?>

<?php ob_start() ?>
<section class="login-container">
<?php 
    if(isset($_GET['err'])) {
        echo '<div class="error-container"><p>' . $err . '</p></div>';
    }
?>

<form action="?action=createUser" method="post">
    <h1>Créer un compte</h1>
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username">
        <label for="email">Email</label>
        <input type="email" name="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>


    <form action="?action=checkLoginUser" method="post">
        <h1>S'identifier</h1>
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>