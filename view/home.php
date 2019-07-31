<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Jean Forteroche</title>
</head>

<body>
    <section class="header">
        <nav>
            <ul>
                <li>
                    <h2><a href="/">Jean Forteroche</a></h2>
                </li>
                <li><a href="/">Accueil</a> </li>
                <li><a href="/">Chapitres</a></li>
                <li><a href="/login">Connexion</a></li>
            </ul>
        </nav>
        <h1>Billet simple pour l'Alaska</h1>
        <h4>Le prochain livre de Jean Forteroche</h4>
        <a href="#chapter"><i class="fas fa-book"></i></a>
    </section>
    <section class="chapters-container" id="chapter">
        <?php
        while ($data = $req->fetch()) {
            ?>
            <div class="chapter">
                <div class="title">
                    <h2> <?= htmlspecialchars($data['title']) ?></h2>
                    <span><?= $chapter->get_time_ago(strtotime($data['date_creation'])) ?> </span>
                </div>
                <p> <?= $data['content'] ?> </p>
                <a href="/chapitre/?id=<?= $data['id'] ?>">Commentaires</a>
                
            </div>
        <?php
        }
        $req->closeCursor();
        ?>
    </section>
    <footer>Tout droit réservés Jean Forteroche &copy; &mdash; <a href="/admin">&#160; Admin</a></footer>
</body>

</html>