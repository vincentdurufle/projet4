<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?action=loginUser');
}
$link = '<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.2/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />';
$script = '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.2/js/froala_editor.pkgd.min.js"></script>';
?>
<?php ob_start() ?>

<section class="editor-container">

    <form action="/addCommentData/?id=<?= $_GET['id'] ?>" method="post">
        <label for="editor_content">Commentaire</label>
        <textarea name="editor_content" id="editor"></textarea>
        <input type="submit" value="Envoyer">
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>