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

$searchId = '';
if (isset($_GET['search_id'])) {
    $searchId = $_GET['search_id'];
}
$categories_query = "SELECT DISTINCT name FROM type_produit";
$categories_result = $connexion->query($categories_query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Animaux</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1 style="text-align: center;">Les animaux affichés sur le site</h1>
    <div id="navbars" >
        <nav id="categorieForm" style="text-align: center;">
            <form method="GET" action="">
                <label for="search_id">Rechercher par ID :</label>
                <input type="text" id="search_id" name="search_id" value="<?php echo ($searchId); ?>">
                <input type="submit" value="Rechercher">
            </form>
        </nav>
    </div>
    <table border="1" style="margin: 0 auto;">
        <tr>
            <th>id</th>
            <th>Nom de l'animal</th>
            <th>Age</th>
            <th>Type</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        if (!empty($searchId)) {
            $sql = "SELECT * FROM animaux WHERE id = :id AND statue = 2";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $searchId, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM animaux WHERE statue = 2";
            $stmt = $connexion->prepare($sql);
        }
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . ($row['id']) . "</td>";
            echo "<td>" . ($row['nom']) . "</td>";
            echo "<td>" . ($row['age']) . "</td>";
            echo "<td>" . ($row['type']) . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' height='100' /></td>";
            echo "<td><a href='?delete=" . $row['id'] . "' onclick='return confirm(\"êtes-vous sûr ?\")'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
