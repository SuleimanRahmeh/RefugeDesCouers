<?php
include("./connexion.php"); 
include("./headerAdmin.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteStmt = $connexion->prepare("DELETE FROM produits WHERE id = :id");
    $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $deleteStmt->execute();
    echo "<p>Supprimé avec succès.</p>";
}

$searchId = '';
if (isset($_GET['search_id'])) {
    $searchId = $_GET['search_id'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des de produits</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1 style="text-align: center;">Les produits affichés sur le site</h1>
    <div id="navbars" >
        <nav id="categorieForm" style="text-align: center;">
            <form method="GET" action="">
                <label for="search_id">Rechercher par ID :</label>
                <input type="text" id="search_id" name="search_id" value="<?php echo ($searchId); ?>">
                <input type="submit" value="Rechercher">
            </form>
        </nav>
        <form id="categorieForm" method="GET" action="">
        <label for="categories">selectioner une categorie</label>
        <select name="categories" id="categories">
            <option value="">tout les categories</option>
            <?php
            $categories_query = "SELECT DISTINCT name FROM type_produit";
            $categories_result = $connexion->query($categories_query);
            while ($categories_row = $categories_result->fetch()) {
                $selected = isset($_GET['categories']) && $_GET['categories'] == $categories_row['name'] ? 'selected' : '';
                echo "<option value='" . ($categories_row['name']) . "' $selected>" . ($categories_row['name']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="filtrer">
        </form>
    </div>
    <table border="1" style="margin: 0 auto;">
        <tr>
            <th>id</th>
            <th>Nom de produits</th>
            <th>prix</th>
            <th>quantites</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        if (!empty($searchId)) {
            $sql = "SELECT * FROM produits WHERE id = :id ";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $searchId, PDO::PARAM_INT);
        }else {
            $categories = isset($_GET['categories']) ? $_GET['categories'] : '';
            $query = "SELECT p.* FROM produits p JOIN type_produit pt ON p.categories = pt.id";
            if (!empty($categories)) {
                $query .= " WHERE pt.name = :categories";
            }
            
            $stmt = $connexion->prepare($query);
            
            if (!empty($categories)) {
                $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
            }
        }
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . ($row['id']) . "</td>";
            echo "<td>" . ($row['name']) . "</td>";
            echo "<td>" . ($row['prix']) . "</td>";
            echo "<td>" . ($row['quantites']) . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' height='100' /></td>";
            echo "<td><a href='?delete=" . $row['id'] . "' onclick='return confirm(\"êtes-vous sûr ?\")'>Supprimer</a><a href='modiferProduit_admin.php?id=".$row["id"]."'>  Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
