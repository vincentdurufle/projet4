<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/normalize.css">
    <link rel="stylesheet" href="/public/css/media-queries.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha256-soW/iAENd5uEBh0+aUIS1m2dK4K6qTcB9MLuOnWEQhw=" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/png" href="/public/img/favicon.png"/>
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
                    <h2><a href="/">Jean Forteroche</a></h2>
                </li>
                <div class="menu-list-container">
                    <li><a href="/">Accueil</a> </li>
                    <li><a href="/chapitres">Chapitres</a></li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] != 'admin' ){
                        echo '<li class="profile"><a class="profile-username" href="/login"><img class="profile-picture" src="/public/img/' . $_SESSION['img'] . '" alt="photo de profile">' . $_SESSION['username'] . '</a></li>';
                    } elseif (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
                        echo '<li class="profile"><a class="profile-username" href="/admin"><img class="profile-picture" src="/public/img/' . $_SESSION['img'] . '" alt="photo de profile">' . $_SESSION['username'] . '</a></li>';
                    } else {
                        echo '<li><a href="/login">Connexion</a></li>';
                    }
                    ?>
                </div>
                <i class="fas fa-bars"></i>
            </ul>
        </nav>
        <div class="menu-before"></div>
    <?= $content ?>

    <footer>Tout droit réservés Jean Forteroche &copy; &mdash; <a href="/admin"> Admin</a></footer>

    <?php if (isset($script)) {
        echo $script;
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha256-ITwLtH5uF4UlWjZ0mdHOhPwDpLoqxzfFCZXn1wE56Ps=" crossorigin="anonymous"></script>
    <script src="../public/js/script.js"></script>
</body>

</html>