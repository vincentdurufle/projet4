<?php ob_start() ?>
    <section class="chapters-container" id="chapter">
        <div class="chapter">
            <div class="title">
                <h2> <?= htmlspecialchars($post['title']) ?></h2>
                <span><?= $chapter->get_time_ago(strtotime($post['date_creation']))  ?> </span>
            </div>
            <p> <?= $post['content'] ?> </p>
        </div>
        <div class="comments">
            <h2>Commentaires</h2>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p class='title'>
                    <strong><?= htmlspecialchars($comment['name']) ?></strong>
                    <span><?= $chapter->get_time_ago(strtotime($comment['date_creation']))  ?></span>
                </p>
                <div class="comment-content">
                    <?= nl2br($comment['content']) ?>
                    <a href="?action=reportComment&id<?= $comment['id'] ?>">Signaler</a>
                </div>
                <?php
                if(!$comment) {
                    echo '<p>Il n\'y a pas de commentaire, soyez le premier !</p>';
                }
                }
                $comments->closeCursor();
                        ?>
                <a href="?action=addComment&id=<?= $_GET['id']?>">Ajouter un commentaire</a>
            </div>
        </section>
        <?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>