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
    <?php if (isset($link)) {
       echo $link;
    }
    ?>
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
            <li><a href="?action=loginUser">Connexion</a></li>
        </ul>
    </nav>
    <?= $content ?>
    <footer>Tout droit réservés Jean Forteroche &copy; &mdash; <a href="?action=loginAdmin"> Connexion</a></footer>
    
    <?php if (isset($script)) {
       echo $script;
    }
    ?>
    <script src="./public/js/script.js"></script>
</body>

</html>