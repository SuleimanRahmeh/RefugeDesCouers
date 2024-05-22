<div class="sections-container">
        <div class="sectionCat">
            <button class="button" onclick="toggleContent('cat')">Votre Chat</button>
            <div id="cat" class="content">
                <img src="./images/catCare.jpg" alt="Conseils pour prendre soin de votre chat" class="section-image">
                <h2>Conseils pour prendre soin de votre chat</h2>
                <ul>
                    <li>Assurez-vous de fournir une alimentation équilibrée et de l'eau fraîche en permanence. Les chats ont des besoins nutritionnels spécifiques qui doivent être respectés pour leur santé globale.</li>
                    <li>Donnez à votre chat un espace propre pour faire ses besoins, nettoyez la litière régulièrement. Un environnement propre aide à prévenir les maladies et les infections.</li>
                    <li>Offrez à votre chat des jouets et des grattoirs pour stimuler son activité et éviter l'ennui. Les chats sont des animaux curieux qui ont besoin de stimulation mentale et physique.</li>
                    <li>Programmez des visites régulières chez le vétérinaire pour les vaccinations et les contrôles de santé. Les soins vétérinaires réguliers sont essentiels pour détecter et prévenir les problèmes de santé tôt.</li>
                    <li>Montrez à votre chat de l'affection et de l'attention pour renforcer votre lien. Les chats apprécient l'interaction et l'affection de leurs propriétaires.</li>
                </ul>
            </div>
        </div>

        <div class="sectionDog">
            <button class="button" onclick="toggleContent('dog')">Votre Chien</button>
            <div id="dog" class="content">
                <img src="./images/dogCare.jpg" alt="Conseils pour prendre soin de votre chien" class="section-image">
                <h2>Conseils pour prendre soin de votre chien</h2>
                <ul>
                    <li>Donnez à votre chien une alimentation de qualité adaptée à son âge, sa taille et son niveau d'activité. Une bonne nutrition est la clé d'une longue vie en bonne santé.</li>
                    <li>Assurez-vous qu'il ait toujours de l'eau fraîche à disposition. L'hydratation est essentielle pour la santé de votre chien.</li>
                    <li>Faites-lui faire de l'exercice régulièrement pour maintenir sa forme physique et mentale. Les chiens ont besoin de dépenser leur énergie pour être heureux et équilibrés.</li>
                    <li>Offrez-lui des jouets pour le divertir et éviter l'ennui. Les jouets aident à stimuler mentalement votre chien et à prévenir les comportements destructeurs.</li>
                    <li>Emmenez-le chez le vétérinaire régulièrement pour des bilans de santé et les vaccinations nécessaires. Des visites régulières chez le vétérinaire garantissent que votre chien reste en bonne santé.</li>
                    <li>Consacrez du temps pour jouer et interagir avec votre chien pour renforcer votre relation. Passer du temps de qualité avec votre chien renforce votre lien et améliore son bien-être général.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function toggleContent(id) {
    var content = document.getElementById(id);
    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}
</script>