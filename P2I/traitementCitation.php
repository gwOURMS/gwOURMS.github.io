<?php
// Include the database connection file
include("include/connect.php");
$bdd = getDb();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set and not empty
    if (isset($_POST["id_liste"], $_POST["texte"]) && !empty($_POST["id_liste"]) && !empty($_POST["texte"])) {
        // Retrieve the data from the form
        $id_liste = $_POST["id_liste"];
        $texte = $_POST["texte"];

        try {
            // Prepare the SQL query to insert the data into citation table
            $query = "INSERT INTO citation (Contenu) VALUES (:texte)";
            $statement = $bdd->prepare($query);

            // Bind the parameters for the citation insertion
            $statement->bindParam(":texte", $texte);

            // Execute the query to insert into citation table
            if ($statement->execute()) {
                // Retrieve the last inserted ID
                $citation_id = $bdd->lastInsertId();

                // Prepare the SQL query to insert into texte_citation table
                $query_insert = "INSERT INTO texte_citation (id_texte, id_citation) VALUES (:id_liste, :citation_id)";
                $statement_insert = $bdd->prepare($query_insert);
                $statement_insert->bindParam(":id_liste", $id_liste);
                $statement_insert->bindParam(":citation_id", $citation_id);

                // Execute the query to insert into texte_citation table
                if ($statement_insert->execute()) {
                    // Redirect to a success page or display a success message
                    header("Location: citation_ecrite_succes.php");
                    exit(); // Stop script execution after redirection
                } else {
                    // If an error occurs during query execution
                    echo "Une erreur s'est produite lors de l'enregistrement de la citation.";
                }
            } else {
                // If an error occurs during query execution
                echo "Une erreur s'est produite lors de l'enregistrement de la citation.";
            }
        } catch (PDOException $e) {
            // If an exception occurs during query execution
            echo "Erreur PDO : " . $e->getMessage();
        }
    } else {
        // If the required fields are not set or empty
        echo "Veuillez remplir tous les champs requis.";
    }
} else {
    // If the page is accessed directly without form submission
    echo "Accès non autorisé.";
}
?>
