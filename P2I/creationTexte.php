<?php 
include("include/connect.php"); 
$bdd = getDb();
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
<h1>Créer une liste de texte</h1>
    <form action="traitementTexte.php" method="POST">
        <label for="nomTexte">Nom de la liste :</label><br>
        <input type="text" id="nomTexte" name="nomTexte"><br>
        <input type="submit" value="Créer la liste">
    </form>
</body>
</html>
