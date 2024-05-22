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
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["user"]) || $_SESSION['type'] == 1) {
        include("header.php");
    } else {
        include("headerAdmin.php");
    }
    ?>

    <div id="content">
        <h1>Bienvenue entre nous</h1>
        <p>Bienvenue sur RefugeDesCœurs, l'oasis où les cœurs solitaires se rencontrent et se lient.<br/>
        </p>
    </div>

    <div id="services">
        <div class="service">
            <img src="./images/adoptercats.jpg" alt="nos animaux">
            <div class="service-info">
                <h2>Les chats à l'adoption</h2>
                <p>Découvrez nos adorables chats prêts à trouver une nouvelle maison. Chaque chat est vacciné et prêt pour une nouvelle aventure avec vous.</p>
                <a href="cats.php" class="button">En savoir plus</a>
            </div>
        </div>
        <div class="service reverse">
            <img src="./images/adopterdogs.jpg" alt="nos animaux">
            <div class="service-info">
                <h2>Les chiens à l'adoption</h2>
                <p>Explorez nos chiens affectueux en attente d'un foyer aimant. Tous nos chiens sont bien pris en charge et prêts à devenir votre meilleur ami.</p>
                <a href="dogs.php" class="button">En savoir plus</a>
            </div>
        </div>
        <div class="service">
            <img src="./images/service.jpeg" alt="nos services">
            <div class="service-info">
                <h2>Donner son animal</h2>
                <p>Vous ne pouvez plus garder votre animal de compagnie ? Nous vous offrons un service sécurisé et compatissant pour trouver un nouveau foyer à votre animal.</p>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="donnerAnimal.php" class="button">En savoir plus</a>';
                } else {
                    echo '<a href="login.php" class="button">En savoir plus</a>';
                }
                ?>
            </div>
        </div>
        <div class="service reverse">
            <img src="./images/accessoires.jpg" alt="nos accessoires">
            <div class="service-info">
                <h2>Bien-etre</h2>
                <p>Découvrez notre gamme d'accessoires pour animaux, des jouets aux articles de soins, tout ce dont votre animal a besoin pour être heureux et en bonne santé.</p>
                <a href="boutique.php" class="button">En savoir plus</a>
            </div>
        </div>
    </div>

    <?php
    include("./footer.php");
    ?>
</body>
</html>
