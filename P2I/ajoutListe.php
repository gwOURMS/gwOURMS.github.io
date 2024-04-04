
<?php
include("include/connect.php"); 
$bdd = getDb();

// Récupérer l'ID du film depuis le formulaire précédent
$id_film = $_POST['id_film'];

// Récupérer les noms des listes depuis la base de données
$query_listes = "SELECT Id, Nom FROM listes";
$statement_listes = $bdd->prepare($query_listes);
$statement_listes->execute();
$listes = $statement_listes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter à une liste</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>

    <h1>Ajouter à une liste</h1>
    
    <form action="traitementAjout.php" method="POST">
        <label for="liste">Sélectionner une liste :</label>
        <select id="liste" name="id_liste">
            <?php foreach ($listes as $liste) { ?>
                <option value="<?= $liste['Id'] ?>"><?= $liste['Nom'] ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="id_film" value="<?= $id_film ?>">
        <input type="submit" value="Ajouter à la liste">
    </form>

</body>
</html>


