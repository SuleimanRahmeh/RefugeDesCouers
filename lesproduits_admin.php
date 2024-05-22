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
        <h1>Gérer les ptoduits</h1>
        <?php
        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM produits");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;'>Nombre total des produits: " . $row['total'] . "</h2>";

        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM produits WHERE categories=1");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;' >Nombre total des jeux : " . $row['total'] . "</h2>";

        
        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM produits WHERE categories=2");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;'>Nombre total des produits de soin: " . $row['total'] . "</h2>";

        $stmt = $connexion->prepare("SELECT COUNT(*) as total FROM produits WHERE categories=3");
        $stmt->execute();
        $row = $stmt->fetch();
        echo "<h2 style='text-align: center;'>Nombre total des produits alimentaires : " . $row['total'] . "</h2>";
        ?>
    </div> 
        <div id="services" >
            
            <div class="service">
            <div>
            <a href="AddProduit_admin.php">ajouter un produits</a>
            </div>
            </div>
            
            <div class="service">
            <div>
            <a href="DeleteProduit_admin.php">supprimer/modifer un produits</a>
            </div>
            </div> 
            
            
           
        </div> 
   
    
</body>
</html>
        