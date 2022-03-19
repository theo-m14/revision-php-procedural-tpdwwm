<?php
    if(isset($_GET['error'])){
        $errorArray = [
            'brand' => 'La marque doit être renseigné et faire plus de 3 caratères',
            'model' => 'Le modèle doit être renseigné et faire plus de 1 caratères',
            'color' => 'La couleur doit être renseigné et faire plus de 2 caratères',
            'kil' => 'Le kilométrage doit être renseigné et faire plus de 0',
            'year' => 'La date doit être renseigné et être comprise en 1990 et 2022',
            'price' => 'Le prix doit être renseigné et être supérieur à 0',
        ];
        if(in_array($errorArray[$_GET['error']],$errorArray)){
            $errorMessage = $errorArray[$_GET['error']];
        }else{
            $errorMessage = "Erreur inconnue";
        }
    }else if(isset($_GET['sucess'])){
        $sucessMessage = "Votre voiture est enregistrée ! "; 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Exercice 2</title>

</head>

<body>
<?php
    include('../template/_navbar.php');
?>
    <h1>Exercice 2 : Voiture</h1>
    <h2>Formulaire</h2>

    <p>A l'aide d'un formulaire HTML et de PHP, affichez les données qu'un concessionnaire aura rempli dans un
        formulaire
        via une requête POST SUR UNE AUTRE PAGE : Ce formulaire contiendra un champ pour : la marque, le modèle, la
        couleur, le kilometrage, l'année et le prix. </p>
    <small>Vous appliquerez les vérifications nécessaires pour éviter les messages d'erreur</small>
    <?php
        if(isset($sucessMessage)) echo '<p class="sucess">' . $sucessMessage . '</p>';
    ?>
    <form action="index_post.php" method="POST" id='post_form'>
        <?php
            if(isset($errorMessage)){
                echo '<p class="errorMessage">'  . $errorMessage . '</p>';
            } 
        ?>
        <input type="text" name='brand' placeholder="Marque de la voiture" required>
        <input type="text" name='model' placeholder="Modèle de la voiture" required>
        <input type="text" name="color" placeholder="Couleur de la voiture" required>
        <input type="number" name="kil" placeholder="Kilométrage" required>
        <label for="year">Année de mise en circulation</label>
        <input type="number" name='year' min="1900" max="2022" step="1" value="2016" />
        <input type="number" name="price" placeholder="Prix" required>
        <button type="submit">Valider</button>
    </form>
</body>

</html>