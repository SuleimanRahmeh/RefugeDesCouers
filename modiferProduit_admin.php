<?php
include("./connexion.php"); 
include("./headerAdmin.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $connexion->prepare("SELECT * FROM produits WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        echo "<p>Produit non trouvé.</p>";
        exit;
    }
} else {
    echo "<p>ID de produit manquant.</p>";
    exit;
}


if (isset($_POST['submit'])) {
    if (empty($_POST['nom']) || empty($_POST['prix']) || empty($_POST['description']) || empty($_POST['produit_type'])) {
        echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
    } else {
        
        if ($_FILES['image']['tmp_name']) {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $stmt = $connexion->prepare("UPDATE produits SET name = :name, prix = :prix, description = :description, quantites = :quantites, categories = :categories, image = :image WHERE id = :id");
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
        } else {
            $stmt = $connexion->prepare("UPDATE produits SET name = :name, prix = :prix, description = :description, quantites = :quantites, categories = :categories WHERE id = :id");
        }
        
        $stmt->bindParam(':name', $_POST['nom']);
        $stmt->bindParam(':prix', $_POST['prix']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':quantites', $_POST['quantites']);
        $stmt->bindParam(':categories', $_POST['produit_type']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "<p style='color:green'>Produit modifié avec succès!</p>";
        } else {
            echo "<p style='color:red'>Erreur lors de la modification du produit.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un produit</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div id="postProduit">
        <form method="POST" action="#" enctype="multipart/form-data">
            <h3>Modifier les informations du produit</h3>
            <label for="nom">Nom de produit:</label>
            <input type="text" id="nom" name="nom" placeholder="Nom de produit" value="<?php echo htmlspecialchars($produit['name']); ?>" /><br />

            <label for="prix">Prix de produit:</label>
            <input type="number" id="prix" name="prix" placeholder="Prix de produit" value="<?php echo htmlspecialchars($produit['prix']); ?>" /><br />

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="Description" value="<?php echo htmlspecialchars($produit['description']); ?>" /><br />

            <label for="quantites">Quantités:</label>
            <input type="number" id="quantites" name="quantites" placeholder="Quantités" value="<?php echo htmlspecialchars($produit['quantites']); ?>" /><br />

            <legend>Type de produit:</legend>
            <div class="radio-group">
                <input type="radio" id="jeux" name="produit_type" value="1" <?php if ($produit['categories'] == 1) echo 'checked'; ?>>
                <label for="jeux">Jeux</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="soin" name="produit_type" value="2" <?php if ($produit['categories'] == 2) echo 'checked'; ?>>
                <label for="soin">Produit de soin</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="alimentation" name="produit_type" value="3" <?php if ($produit['categories'] == 3) echo 'checked'; ?>>
                <label for="alimentation">Produit d'alimentation</label>
            </div>

            <label for="imageUpload">Télécharger une nouvelle photo de produit (facultatif):</label>
            <input type="file" id="imageUpload" name="image" accept="image/*"><br><br>

            <input type="submit" name="submit" value="Valider"><br />
        </form> 
    </div>
    <?php include("./footer.php"); ?>
</body>
</html>
