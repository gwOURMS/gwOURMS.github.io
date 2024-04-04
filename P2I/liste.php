<?php 
include("include/connect.php"); 
$bdd = getDb();

// Récupérer tous les films de la base de données
$query_films = "SELECT Code, Titre, Image2, Réalisateur, Date FROM films";
$statement_films = $bdd->prepare($query_films);
$statement_films->execute();
$films = $statement_films->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OzuSquare</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .film {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .film h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        
        .film img {
            max-width: 100%;
            margin-bottom: 10px;
        }
        
        .film p {
            margin: 0;
            font-size: 16px;
            color: #666;
        }
        
        .film .details {
            margin-top: 10px;
        }
        
        .film .details p {
            margin-bottom: 5px;
        }
        
        .add-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include_once('include/header.php'); ?>
    <div class="container">
        <h1>Liste des Films</h1>
        <input type="button" class="add-button" value="Créer une liste de films" onclick="window.location.href='creationListe.php';">
        <input type="button" class="add-button" value="Créer une liste de textes" onclick="window.location.href='creationTexte.php';">
        <input type="button" class="add-button" value="Écrire un texte" onclick="window.location.href='creationCitation.php';">
        <br>
        <br>
        <?php foreach ($films as $film) { ?>
            <div class="film">
                <h2><?= $film['Titre'] ?></h2>
                <img src="<?= $film['Image2'] ?>" alt="Film Image">
                <div class="details">
                    <p><strong>Réalisateur:</strong> <?= $film['Réalisateur'] ?></p>
                    <p><strong>Date de sortie:</strong> <?= $film['Date'] ?></p>
                </div>
                <form action="ajoutListe.php" method="POST">
                    <input type="hidden" name="id_film" value="<?= $film['Code'] ?>">
                    <input type="submit" class="add-button" value="Ajouter ce film à une liste">
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>
