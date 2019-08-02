<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php?login');
}
?>

<?php ob_start() ?>

<section>

    <section class="chapters-containers">
        <h1>Veuillez séléctionner un commentaire pour le supprimer.</h1>


        <div class="comments">
            <h2>Commentaires</h2>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p class='title'>
                    <strong><?= $comment['name'] ?></strong>
                    <span><?= $req->get_time_ago(strtotime($comment['date_creation']))  ?></span>
                </p>
                <div class="comment-content">
                    <?= nl2br($comment['content']) ?>
                    <a class="delete" href="/deleteComment/?id=<?= $comment['id'] ?>">X</a>
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