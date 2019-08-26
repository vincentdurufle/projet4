<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?action=loginUser');
}
?>
<?php ob_start() ?>

<section class="login-container">
    <form action="/upload" method="post" enctype="multipart/form-data">
        <label for="file" class="upload">Choisir une image</label>
        <input type="file" name="image" id="file" />
        <input type="submit" name="submit" value="Submit" />
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>