<?php
include("include/connect.php"); 
$bdd = getDb();


// Récupérer les noms des listes depuis la base de données
$query_listes = "SELECT Id, Nom FROM texte";
$statement_listes = $bdd->prepare($query_listes);
$statement_listes->execute();
$listes = $statement_listes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OzuSquare</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<?php include_once('include/header.php'); ?> <br> 
<h1>Ecrire un texte</h1>
    <form action="traitementCitation.php" method="POST">
        
        <select id="texte" name="id_liste">
            <?php foreach ($listes as $liste) { ?>
                <option value="<?= $liste['Id'] ?>"><?= $liste['Nom'] ?></option>
            <?php } ?>
        </select>
        <label for="texte">Contenu du texte :</label><br>
        <input type="text" id="nomTexte" name="texte"><br>
        <input type="submit" value="Valider">
    </form>
</body>
</html>