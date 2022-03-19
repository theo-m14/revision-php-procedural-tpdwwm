<?php
require_once('dev.env.php');

function bddcall(){
    try {
        $bdd = new PDO('mysql:dbname=' . DATABASE .';host=' . SERVER, USER, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function insertLine($bdd,$infoLine){
    try {
        $insertLine = $bdd->prepare('INSERT INTO lignes(lignes.name,lignes.terminus_a,lignes.terminus_b) VALUES (:name,:terminus_a,:terminus_b)');
        $insertLine->execute(array(
            'name' => $infoLine['name'],
            'terminus_a' => $infoLine['termA'],
            'terminus_b' => $infoLine['termB'],
        ));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}