<?php
require_once('../src/bddcall.php');
$bdd=bddcall();

if(isset($_POST)){
    if(isset($_POST['name']) && strlen($_POST['name']) > 2){
        if(isset($_POST['termA']) && strlen($_POST['termA']) >2){
            if(isset($_POST['termB']) && strlen($_POST['termB']) >2){
                    if(compagnieIsValid($bdd,$_POST['compagnie'])){
                        $infoLine = [
                            'name' => htmlspecialchars($_POST['name']),
                            'termA' => htmlspecialchars($_POST['termA']),
                            'termB' => htmlspecialchars($_POST['termB']),
                            'compagnie' => $_POST['compagnie'],
                        ];
                        insertLine($bdd,$infoLine);
                        header('Location:index.php?sucess');
                    }
            }else{
                header('Location:index.php?error=termB');
            }
        }else{
            header('Location:index.php?error=termA');
        }
    }else{
        header('Location:index.php?error=name');
    }
}else{
    header('Location:index.php?error=noForm');
}