<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Jean Forteroche</title>
</head>

<body>
    <nav class="menu">
        <ul>
            <li>
                <h2><a href="./index.php">Jean Forteroche</a></h2>
            </li>
            <li><a href="./index.php">Accueil</a> </li>
            <li><a href="/">Chapitres</a></li>
        </ul>
    </nav>
    <section class="chapters-container" id="chapter">
        <div class="chapter">
            <div class="title">
                <h2> <?= htmlspecialchars($chapter['title']) ?></h2>
                <span><?= get_time_ago(strtotime($chapter['date_creation']))  ?> </span>
            </div>
            <p> <?= $chapter['content'] ?> </p>
        </div>
        <div class="comments">
            <h2>Commentaires</h2>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p class='title'>
                    <strong><?= htmlspecialchars($comment['name']) ?></strong>
                    <span><?= get_time_ago(strtotime($comment['date_creation']))  ?></span>
                </p>
                <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                <?php
                }
                $comments->closeCursor();
                if(!$comment) {
                    echo '<p>Il n\'y a pas de commentaire, soyez le premier !</p>';
                }
                ?>
                <a href="?action=addComment&id=<?= $_GET['id']?>">Ajouter un commentaire</a>
            </div>
        </section>
        <footer>Tout droit réservés Jean Forteroche &copy; &mdash; <a href="/"> Connexion</a></footer>
    </body>

    </html>