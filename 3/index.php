<?php
    session_start();

    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location:index.php');
    }
    if(isset($_GET['error'])){
        $errorArray = [
            'username' => 'Votre pseudo doit être renseigné et faire plus de 4 caratères',
            'pass' => 'Votre mot de passe doit être renseigné et faire plus de 6 caratères',
            'verfiPass' => 'Vos mots de passes ne correspondent pas',
            'email' => 'Votre email doit être renseigné et faire plus de 4',
        ];
        if(in_array($errorArray[$_GET['error']],$errorArray)){
            $errorMessage = $errorArray[$_GET['error']];
        }else{
            $errorMessage = "Erreur inconnue";
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
<?php
    include('../template/_navbar.php');
?>
<body>
    <h1>Exercice 3 : Inscription</h1>
    <p>A l'aide d'un formulaire HTML et de PHP, simulez un formulaire d'inscription (avec hashage du mot de passe)
        via une requête POST sur une page d'affichage et une page de processing. Si la connexion est effective alors on
        affiche un message de bienvenue à l'utilisateur contenant son username.</p>
    <small>Ne pas oublier de préparer le cas où les données sont non renseignées et/ou n'ont pas encore pu être
        remplies. Ne pas oublier d'initialiser la session. (Ici on part du principe qu'on est connectés dès que l'on
        s'inscrit.)</small>
    <small>Afficher le formulaire s'il n'y a pas d'utilisateur connecté.</small>
    <small>Ne pas afficher le formulaire s'il est connecté</small>
    <p><b>BONUS : vérifier que le username fait plus de 3 caractères et que le mot de passe en fait au moins 6</b></p>
    <p><b>BONUS : inclure un lien qui permet de se déconnecter</b></p>
    <ul>
        <li>username</li>
        <li>password</li>
        <li>confirmation password</li>
        <li>email</li>
    </ul>
    <?php if(empty($_SESSION)) {?>

        <form action="index_post.php" method="post" id="post_form">
            <input type="text" required name="username" placeholder="Votre pseudo">
            <input type="password" required name="password" placeholder="Mot de passe">
            <input type="password" required name="confirm_password" placeholder="Confirmer le mot de passe">
            <input type="text" required name="email" placeholder="Votre email">
            <button type="submit">Inscription</button>
        </form>

    <?php }else{ ?>
        <p style="text-align: center;">Bienvenue <?php echo $_SESSION['username']; ?></p>
        <a href="index.php?logout">Déconnexion</a>
    <?php }?>
</body>

</html>