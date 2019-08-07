<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?login');
}
?>

<?php ob_start() ?>

<section>

    <section class="comments-container">
        <h1 class="title-container">Veuillez séléctionner un commentaire pour le supprimer.</h1>


        <div class="comments">
            <h2>Commentaires</h2>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p class='title'>
                    <strong><?= htmlspecialchars($comment['name']) ?></strong>
                    <span><?= $this->get_time_ago(strtotime($comment['date_creation']))  ?></span>
                </p>
                <div class="comment-content">
                    <?= htmlspecialchars($comment['content']) ?>
                    <a class="delete" href="/deleteComment/?id=<?= htmlspecialchars($comment['id']) ?>">X</a>
                </div>
            <?php
            }
            if ($comments->rowCount() == 0) {
                echo '<p>Il n\'y a pas de commentaires !</p>';
            }
            ?>
        </div>
    </section>

    <?php $content = ob_get_clean() ?>

    <?php require('./view/template.php') ?>