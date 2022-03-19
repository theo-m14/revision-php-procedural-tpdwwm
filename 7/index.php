<?php
if(isset($_GET['error'])){
    $errorArray = [
        'name' => 'Le nom doit être renseigné et faire plus de 2 caratères',
        'termA' => 'Le terminus A doit être renseigné et faire plus de 2 caratères',
        'termB' => 'Le terminus B doit être renseigné et faire plus de 2 caratères',
        'noForm' => 'Le formulaire doit être rempli',
    ];
    if(in_array($errorArray[$_GET['error']],$errorArray)){
        $errorMessage = $errorArray[$_GET['error']];
    }else{
        $errorMessage = "Erreur inconnue";
    }
}else if(isset($_GET['sucess'])){
    $sucessMessage = "La ligne a été est enregistrée ! "; 
}

include_once('../src/bddcall.php');
$bdd = bddcall();
$allCompagnie = getAllCompagnies($bdd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Exercice 7</title>

</head>

<body>
<?php
    include('../template/_navbar.php');
?>
    <h1>Exercice 7 : Ajout simple à la BDD</h1>
    <p>A partir de la connexion réalisée à l'exercice 6 et des apprentissages des exercices précédents, utilisez un
        formulaire pour ajouter des nouvelles lignes de transport dans la base de données. Vous pourrez vous inspirer du
        réseau de transports de votre choix.</p>
    <small>Utilisez un système de bloc try/catch afin de réaliser vos opérations SQL.Sécurisez le tout avec des requêtes
        préparées.</small>
    <p><b>Bonus : Ajoutez des messages d'erreur dans le système pour renforcer l'expérience utilisateur</b></p>
    <?php
        if(isset($sucessMessage)) echo '<p class="sucess">' . $sucessMessage . '</p>';
    ?>
    <form method="POST" action='index_post.php' id="post_form">
    <?php
            if(isset($errorMessage)){
                echo '<p class="errorMessage">'  . $errorMessage . '</p>';
            } 
        ?>
        <input type="text" name='name' required placeholder="Nom de la gare">
        <input type="text" name="termA" required placeholder="Terminus A">
        <input type="text" name="termB" required placeholder="Terminus B">
        <select name="compagnie" id="">
            <?php
                for ($i=0; $i < count($allCompagnie); $i++) { 
                    echo '<option value=' . $allCompagnie[$i]['id'] .'>' . $allCompagnie[$i]['name'] . '</option>';
                }
            ?>
        </select>
        <button type="submit">Enregistrer</button>
    </form>
</body>

</html>