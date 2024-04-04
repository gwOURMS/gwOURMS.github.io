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

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID de la liste sélectionnée depuis le formulaire
    $id_liste = $_POST['id_liste'];

    // Insérer les données dans la table de liaison listes_films
    $query_insert = "INSERT INTO listes_films (id_film, id_liste) VALUES (:id_film, :id_liste)";
    $statement_insert = $bdd->prepare($query_insert);
    $statement_insert->bindParam(":id_film", $id_film);
    $statement_insert->bindParam(":id_liste", $id_liste);
    $statement_insert->execute();

    // Rediriger vers une page de succès ou afficher un message de succès
    header("Location: ajoutListe_succes.php");
    exit(); // Arrêter l'exécution du script après la redirection
}
