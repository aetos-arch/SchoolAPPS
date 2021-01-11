<?php

class Connexion
{
    protected static $bdd;

    public function __construct()
    {
    }
    public static function initConnexion()
    {
        $db_host = "localhost";
        $user = "root";
        $password = "root";
        $db_name = "SchoolAPPS";
        $dns = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        try {
            self::$bdd = new PDO($dns, $user, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
<?php
Connexion::initConnexion();
?>
