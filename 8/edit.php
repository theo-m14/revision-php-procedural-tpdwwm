<?php
    require_once('../src/bddcall.php');
    $bdd = bddcall();
if(isset($_GET['error'])){
    $errorArray = [
        'name' => 'Le nom doit être renseigné et faire plus de 2 caratères',
        'termA' => 'Le terminus A doit être renseigné et faire plus de 2 caratères',
        'termB' => 'Le terminus B doit être renseigné et faire plus de 2 caratères',
        'noForm' => 'Le formulaire doit être rempli',
        'uncaughtId' => "L'id fourni ne correspond pas à une ligne valide",
    ];
    if(in_array($errorArray[$_GET['error']],$errorArray)){
        $errorMessage = $errorArray[$_GET['error']];
    }else{
        $errorMessage = "Erreur inconnue";
    }
}else if(isset($_GET['sucess'])){
    $sucessMessage = "La ligne a été est enregistrée ! "; 
}
if(!isset($_GET['id']) || !idIsValid($bdd,$_GET['id'])){
    header('Location: index.php?error=uncaughtId');
}else{
    $currentLine = getLineById($bdd,$_GET['id']);
}
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
    <h1>Edition de la ligne : <?= $currentLine['name'] ?></h1>
    <?php
        if(isset($sucessMessage)) echo '<p class="sucess">' . $sucessMessage . '</p>';
    ?>
    <form method="POST" action='edit_post.php' id="post_form">
    <?php
            if(isset($errorMessage)){
                echo '<p class="errorMessage">'  . $errorMessage . '</p>';
            } 
        ?>
        <input type="text" name='name' required value="<?= $currentLine['name'] ?>">
        <input type="text" name="termA" required value="<?= $currentLine['terminus_a'] ?>">
        <input type="text" name="termB" required value="<?= $currentLine['terminus_b'] ?>">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <button type="submit">Modifier</button>
    </form>
</body>

</html>