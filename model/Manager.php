<?php
class Manager
{
    public function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $db;
    }

    public function get_time_ago($time)
    {   
        date_default_timezone_set('Europe/Paris');
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return 'Il y a moins d\'une seconde.';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  'an',
            30 * 24 * 60 * 60       =>  'mois',
            24 * 60 * 60            =>  'jour',
            60 * 60                 =>  'heure',
            60                      =>  'minute',
            1                       =>  'seconde'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return 'il y  a ' . $t . ' ' . $str . ($t > 1 ? 's' : '') . '';
            }
        }
    }
}
