<?php
function dbConnect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
    catch(Excepetion $e) {
        die('Error: ' .$e->getMessage());
    }
}

function getChapters() {
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM chapters ORDER BY date_creation DESC LIMIT 0, 5');
    return $req;
}
?>