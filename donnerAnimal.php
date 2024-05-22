<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Donner son animal</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
session_start(); 
include("./connexion.php");
include("./header.php");


        $statue=1;
        if(isset($_POST["submit"])){    
            if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["petname"]) || empty($_POST["petage"]) || empty($_POST["adoption_price"]) || empty($_POST["petRace"]) || empty($_POST["discription"]) || empty($_POST["city"]) || empty($_FILES["image"]["name"]) || empty($_POST["animal_type"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            } else {
                $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
                try {
                    $stmt = $connexion->prepare("INSERT INTO `animaux` (`firstname`, `lastname`, `email`, `nom`, `race`, `image`, `type`, `city`, `age`, `prix`, `discription`,`statue`) VALUES (:firstname, :lastname, :email, :nom, :race, :image, :type, :city, :age, :prix, :discription, :statue);");
                    $stmt->bindParam(':firstname', $_POST["firstname"]);
                    $stmt->bindParam(':lastname', $_POST["lastname"]);
                    $stmt->bindParam(':email', $_POST["email"]);
                    $stmt->bindParam(':nom', $_POST["petname"]);
                    $stmt->bindParam(':race', $_POST["petRace"]);
                    $stmt->bindParam(':prix', $_POST["adoption_price"]);
                    $stmt->bindParam(':age', $_POST["petage"], PDO::PARAM_INT);
                    $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
                    $stmt->bindParam(':type', $_POST["animal_type"]);
                    $stmt->bindParam(':city', $_POST["city"]);
                    $stmt->bindParam(':discription', $_POST["discription"]);
                    $stmt->bindParam(':statue', $statue);
                    $stmt->execute();
                    echo "<p style='color:green'>Inscription réussie! Nous vous contacterons bientôt.</p>";
                }catch(PDOException $e) {
                    echo "<p style='color:red'>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
                }
            }
        }

?>

    

    <div id="postAnimal">
        <form method="POST" action="#" enctype="multipart/form-data">
            <h3>Veuillez remplir les champs suivants</h3>
            <input type="text" name="lastname" placeholder="Votre nom"/><br />
            <input type="text" name="firstname" placeholder="Votre prénom"/><br />
            <input type="email" name="email" placeholder="Email"/><br />
            <input type="text" name="petname" placeholder="Nom de l'animal"/><br />
            <input type="text" name="petRace" placeholder="race de l'animal"/><br />
            <input type="text" name="discription" placeholder="discription"/><br />
            <input type="number" name="petage" placeholder="L'âge en mois"/><br />
            <legend>Chien ou chat ?</legend> 
            <div class="radio-group">
                <input type="radio" id="catType" name="animal_type" value="1">
                <label for="catType">Chat</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="dogType" name="animal_type" value="2">
                <label for="dogType">Chien</label>
            </div>
            <input type="text" name="city" placeholder="Ville"/><br />
            <input type="number" name="adoption_price" placeholder="Prix d'adoption"/><br />
            <label for="imageUpload">Télécharger une photo de l'animal:</label>
            <input type="file" id="imageUpload" name="image" accept="image/*"><br><br>
            <input type="submit" name="submit" value="Valider"><br />
        </form> 
    </div>
    <?php
        include("./footer.php");
        ?>
</body>
</html>
