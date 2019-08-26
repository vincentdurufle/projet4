<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?action=loginUser');
}
?>
<?php ob_start() ?>

<section class="editor-container">

    <form action="/addCommentData/?id=<?= htmlspecialchars($_GET['id']) ?>" method="post">
        <label for="editor_content">Commentaire</label>
        <br>
        <textarea name="editor_content" id="editor-comment"></textarea>
        <input type="submit" value="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>