<?php
    require_once('../src/bddcall.php');
    $bdd = bddcall(); 
    if(isset($_GET['search']) && isset($_GET['compagnie'])){
        if($_GET['compagnie'] == ''){
            echo getLineSearched($bdd,$_GET['search']);
        }else if(compagnieIsValid($bdd,$_GET['compagnie'])){
            echo getLineAndCompagnieSearched($bdd,$_GET['search'],$_GET['compagnie']);
        }
    }else if(isset($_GET['isCompagnieValid'])){
        echo compagnieIsValid($bdd,$_GET['isCompagnieValid']);
    }else{
        $allLine = getAllLine($bdd);
        $allCompagnie = getAllCompagnies($bdd);
        if(isset($_GET['sucess'])){
            $sucessMessage = "La ligne a été modifié ! "; 
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Exercice 8</title>
</head>

<body>
<?php
    include('../template/_navbar.php');
?>
    <h1>Exercice 8 : Affichage des données de la BDD</h1>
    <p>A partir de la connexion réalisée à l'exercice 6 et des apprentissages des exercices précédents, affichez
        l'ensemble des lignes de transports disponibles dans votre base de données dans un tableau HTML. A chaque ligne
        de transport, il devra y avoir deux actions possibles dans le tableau, éditer et supprimer (Bien que non
        fonctionnelles).</p>
    <small>Il est peut-être temps de définir un mode de récupération par défaut des données par PDO afin d'éviter
        d'avoir un tableau doublé.</small>
    <p><b>Bonus : ajoutez un champ de recherche pour filtrer les résultats par leur nom (A l'aide de l'instruction LIKE
            %recherche% dans une requête SQL)</b></p>
    <?php
        if(isset($sucessMessage)) echo '<p class="sucess">' . $sucessMessage . '</p>';
    ?>
            <input type="text" id="searchBar" placeholder="Recherche par nom..">
            <select name="compagnie" id="searchByCompagnie">
                <option value="">ou recherche par compagnie</option>
                <?php
                 for ($i=0; $i < count($allCompagnie); $i++) { 
                     echo '<option value=' . $allCompagnie[$i]['id'] .'>' . $allCompagnie[$i]['name'] . '</option>';
                 }
                ?>
            </select>
    <table>
        <thead>
            <tr>
                <th>Nom de la ligne</th>
                <th>Terminus A</th>
                <th>Terminus B</th>
                <th>Compagnies</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i=0; $i < count($allLine); $i++) { 
                echo '<tr>
                        <td>' . $allLine[$i]['ligne_name'] . '</td>
                        <td>' . $allLine[$i]['terminus_a'] . '</td>
                        <td>' . $allLine[$i]['terminus_b'] . '</td>
                        <td>' . $allLine[$i]['comp_name'] . '</td>
                        <td>
                            <a href="edit.php?id=' .  $allLine[$i]['id']  .'">Edit</a>
                            <a href="delete.php?id=' .  $allLine[$i]['id']  .'">Delete</a>
                     </tr>';
            }
            ?>
        </tbody>
    </table>
</body>
<script src="../js/ajaxSearch.js"></script>
</html>

<?php } ?>

