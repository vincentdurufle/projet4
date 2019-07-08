<?php 
require('./model/model.php');

$posts = getChapters();

require('./view/home.php');