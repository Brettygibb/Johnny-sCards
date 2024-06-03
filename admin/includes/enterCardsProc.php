<?php

include("../../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $set_id = $_POST['set_id'];
    $rarity = $_POST['rarity'];
    $setName = $_POST['setName'];
    $setDesc = $_POST['setDesc'];
    $year = $_POST['year'];

    // Check if the image was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $image_content = file_get_contents($image);
    } else {
        // Handle the error case
        die("Error uploading image file.");
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert the set details if not already present
        $stmtSet = $conn->prepare("INSERT INTO sets (id, name, description, release_date) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE name = VALUES(name), description = VALUES(description), release_date = VALUES(release_date)");
        $stmtSet->bind_param("isss", $set_id, $setName, $setDesc, $year);
        $stmtSet->execute();
        $stmtSet->close();

        // Insert the card details
        $stmtCard = $conn->prepare("INSERT INTO cards (name, description, price, stock, category_id, set_id, rarity, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmtCard->bind_param("ssdiibss", $name, $description, $price, $stock, $category_id, $set_id, $rarity, $image_content);
        $stmtCard->execute();
        $stmtCard->close();

        // Commit the transaction
        $conn->commit();

        // Redirect to a success page or display a success message
        header("Location: ../index.php?success=Card inserted successfully");
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();

        // Handle errors (e.g., display an error message)
        header("Location: ../insert_card.php?error=Could not insert card");
    }

    // Close the connection
    $conn->close();
}
?>
