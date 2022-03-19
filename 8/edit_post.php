<?php
require_once('../src/bddcall.php');
$bdd=bddcall();

if(isset($_POST)){
    if(isset($_POST['id']) && idIsValid($bdd,$_POST['id'])){
        if(isset($_POST['name']) && strlen($_POST['name']) > 2){
            if(isset($_POST['termA']) && strlen($_POST['termA']) >2){
                if(isset($_POST['termB']) && strlen($_POST['termB']) >2){
                        $infoLine = [
                            'name' => htmlspecialchars($_POST['name']),
                            'termA' => htmlspecialchars($_POST['termA']),
                            'termB' => htmlspecialchars($_POST['termB']),
                        ];
                        modifLine($bdd,$infoLine,$_POST['id']);
                        header('Location:index.php?sucess');
                }else{
                    header('Location:edit.php?id=' . $_POST['id'] . '&error=termB');
                }
            }else{
                header('Location:edit.php?id=' . $_POST['id'] . '&error=termA');
            }
        }else{
            header('Location:edit.php?id=' . $_POST['id'] . '&error=name');
        }
    }else{
        header('Location:index.php?error=uncaughtId');
    }
}else{
    header('Location:edit.php?id=' . $_POST['id'] . '&error=noForm');
}