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

<form action="/create" method="post" autocomplete="off">
    <h1>Créer un compte</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mot de passe" autocomplete="user-password">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>


    <form action="/loginUser" method="post">
        <h1>S'identifier</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" name="submit" placeholder="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>