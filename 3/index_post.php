<?php

if(isset($_POST)){
    if(isset($_POST['username']) && strlen($_POST['username'])>3){
        if(isset($_POST['password']) && strlen($_POST['password'])>=6){
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            if(password_verify($_POST['password'],$password)){
                if(isset($_POST['email']) && $_POST['email'] >= 4){
                    session_start();
                    $_SESSION['username'] = htmlspecialchars($_POST['username']);
                    header('Location: index.php?sucess');
                }else{
                    header('Location: index.php?error=email');
                }
            }else{
                header('Location: index.php?error=verifPass');
            }
        }else{
            header('Location: index.php?error=pass');
        }
    }else{
        header("Location: index.php?error=username");
    }
}else{
    header("Location: index.php?error=noForm");
}