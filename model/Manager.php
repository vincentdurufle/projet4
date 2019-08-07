<?php

/**
 * helpers class to extends to managers and controllers
 */
class Manager
{
    /**
     * connects to database
     * @return PDO $db
     */
    public function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
            // $db = new PDO('mysql:host=localhost;dbname=vincdgfq_projet4;charset=utf8', 'vincdgfq_vince', 'vincent$12');
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $db;
    }

    /**
     * calculates a timedate from db with current time
     * @param int $time
     * @param fn time()
     * @return string
     */
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

    /**
     * render view from path with array(s) of var
     * @param string $path
     * @param array $var
     * @return php
     */
    public function render($path, $var)
    {
        foreach ($var as $key => $value) {
            $$key = $value;
        }
        require('./view/' . $path . '.php');
    }

    /**
     * render 404 page
     * @return php
     */
    public function error()
    {
        $this->render('404', []);
    }
}
