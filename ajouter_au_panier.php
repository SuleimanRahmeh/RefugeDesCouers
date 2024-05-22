<?php
session_start();
include('./connexion.php');


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the product_id and quantity are set in POST request
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the user already has a cart
    $query = $connexion->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() == 0) {
        // Create a new cart for the user
        $query = $connexion->prepare("INSERT INTO cart (user_id) VALUES (:user_id)");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();
        $cart_id = $connexion->lastInsertId();
    } else {
        // Get the existing cart id
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $cart_id = $row['id'];
    }

    // Insert the product into the cart_produits table
    $query = $connexion->prepare("INSERT INTO cart_produits (cart, produit, quantity) VALUES (:cart, :produit, :quantity)
                                  ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
    $query->bindParam(':cart', $cart_id, PDO::PARAM_INT);
    $query->bindParam(':produit', $product_id, PDO::PARAM_INT);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $query->execute();

    // Redirect back to the products page
    header("Location: produits.php");
    exit();
} else {
    // Redirect to the products page if no product_id or quantity is set
    header("Location: produits.php");
    exit();
}
?>