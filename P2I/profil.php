<?php
include("include/connect.php"); 
$bdd = getDb();

// Récupérer tous les films depuis la base de données
$query_films = "SELECT Titre, Image2, Réalisateur, Date FROM films";
$statement_films = $bdd->prepare($query_films);
$statement_films->execute();
$films = $statement_films->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les noms des listes depuis la base de données
$query_listes = "SELECT Id, Nom FROM listes";
$statement_listes = $bdd->prepare($query_listes);
$statement_listes->execute();
$listes = $statement_listes->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les films dans les listes depuis la base de données
$query_films_listes = "SELECT films.Titre, films.Image2, films.Réalisateur, films.Date FROM films
                       INNER JOIN listes_films ON films.code = listes_films.id_film";
$statement_films_listes = $bdd->prepare($query_films_listes);
$statement_films_listes->execute();
$films_listes = $statement_films_listes->fetchAll(PDO::FETCH_ASSOC);

$query_textes = "SELECT Id, Nom FROM texte";
$statement_textes = $bdd->prepare($query_textes);
$statement_textes->execute();
$textes = $statement_textes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OzuSquare</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style>
    #div1 {
        width: 95%; /* Full width */
        min-height: 300px; /* Adjust height as needed */
        padding: 10px; 
        border: 1px solid #aaaaaa;
        position: relative; /* Required for absolute positioning of draggable elements */
    }



    .citation {
    cursor: move;
    user-select: none;
    position: relative;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f9f9f9; /* Light grey background */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.citation-content {
    font-size: 16px;
    color: #333; /* Text color */
    line-height: 1.4; /* Adjust line height for better readability */
}
    </style>
</head>
<body>
    <?php include_once('include/header.php'); ?>

    <br>
    <br>
    <br>
    Profil de Pseudonyme (mode édition)
    <br>
    <br>
    <br>

    

    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <?php foreach ($listes as $liste) { ?>
    <fieldset>
        <legend><?= $liste['Nom'] ?></legend>
        <?php 
        // Récupérer les films associés à cette liste
        $query_films_liste = "SELECT films.Titre, films.Image2, films.Réalisateur, films.Date 
                              FROM films
                              INNER JOIN listes_films ON films.code = listes_films.id_film
                              WHERE listes_films.id_liste = ?";
        $statement_films_liste = $bdd->prepare($query_films_liste);
        $statement_films_liste->execute([$liste['Id']]);
        $films_liste = $statement_films_liste->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($films_liste as $key => $film_liste) { ?>
            <div style="display: inline-block; margin-right: 10px;">
                <h4><?= $film_liste['Titre'] ?></h4>
                <img id="dragFilm<?= $liste['Id'] ?><?= $key ?>" src="<?= $film_liste['Image2'] ?>" alt="Film Image" style="max-width: 200px; height: auto;" draggable="true" ondragstart="drag(event)">
                <p><strong>Director:</strong> <?= $film_liste['Réalisateur'] ?></p>
                <p><strong>Date:</strong> <?= $film_liste['Date'] ?></p>
                <button class="delete-button" onclick="deleteImage(event, <?= $liste['Id'] ?>, <?= $key ?>)">Delete Image</button>
            </div>
        <?php } ?>
    </fieldset>
<?php } ?>

<?php foreach ($textes as $texte) { ?>
    <h3><?= $texte['Nom'] ?></h3>
    <ul>
        <?php 
        // Récupérer les citations associées à ce texte
        $query_citations = "SELECT Id, Contenu FROM citation
                            INNER JOIN texte_citation ON citation.Id = texte_citation.id_citation
                            WHERE texte_citation.id_texte = ?";
        $statement_citations = $bdd->prepare($query_citations);
        $statement_citations->execute([$texte['Id']]);
        $citations = $statement_citations->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($citations as $key => $citation) { ?>
            <li>
                <div class="citation draggable" draggable="true" ondragstart="drag(event)" id="dragCitation<?= $texte['Id'] ?><?= $key ?>" data-citation="<?= $citation['Contenu'] ?>">
                    <?= $citation['Contenu'] ?>
                </div>
                <button class="delete-button" onclick="deleteCitation(event, <?= $texte['Id'] ?>, <?= $key ?>)">Delete Citation</button>
            </li>
        <?php } ?>
    </ul>
<?php } ?>



    </ul>


    <script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var draggedElement = document.getElementById(data);

    // Vérification qu'il n'y a rien
    if (ev.target.tagName !== "IMG" && ev.target.tagName !== "LI") {
        // Calcul de la nouvelle position
   var dropX = ev.clientX - ev.target.getBoundingClientRect().left - (draggedElement.offsetWidth / 2);
    var dropY = ev.clientY - ev.target.getBoundingClientRect().top - (draggedElement.offsetHeight / 2);
        
        // Changer la position
        draggedElement.style.position = "absolute";
        draggedElement.style.left = dropX + "px";
        draggedElement.style.top = dropY + "px";
        

        ev.target.appendChild(draggedElement);
    } else {

        console.log("Cannot drop image onto another image.");
    }
    

}
function deleteImage(event, listeId, key) {
    var imageId = 'dragFilm' + listeId + key; 
    var imageElement = document.getElementById(imageId);
    if (imageElement) {
        imageElement.parentNode.removeChild(imageElement);
    }
}





function deleteCitation(event, texteId, key) {
    var citationId = 'dragCitation' + texteId + key; // Adjust the ID format to match the citation IDs
    var citationElement = document.getElementById(citationId);
    if (citationElement) {
        citationElement.parentNode.removeChild(citationElement);
    }
}

    </script>

</body>
</html>
