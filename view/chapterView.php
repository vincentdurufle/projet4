<?php ob_start() ?>
<section class="chapters-containers" id="chapter">
    <div class="chapter">
        <div class="title">
            <h2> <?= htmlspecialchars($post['title']) ?></h2>
            <span><?= $this->get_time_ago(strtotime($post['date_creation']))  ?> </span>


        </div>
        <p> <?= $post['content'] ?> </p>
    </div>
    <div class="comments">
        <h2>Commentaires</h2>
        <?php
        while ($comment = $comments->fetch()) {
            ?>
            <p class='title'>
                <img class="picture-comment" src="/public/img/<?= htmlspecialchars($comment['img']) ?>" alt="">
                <strong><?= htmlspecialchars($comment['name']) ?></strong>
                <span><?= $this->get_time_ago(strtotime($comment['date_creation'])) ?></span>

            </p>
            <div class="comment-content">
                <?= htmlspecialchars($comment['content']) ?>
                <a href="/report/?id=<?= htmlspecialchars($comment['id']) ?>&chapterid=<?= htmlspecialchars($post['id']) ?>">Signaler</a>
            </div>
        <?php
        }
        if ($comments->rowCount() == 0) {
            echo '<p>Il n\'y a pas de commentaire, soyez le premier !</p>';
        }
        ?>
        <a href="/addComment/?id=<?= htmlspecialchars($_GET['id']) ?>">Ajouter un commentaire</a>
    </div>
</section>
<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>