<?php ob_start() ?>

<section class="chapters-container" id="chapter">
        <?php
        while ($data = $chapters->fetch()) {
            
            ?>
            <div class="chapter">
                <div class="title">
                    <h2> <?= htmlspecialchars($data['title']) ?></h2>
                    <span><?= $this->get_time_ago(strtotime($data['date_creation']))  ?> </span>
                    
                </div>
                <p> <?= $data['content'] ?> </p>
                <a href="/chapitre/?id=<?= htmlspecialchars($data['id']) ?>">Commentaires</a>

            </div>
        <?php
        }
        ?>
    </section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>