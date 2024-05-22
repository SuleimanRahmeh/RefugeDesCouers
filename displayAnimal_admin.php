<?php
include("./connexion.php"); 
include("./headerAdmin.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteStmt = $connexion->prepare("DELETE FROM animaux WHERE id = :id");
    $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $deleteStmt->execute();
    echo "<p>Supprimé avec succès.</p>";
}

if (isset($_GET['accepte'])) {
    $id = $_GET['accepte'];
    $statue = 2; 

    
    $requete = "UPDATE `animaux` SET `statue` = :statue WHERE id = :id";
    $stmtUpdate = $connexion->prepare($requete);
    $stmtUpdate->bindParam(':statue', $statue, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtUpdate->execute();


    echo "<p>Accepté avec succès.</p>";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Animaux</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Nom de l'animal</th>
            <th>Age</th>
            <th>Type</th>
            <th>Description</th>
            <th>Ville</th>
            <th>Race</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM animaux where statue=1";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['age']) . "</td>";
            echo "<td>" . htmlspecialchars($row['type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['discription']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['race']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' height='100' /></td>";
            echo "<td><a href='?delete=" . $row['id'] . "' onclick='return confirm(\"êtes-vous sûr ?\")'>Supprimer</a><a href='?accepte=" . $row['id'] . "'>Accepter</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
