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
            <h1>les prouduits</h1>
            <?php
            $stmt=$connexion->prepare("SELECT * FROM  produits where categories=1");
            $stmt->execute();
            $rows=$stmt->fetchAll();
            echo "<h2>le"
            ?>
        
        </div>
        <div id="services" >
            
            <div class="service">
            <div><h1>les animaux a donner<h1>
            <a href="displayAnimal_admin.php">gérer</a>
            </div>
            </div>
            
            <div class="service">
            <div><h1>les produits<h1>
            <a href="#">gérer</a>
            </div>
            </div> 
            
            <div class="service">
            <div><h1>formulaires d'adoption<h1>
            <a href="displayQS_Admin.php">gérer</a>
            </div>
            </div>
           
    </div> 
   
    
</body>
</html>
        
       
       