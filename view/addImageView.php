<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?action=loginUser');
}
?>
<?php ob_start() ?>

<section class="login-container">
    <form action="/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" name="submit" value="Submit" />
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>