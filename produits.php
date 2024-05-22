<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soins pour animaux</title>
    <link rel="stylesheet" href="style_boutique.css"> 
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<?php
 include("./connexion.php");
 include("./header.php");

 $categories_query = "SELECT DISTINCT name FROM type_produit";
 $categories_result = $connexion->query($categories_query);
?>

<div id="navbars">
    <form id="categorieForm" method="GET" action="">
        <label for="categories">selectioner une categorie</label>
        <select name="categories" id="categories">
            <option value="">tout les categories</option>
            <?php
            while ($categories_row = $categories_result->fetch()) {
                $selected = isset($_GET['categories']) && $_GET['categories'] == $categories_row['name'] ? 'selected' : '';
                echo "<option value='" . ($categories_row['name']) . "' $selected>" . ($categories_row['name']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="filtrer">
    </form>
</div>
<?php

$categories = isset($_GET['categories']) ? $_GET['categories'] : '';
$query = "SELECT p.* FROM produits p JOIN type_produit pt ON p.categories = pt.id";
if (!empty($categories)) {
    $query .= " WHERE pt.name = :categories";
}

$stmt = $connexion->prepare($query);

if (!empty($categories)) {
    $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
}

$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<div id='list_jeux'>";
    foreach ($stmt as $row) {
        echo "<div class='jeux'>".
             "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>".
             "<h3>" . htmlspecialchars($row['name']) . "</h3>".
             "<p>prix : " . htmlspecialchars($row['prix']) . "</p>";
        if ($row["quantites"] > 0) {
            echo "<form method='POST' action='ajouter_au_panier.php'>".
                 "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>".
                 "<label for='quantity_" . $row['id'] . "'>Quantité: </label>".
                 "<input type='number' id='quantity_" . $row['id'] . "' name='quantity' value='1' min='1' max='" . htmlspecialchars($row['quantites']) . "'>".
                 "<input type='submit' value='Ajouter au panier'>".
                 "</form>";
        } else {
            echo "<p>Rupture de stock</p>";
        }
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Aucun produit trouvé</p>";
}
?>

</body>
</html>
