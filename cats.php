<!DOCTYPE html>
<html lang="fr">
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
?>
<div id="topcat">
    <h1>Nos Chats</h1>
</div>


<div id="filterForm">
    <form method="GET" action="">
        <label for="city">Filtrer par ville:</label>
        <select name="city" id="city">
            <option value="">Toutes les villes</option>
            <?php
            $cityQuery = "SELECT DISTINCT city FROM animaux WHERE type=1 AND statue=2";
            foreach ($connexion->query($cityQuery) as $row) {
                echo "<option value='" . htmlspecialchars($row['city']) . "'>" . htmlspecialchars($row['city']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filtrer">
    </form>
</div>

<?php
$cityFilter = isset($_GET['city']) && !empty($_GET['city']) ? $_GET['city'] : '';
$sql = "SELECT * FROM animaux WHERE type=1 AND statue=2";
if ($cityFilter) {
    $sql .= " AND city = :city";
}
$stmt = $connexion->prepare($sql);
if ($cityFilter) {
    $stmt->bindParam(':city', $cityFilter);
}
$stmt->execute();

if ($stmt->rowCount() == 0) {
    echo "Aucun résultat trouvé.";
} else {
    echo "<div id='listcats'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='cat'>" .
             "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "'/>" .
             "<div><h2>" . htmlspecialchars($row['nom']) . "</h2>" . 
             "<h2>Ville : " . htmlspecialchars($row['city']) . "</h2>" .
             "<a href='catsprofile.php?id=" . htmlspecialchars($row['id']) . "'>Voir les détails</a>" .
             "</div></div>";
    }
    echo "</div>";
}
?> 

<?php
include("./footer.php");
?>  
</body>
</html>
