<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
    <title>questionnaire</title>

</head>
<body>
    <?php
        include("./connexion.php");
        include("./header.php");
        
       
    ?>
<?php

if (isset($_POST["submit"])) { 
    if (empty($_POST["lastname"]) || empty($_POST["firstname"]) || empty($_POST["email"]) || empty($_POST["Typelogment"]) 
        || empty($_POST["surface"]) || empty($_POST["etage"]) || empty($_POST["ouccupation"]) || empty($_POST["age"]) 
        || empty($_POST["adresse"]) || empty($_POST["ville"]) || empty($_POST["telephone"]) || empty($_POST["enfant"]) 
        || empty($_POST["fenaitre"]) || empty($_POST["experience"])) { 
        echo "<h2> tous les champs sont obligatoires !!!</h2>";
    } else {
        try {
            $stmt = $connexion->prepare("INSERT INTO `questionnaire` (`firstname`, `lastname`, `email`, `Typelogment`, `surface`, `etage`, `ouccupation`,
            `age`, `adresse`, `ville`, `telephone`, `enfant`, `fenaitre`, `experience`,`idanimal`)
            VALUES (:firstname, :lastname, :email, :Typelogment, :surface, :etage, 
            :ouccupation, :age, :adresse, :ville, :telephone, :enfant, :fenaitre, :experience, :idanimal);");
            $stmt->execute(array(
                "firstname" => $_POST["firstname"],
                "lastname" => $_POST["lastname"],
                "email" => $_POST["email"],
                "Typelogment" => $_POST["Typelogment"],
                "surface" => $_POST["surface"],
                "etage" => $_POST["etage"],
                "ouccupation" => $_POST["ouccupation"],
                "age" => $_POST["age"],
                "adresse" => $_POST["adresse"],
                "ville" => $_POST["ville"],
                "telephone" => $_POST["telephone"],
                "enfant" => $_POST["enfant"],
                "fenaitre" => $_POST["fenaitre"], 
                "experience" => $_POST["experience"],
                "idanimal"=>$_GET["id"]
            ));
            echo "<h2>votre demande a ete bien enregistrer , on vous contacterons bientot</h2>";
        } catch (PDOException $e) {
            printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
            exit();
        } finally {
            echo "<p style='color:green'>Inscription réussite!</p>";
        }
    }
}
    $firstname="";
    $lastname="";
    $email="";
    

    if(isset($_SESSION["user"])){
       
        $firstname= $_SESSION["name"];
        $lastname= $_SESSION["lastname"];
        $email= $_SESSION["email"];
       
    }
?>

    <div id="questionnaire">
        <form method="POST" action="#" enctype="multipart/form-data">
            <h2>Fourmulaire d'adoption</h2>
            <h3>Veuillez remplir tout les champs suivants</h3>
            <input type="text" name="lastname" placeholder="Votre nom" value="<?php echo $lastname;?>"/><br />
            <input type="text" name="firstname" placeholder="Votre prénom" value="<?php echo $firstname;?>"/><br />
            <input type="email" name="email" placeholder="Email" value="<?php echo $email;?>"/><br />
            <legend>type de logment</legend> 
            <div class="radio-group">
                <input type="radio" id="Typelogment" name="Typelogment" value="maison">
                <label for="Typelogment">maison</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="Typelogment" name="Typelogment" value="appartement">
                <label for="Typelogment">appartement</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="Typelogment" name="Typelogment" value="studio">
                <label for="Typelogment">studio</label>
            </div>
            <input type="number" name="surface" placeholder="surface de logment en m2"/><br />
            <input type="text" name="etage" placeholder="quelle etage ?"/><br />
            <legend>ouccupation</legend> 
            <div class="radio-group">
                <input type="radio" id="ouccupation" name="ouccupation" value="etudiant">
                <label for="ouccupation">etudiant</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="ouccupation" name="ouccupation" value="employé">
                <label for="ouccupation">employé</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="ouccupation" name="ouccupation" value="retraite">
                <label for="ouccupation">retraite</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="ouccupation" name="ouccupation" value="chomage">
                <label for="ouccupation">chomage</label>
            </div>
            <input type="number" name="age" placeholder="votre age"/><br />
            <input type="text" name="adresse" placeholder="votre adresse postal"/><br />
            <input type="text" name="ville" placeholder="ville et code postal"/><br />
            <input type="number" name="telephone" placeholder="numero de telephone"/><br />
            <legend>avez vous des enfant ?</legend> 
            <div class="radio-group">
                <input type="radio" id="enfant" name="enfant" value="oui">
                <label for="enfant">oui</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="enfant" name="enfant" value="non">
                <label for="fenaitre">non</label>
            </div>
            <legend>y a t-il des fenaitre dans votre logments ?</legend> 
            <div class="radio-group">
                <input type="radio" id="fenaitre" name="fenaitre" value="oui">
                <label for="fenaitre">oui</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="fenaitre" name="fenaitre" value="non">
                <label for="fenaitre">non</label>
            </div>
            <legend>avez vous deja de l'experience avec les animaux ?</legend> 
            <div class="radio-group">
                <input type="radio" id="experience" name="experience" value="oui">
                <label for="experience">oui</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="experience" name="experience" value="non">
                <label for="experience">non</label>
            </div>
            <input type="submit" name="submit" value="Valider"><br />
        </form> 
    </div>
    <?php
        include("./footer.php");
        ?>
    
</body>
</html>