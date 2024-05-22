<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>RefugeDesCœurs</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
</head>

<body>
<?php
    include("./connexion.php");
    include("./header.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $stmt = $connexion->prepare("SELECT * FROM animaux WHERE type=1 and id=? LIMIT 1"); 
    $stmt->execute(array($_GET['id'])); 
    $row = $stmt->fetch();
    if ($row) {
        echo "<div id='profile'>".
             "<img src='data:image/jpeg;base64,".base64_encode($row['image'])."'/>";
        echo "<div>".
              "<h1>nom : ".$row['nom']."</h1>". 
              "<h2>age: ".$row['age']."</h2>". 
              "<h2>race: ".$row['race']."</h2>".
              "<h2>ville: ".$row['city']."</h2>".
              "<h2>Prix d'adoption: ".$row['prix']."$</h2>". 
              "<h3>description: ".$row['discription']."</h3>"; 
        
        
        if (isset($_SESSION['user_id'])) {
            echo "<a href='questionnaire.php?id=".$row['id']."'>Remplir la formulaire</a>";
        } else {
            echo '<a href="login.php">se connecter pour en savoir plus</a>';
        }
        
        echo "</div></div>";  
    } else {
        echo "<p>Animal not found.</p>";
    }
?>
        <?php
        include("./footer.php");
        ?>
    
</body>