<?php

    if(!empty($_POST)){
        if(isset($_POST['first_name']) && strlen($_POST['first_name']) > 2){
            if(isset($_POST['last_name']) && strlen($_POST['last_name']) > 2){
                if(isset($_POST['genre']) && $_POST['genre'] !== ''){
                    if(isset($_POST['adress']) && strlen($_POST['adress']) > 5){
                        if(isset($_POST['city']) && strlen($_POST['city']) > 3){
                            if(isset($_POST['zipCode']) && strlen($_POST['zipCode'] >= 5)){
                                $formValid = true;
                            }else{
                                $error = "Votre Code Postal doit être renseigné et doit être composé de 5 chiffres";
                            }
                        }else{
                            $error = "Votre ville doit être renseigné et faire plus de 3 caractères";
                        }
                    }else{
                        $error = "Votre adresse doit être renseigné et faire plus de 5 caractères";
                    }
                }else{
                    $error = "Votre genre doit être séléctionné";
                }
            }else{
                $error= 'Votre prénom doit être fourni et faire plus de 4 caractères';
            }
        }else{
            $error = 'Votre nom doit être fourni et faire plus de 4 caractères';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
<?php
    include('../template/_navbar.php');
?>
    <h1>Exercice 1 : Identité</h1>
    <p>A l'aide d'un formulaire HTML et de PHP, affichez les données qu'un utilisateur aura rempli dans un formulaire
        via une requête POST SUR LA MEME PAGE</p>
    <small>Ne pas oublier de préparer le cas où les données sont non renseignées et/ou n'ont pas encore pu être
        remplies</small>
    <ul>
        <li>Nom</li>
        <li>Prénom</li>
        <li>Genre</li>
        <li>Adresse</li>
        <li>Ville</li>
        <li>Code Postal</li>
    </ul>
    <?php
        if(isset($formValid) && $formValid == true){
            echo "<div class='infoForm'>
                    <p>Votre nom est : " . htmlspecialchars($_POST['first_name']) . "</p>
                    <p>Votre prénom est : " . htmlspecialchars($_POST['last_name']) . "</p>
                    <p>Votre genre est : " . htmlspecialchars($_POST['genre']) . "</p>
                    <p>Votre adresse est : " . htmlspecialchars($_POST['adress']) . "</p>
                    <p>Votre ville est : " . htmlspecialchars($_POST['city']) . "</p>
                    <p>Votre code postal est : " . htmlspecialchars($_POST['zipCode']) . "</p>
                </div>";
        }
    ?>
    <form action="index.php" method="POST" id='post_form'>
        <?php
            if(isset($error)){
                echo '<p class="errorMessage">'  . $error . '</p>';
            } 
        ?>
        <input type="text" name='first_name' placeholder="Votre Nom" required>
        <input type="text" name='last_name' placeholder="Votre prénom" required>
        <select name="genre" id="" required>
            <option value="">Votre Genre</option>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="undefined">Non renseigné</option>
        </select>
        <input type="text" name="adress" placeholder="Votre Adresse" required>
        <input type="text" name="city" placeholder="Votre Ville" required>
        <input type="number" name="zipCode" placeholder="Votre Code-Postal" required>
        <button type="submit">Valider</button>
    </form>
</body>

</html>