<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>RefugeDesCœurs</title>
        <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        include("./connexion.php");
        include("./headerAdmin.php")
        
        ?>
       <div id="content">
        <h1>Gérer les animaux</h1>
        <?php
        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM animaux");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;'>Nombre total d'animaux : " . $row['total'] . "</h2>";

        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM animaux WHERE type=1");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;' >Nombre total des chats : " . $row['total'] . "</h2>";

        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM animaux WHERE type=2");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;'>Nombre total des chiens : " . $row['total'] . "</h2>";
        ?>
    </div> 
        <div id="services" >
            
            <div class="service">
            <div>
            <a href="AddAnimal_admin.php">ajouter un animal</a>
            </div>
            </div>
            
            <div class="service">
            <div>
            <a href="DeleteAnimal_admin.php">supprimer un animal</a>
            </div>
            </div> 
            <div class="service">
            <div>
            <a href="displayQS_Admin.php">voir les fourmulairs d'adoption</a>
            </div>
            </div> 
            <div class="service">
            <div>
            <a href="displayAnimal_admin.php">voir les animaux a donner</a>
            </div>
            </div> 
           
        </div> 
   
    
</body>
</html>
        