<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ajouter un produit</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
session_start(); 
include("./connexion.php");
include("./headeradmin.php");

if(isset($_POST["submit"])){    
    if(empty($_POST["nom"]) || empty($_POST["prix"]) || empty($_POST["description"]) || empty($_POST["quantites"]) || empty($_POST["produit_type"]) ){
        echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
    } else {
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        try {
            $stmt = $connexion->prepare("INSERT INTO `produits` (`name`, `prix`, `description`, `quantites`, `categories`, `image`) VALUES (:name, :prix, :description, :quantites, :categories, :image);");
            $stmt->bindParam(':name', $_POST["nom"]);
            $stmt->bindParam(':prix', $_POST["prix"]);
            $stmt->bindParam(':description', $_POST["description"]);
            $stmt->bindParam(':quantites', $_POST["quantites"]);
            $stmt->bindParam(':categories', $_POST["produit_type"]);
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
            $stmt->execute();
            echo "<p style='color:green'>Produit ajouté !!</p>";
        } catch(PDOException $e) {
            echo "<p style='color:red'>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
        }
    }
}
?>

<div id="postProduit">
    <form method="POST" action="#" enctype="multipart/form-data">
        <h3>Veuillez remplir les champs suivants</h3>
        <input type="text" name="nom" placeholder="Nom de produit"/><br />
        <input type="number" name="prix" placeholder="prix de produit"/><br />
        <input type="text" name="description" placeholder="description"/><br />
        <input type="number" name="quantites" placeholder="quantites"/><br />
        <legend>type de produit</legend> 
        <div class="radio-group">
            <input type="radio" id="jeux" name="produit_type" value="1">
            <label for="jeux">jeux</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="soin" name="produit_type" value="2">
            <label for="soin">produit de soin</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="alimentation" name="produit_type" value="3">
            <label for="alimentation">produit d'alimentation</label>
        </div>
        <label for="imageUpload">Télécharger une photo de produit:</label>
        <input type="file" id="imageUpload" name="image" accept="image/*"><br><br>
        <input type="submit" name="submit" value="Valider"><br />
    </form> 
</div>
<?php
include("./footer.php");
?>
</body>
</html>
