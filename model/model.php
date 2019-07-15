<?php
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'Il y a moins d\'une seconde.'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'an',
                30 * 24 * 60 * 60       =>  'mois',
                24 * 60 * 60            =>  'jour',
                60 * 60                 =>  'heure',
                60                      =>  'minute',
                1                       =>  'seconde'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'il y  a ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . '';
        }
    }
}

function dbConnect()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    } catch (Excepetion $e) {
        die('Error: ' . $e->getMessage());
    }
}

function showChaptersTitle() {
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, date_creation FROM chapters ORDER BY date_creation DESC');
    return $req;
}

function getChapters()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, date_creation FROM chapters ORDER BY date_creation DESC LIMIT 0, 5');
    return $req;
}


function getChapter($chapterId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, date_creation FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));
    $post = $req->fetch();

    return $post;
}

function getComments($chapterId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, name, content, date_creation FROM comments WHERE chapter_id = ? ORDER BY date_creation DESC');
    $comments->execute(array($chapterId));

    return $comments;
}
