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
        $user = "admin";
        $password = "SchoolAPPS-06";
        $db_name = "schoolapps";
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
