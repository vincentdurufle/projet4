<?php
require('./controller/controller.php');

if(isset($_GET['action'])) {
    if($_GET['action'] == 'showChapters') {
        showChapters();
    } elseif ($_GET['action'] == 'post') {
        if(isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
            echo 'Erreur : bullshit';
        }
    }
} else {
    showChapters();
}