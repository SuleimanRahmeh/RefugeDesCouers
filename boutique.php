<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Notre boutique</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <?php
        include("./connexion.php");
        include("./header.php");
    ?>

    
    <div id="content-botique">
       
        <div class="botique">
            <img src="./images/dog&cat.jpeg" alt="dog and cat">
            <div>
                <h2>Nos Produits</h2>
                <p>
                    Dans cette section, vous pouvez acheter une variété de produits et d'accessoires pour vos animaux de compagnie.
                    Que vous cherchiez de la nourriture, des jouets, des lits confortables ou des articles de soin, nous avons tout ce dont vous avez besoin
                    pour choyer vos amis à quatre pattes. Explorez notre sélection et trouvez les meilleurs produits pour la santé et le bonheur de vos animaux.
                    Profitez de nos offres spéciales et des nouveautés régulièrement mises à jour pour garantir le bien-être de vos compagnons.
                </p>
                <a href="produits.php">Voir nos produits</a>
            </div>
        </div>

       
        <div class="botique">
            <img src="./images/mobile-pet-grooming.jpg" alt="pet grooming">
            <div>
                <h2>Rendez-vous médical pour votre animal</h2>
                <p>
                    Dans cette section, vous pouvez prendre rendez-vous avec nos vétérinaires pour des examens de santé, des consultations et des vaccinations.
                    Nos professionnels sont là pour garantir le bien-être de vos animaux de compagnie et leur offrir les meilleurs soins possibles.
                    Que ce soit pour une visite de routine, des conseils nutritionnels ou des soins spécifiques, nous sommes là pour vous aider à maintenir
                    vos animaux en bonne santé et heureux. Prenez rendez-vous dès aujourd'hui et découvrez la différence de notre approche personnalisée et attentionnée.
                </p>
                <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="rendezvous.php">Prendre un rendez-vous</a>';
                    } else {
                        echo '<a href="login.php" class="button">Prendre un rendez-vous</a>';
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
        include("./footer.php");
    ?>
</body>
</html>
