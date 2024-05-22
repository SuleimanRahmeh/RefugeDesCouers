<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Animaux</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
        include("connexion.php");
        include("headerAdmin.php");
        
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $deleteStmt = $connexion->prepare("DELETE FROM  questionnaire  WHERE id = :id");
                $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
                $deleteStmt->execute();
                echo "<p>Supprimé avec succès.</p>";
            }
    
        $stmt = $connexion->prepare("SELECT * FROM questionnaire");
        $stmt->execute();
        $rows = $stmt->fetchall();
        echo "<div id='listFormulaire'>"; 
        foreach ($rows as $element) {
            echo "<div id='formulaire'>" .
                "<h3>id de l'animale: " . $element["idanimal"] . "</h3>" ."<a href='DeleteAnimal_admin.php'>voir l'animal</a>".
                "<h3>prenom: " . $element["firstname"] . "</h3>" . 
                "<h3>nom: " . $element["lastname"] . "</h3>" . 
                "<h3>email: " . $element["email"] . "</h3>" . 
                "<h3>telephone: " . $element["telephone"] . "</h3>" .
                "<h3>Type de logment : " . $element["typeLogment"] . "</h3>" . 
                "<h3>surface: " . $element["surface"] . " m2</h3>" . 
                "<h3>etage: " . $element["etage"] . "</h3>" . 
                "<h3>ouccupation: " . $element["ouccupation"] . "</h3>" .
                "<h3>age :" . $element["age"] . "</h3>" .
                "<h3>adresse :" . $element["adresse"] ."   ". $element["ville"] . "</h3>" .
                "<h3>enfants dans le logment: " . $element["enfant"] . "</h3>" .
                "<h3>fenaitre dans le logment: " . $element["fenaitre"] . "</h3>" .
                "<h3>experience avec les animaux: " . $element["experience"] . "</h3>" .
                "<a href='?delete=" . $element['id'] . "' onclick='return confirm(\"êtes-vous sûr ?\")'>Supprimer</a>".
                "</div>"; 
        }
        echo "</div>"; 
    ?>
    
</body>
</html>
