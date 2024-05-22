<?php
include("./header.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
</head>
<body>

<div class="main-container">
    <div class="sectionPropos">
        <h1>À propos</h1>
        <div class="text-with-image right">
            <div class="text">
                <p>Nous sommes un refuge spacieux et ouvert, accueillant tous les cœurs chaleureux. Ici, nous prenons soin de votre futur ami jusqu'au jour où vous viendrez le chercher pour l'emmener chez vous, où se trouve sa véritable famille. Vous pouvez visiter notre site web et y découvrir les animaux que vous pouvez ajouter à votre famille.</p>
                <p>Nous acceptons tous les cœurs sans abri. Si vous trouvez un animal sans abri, n'hésitez pas à nous contacter via le site pour que nous puissions l'accueillir dans notre refuge. Notre mission est de fournir un abri sûr et aimant pour tous les animaux dans le besoin, et nous travaillons sans relâche pour garantir qu'ils trouvent des foyers permanents et aimants.</p>
            </div>
            <img src="./images/dogCare.jpg" alt="Refuge Des Cœurs" class="about-image">
        </div>
        <div class="text-with-image left">
            <img src="./images/catCare.jpg" alt="Équipe du Refuge" class="about-image">
            <div class="text">
                <p>Au-delà de fournir un abri, nous nous efforçons de sensibiliser le public à l'importance de la stérilisation, de l'adoption responsable et de la prise en charge adéquate des animaux domestiques. Nous offrons également des ressources éducatives pour aider les nouveaux propriétaires à comprendre les besoins spécifiques de leurs animaux de compagnie, garantissant ainsi une transition en douceur vers leur nouveau foyer.</p>
                <p>Notre équipe dévouée travaille jour et nuit pour assurer le bien-être de nos animaux. Chaque membre de notre personnel est passionné par les soins aux animaux et a reçu une formation approfondie pour s'assurer que tous nos résidents à fourrure reçoivent les meilleurs soins possibles. Nous croyons fermement que chaque animal mérite une chance de trouver un foyer aimant et nous mettons tout en œuvre pour faire de ce rêve une réalité pour autant d'animaux que possible.</p>
            </div>
        </div>
    </div>
</div>

<?php
include("./footer.php");
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const paragraphs = document.querySelectorAll('.text p');
    paragraphs.forEach(p => {
        const firstWord = p.textContent.split(' ')[0];
        const restOfText = p.textContent.substring(firstWord.length);
        p.innerHTML = `<span class="first-word">${firstWord}</span>${restOfText}`;
    });
});
</script>
</body>
</html>
