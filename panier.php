<?php
session_start();
include('./connexion.php');
include('./header.php');

if (!isset($_SESSION['user_id'])) {
    echo "<p>Veuillez vous connecter pour voir votre panier.</p>";
    include('./footer.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Récupérer le cart_id de l'utilisateur
    $query = $connexion->prepare("SELECT id FROM cart WHERE user_id = ?");
    $query->execute([$user_id]);
    $cart = $query->fetch(PDO::FETCH_ASSOC);

    if ($cart) {
        $cart_id = $cart['id'];

        // Supprimer le produit du panier
        $query = $connexion->prepare("DELETE FROM cart_produits WHERE cart = ? AND produit = ?");
        $query->execute([$cart_id, $product_id]);
    }

    header('Location: panier.php');
    exit();
}

echo "<h1>Votre Panier</h1>";

// Récupérer le cart_id de l'utilisateur
$query = $connexion->prepare("SELECT id FROM cart WHERE user_id = ?");
$query->execute([$user_id]);
$cart = $query->fetch(PDO::FETCH_ASSOC);

if ($cart) {
    $cart_id = $cart['id'];

    // Récupérer les produits du panier
    $query = $connexion->prepare("SELECT p.id, p.name, cp.quantity, p.prix 
                                  FROM cart_produits cp 
                                  JOIN produits p ON cp.produit = p.id 
                                  WHERE cp.cart = ?");
    $query->execute([$cart_id]);

    if ($query->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>Produit</th><th>Quantité</th><th>Prix</th><th>Action</th></tr>";
        while ($row = $query->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prix'] * $row['quantity']) . " €</td>";
            echo "<td><a href='panier.php?action=delete&id=" . $row['id'] . "' class='btn-delete'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<h2>Le paiement pour tous les produits se fera uniquement par chèque, merci pour votre compréhension.</h2>";
    } else {
        echo "<p>Votre panier est vide.</p>";
    }
} else {
    echo "<p>Votre panier est vide.</p>";
}

include('./footer.php');
?>
