<?php
session_start(); // Ensure the session is started
include("connect.php");  // Ensure this file establishes a $conn connection
include("init.php");     // Ensure any session handling or initialization is done here

// Ensure a user ID is provided
if (!isset($_POST['id'])) {
    header("Location: ../login.php?error=NoLoginForCart");
    exit();
}

// Process POST data if quantities are submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
    $user_id = intval($_POST['id']); // Get the user ID from the POST data

    foreach ($_POST['quantities'] as $card_id => $quantity) {
        // Ensure $card_id is a valid integer
        $card_id = intval($card_id);

        // Check if the card exists in the session cart
        if (isset($_SESSION['cart'][$card_id])) {
            // Fetch current stock from database
            $stmt = $conn->prepare("SELECT stock FROM cards WHERE id = ?");
            $stmt->bind_param("i", $card_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $card = $result->fetch_assoc();
            $stmt->close();

            // Check if requested quantity exceeds available stock
            if ($quantity > $card['stock']) {
                // Redirect with error message if quantity exceeds stock
                header("Location: ../cart.php?error=NotEnoughStock&id=$card_id");
                exit();
            }

            // Update session cart with new quantity
            $_SESSION['cart'][$card_id]['quantity'] = intval($quantity);
        }
    }
}

// Redirect to cart page after updating quantities
header("Location: ../cart.php?success=QuantitiesUpdated");
exit();
?>
