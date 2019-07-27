<?php

function showChaptersTitle() {
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, date_creation FROM chapters ORDER BY date_creation DESC');
    return $req;
}
