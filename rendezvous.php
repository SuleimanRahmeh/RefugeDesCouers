<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
    <title>Prendre un rendez-vous</title>
</head>
<body>
    <?php
        include("./connexion.php");
        include("./header.php");
    ?>
    <?php
    $name = "";
    $date = "";
    $heure = "";
    $motive = "";
    $lastname = "";
    $email = "";
    $idUser = "";

    if(isset($_SESSION["user"])){
        $name = $_SESSION["name"];
        $lastname = $_SESSION["lastname"];
        $email = $_SESSION["email"];
        $idUser = $_SESSION["user_id"];
    }
    
    if (isset($_POST["submit"])) { 
        if (empty($_POST["name"]) || empty($_POST["date"]) || empty($_POST["heure"]) || empty($_POST["motive"])) { 
            echo "<h2>Tous les champs sont obligatoires !!!</h2>";
        } else {
            try {
                $stmt = $connexion->prepare("INSERT INTO `rdv` (`name`,`lastname`,`email`, `date`, `heure`, `motive`, `id_user`) VALUES (:name, :lastname, :email, :date, :heure, :motive, :id_user);");
                $stmt->execute(array(
                    ":name" => $_POST["name"],
                    ":lastname" => $_POST["lastname"],
                    ":email" => $_POST["email"],
                    ":date" => $_POST["date"],
                    ":heure" => $_POST["heure"],
                    ":motive" => $_POST["motive"],
                    ":id_user" => $idUser
                ));
                echo "<h2>Votre rendez-vous a été bien enregistré, nous vous contacterons bientôt.</h2>";
            } catch (PDOException $e) {
                printf("Erreur lors de l'enregistrement du rendez-vous: %s\n", $e->getMessage());
                exit();
            } finally {
                echo "<p style='color:green'>Enregistrement réussi!</p>";
            }
        }
    }
    ?>

    <div id="rdvForm">
        <form method="POST" action="#" enctype="multipart/form-data">
            <h2>Formulaire de rendez-vous</h2>
            <h3>Veuillez remplir tous les champs suivants</h3>
            <input type="text" name="name" placeholder="Votre prénom complet" value="<?php echo $name;?>"/><br />
            <input type="text" name="lastname" placeholder="Votre nom complet" value="<?php echo $lastname;?>"/><br />
            <input type="email" name="email" placeholder="Votre email" value="<?php echo $email;?>"/><br />
            <input type="date" name="date" placeholder="Date"/><br />
            <input type="time" name="heure" placeholder="Heure"/><br />
            <textarea name="motive" placeholder="Motif de RDV"></textarea><br />
            <input type="submit" name="submit" value="Valider"><br />
        </form> 
    </div>
    <?php
        include("./footer.php");
    ?>
</body>
</html>
