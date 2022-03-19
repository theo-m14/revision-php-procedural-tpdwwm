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
        $insertLine = $bdd->prepare('INSERT INTO lignes(lignes.name,lignes.terminus_a,lignes.terminus_b,lignes.id_compagnies) VALUES (:name,:terminus_a,:terminus_b,:id_compagnie)');
        $insertLine->execute(array(
            'name' => $infoLine['name'],
            'terminus_a' => $infoLine['termA'],
            'terminus_b' => $infoLine['termB'],
            'id_compagnie' => $infoLine['compagnie'],
        ));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllLine($bdd){
    try {
        $requestAllLine = $bdd->query('SELECT *,compagnies.name AS comp_name, lignes.name AS ligne_name FROM lignes LEFT JOIN compagnies ON lignes.id_compagnies=compagnies.id');
        return $requestAllLine->fetchAll();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function getLineSearched($bdd,$letters){
    try {
        $requestLineSearched = $bdd->prepare('SELECT *,compagnies.name AS comp_name, lignes.name AS ligne_name FROM lignes LEFT JOIN compagnies ON lignes.id_compagnies=compagnies.id WHERE lignes.name LIKE :letters');
        $requestLineSearched->execute(array(
            'letters' => "%" . $letters . "%",
        ));
        $result = $requestLineSearched->fetchAll();
        return json_encode($result);
    } catch (\PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function getLineAndCompagnieSearched($bdd,$letters,$idCompagnie){
    try {
        $requestLineSearched = $bdd->prepare('SELECT *,compagnies.name AS comp_name, lignes.name AS ligne_name FROM lignes LEFT JOIN compagnies ON lignes.id_compagnies=compagnies.id WHERE lignes.name LIKE :letters AND compagnies.id=:id');
        $requestLineSearched->execute(array(
            'letters' => "%" . $letters . "%",
            'id' => $idCompagnie,
        ));
        $result = $requestLineSearched->fetchAll();
        return json_encode($result);
    } catch (\PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function idIsValid($bdd,$id){
    try {
        $request = $bdd->prepare('SELECT COUNT(*) as numberLine FROM lignes WHERE id=:id');
        $request->execute(array(
            'id' => $id,
        ));
        $result = $request->fetch();
        return ($result['numberLine']==1);
    } catch (\PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function getLineById($bdd,$id){
    try {
        $request = $bdd->prepare('SELECT * FROM lignes WHERE id=:id');
        $request->execute(array(
            'id' => $id,
        ));
        $result = $request->fetch();
        return $result;
    } catch (\PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function modifLine($bdd,$infoLine,$id){
    try {
        $insertLine = $bdd->prepare('UPDATE lignes SET lignes.name=:name,lignes.terminus_a=:terminus_a,lignes.terminus_b=:terminus_b WHERE id=:id');
        $insertLine->execute(array(
            'name' => $infoLine['name'],
            'terminus_a' => $infoLine['termA'],
            'terminus_b' => $infoLine['termB'],
            'id' => $id,
        ));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function deleteLine($bdd,$id){
    try {
       $requestDelete = $bdd->prepare('DELETE FROM lignes WHERE id=:id');
       $requestDelete->execute(array(
            'id' => $id,
       ));
    }  catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllCompagnies($bdd){
    try {
        $requestAllCompagnies = $bdd->query("SELECT * FROM compagnies");
        return $requestAllCompagnies->fetchAll();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function compagnieIsValid($bdd,$id){
    try {
        $request = $bdd->prepare('SELECT COUNT(*) as numberLine FROM compagnies WHERE id=:id');
        $request->execute(array(
            'id' => $id,
        ));
        $result = $request->fetch();
        return ($result['numberLine']==1);
    } catch (\PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}