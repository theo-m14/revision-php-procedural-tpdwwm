<?php 

if(isset($_POST)){
    if(isset($_POST['brand']) && strlen($_POST['brand'])>3){
        if(isset($_POST['model']) && strlen($_POST['model'])>1){
            if(isset($_POST['color']) && strlen($_POST['color'])>2){
                if(isset($_POST['kil']) && $_POST['kil'] >= 0){
                    if(isset($_POST['year']) && $_POST['year'] >= 1900 && $_POST['year'] <= 2022){
                        if(isset($_POST['price']) && $_POST['price'] > 0){
                            header('Location: index.php?sucess');
                        }else{  
                            header('Location: index.php?error=price');
                        }
                    }else{
                        header('Location: index.php?error=year');
                    }
                }else{
                    header('Location: index.php?error=kil');
                }
            }else{
                header('Location: index.php?error=color');
            }
        }else{
            header('Location: index.php?error=model');
        }
    }else{
        header("Location: index.php?error=brand");
    }
}else{
    header("Location: index.php?error=noForm");
}