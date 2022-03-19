<?php
require_once('../src/bddcall.php');
$bdd = bddcall();


if(!isset($_GET['id']) || !idIsValid($bdd,$_GET['id'])){
    header('Location: index.php?error=uncaughtId');
}else{
    deleteLine($bdd,$_GET['id']);
    header('Location: index.php?sucess');
}