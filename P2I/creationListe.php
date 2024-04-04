<?php 
include("include/connect.php"); 
$bdd = getDb();

$query = "SELECT Titre, Image1, Image2 FROM films WHERE code = 1"; 
$statement = $bdd->prepare($query);
$statement->execute();
$film = $statement->fetch(PDO::FETCH_ASSOC);
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
<h1>Créer une liste</h1>
    <form action="traitementListe.php" method="POST">
        <label for="nomListe">Nom de la liste :</label><br>
        <input type="text" id="nomListe" name="nomListe"><br>
        <label for="description">Description :</label><br>
        <textarea id="description" name="description"></textarea><br><br>
        <input type="submit" value="Créer la liste">
    </form>
</body>
</html>