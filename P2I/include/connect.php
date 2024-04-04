<?php
function getDb()
{
    try {
        $bdd = new PDO(
            "mysql:host=localhost;dbname=ozusquare;charset=utf8",
            "root",
            "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        return $bdd;
    } catch (Exception $e) {
        die('Erreur fatale : ' . $e->getMessage());
    }
}