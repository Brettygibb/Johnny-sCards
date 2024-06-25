<?php
include("../../includes/connect.php");

// Enable detailed error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST values and ensure they are properly validated
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;
    $stock = isset($_POST['stock']) ? (int) $_POST['stock'] : 0;
    $category_id = isset($_POST['category_id']) ? (int) $_POST['category_id'] : 0;
    $set_id = isset($_POST['set_id']) ? (int) $_POST['set_id'] : 0;
    $rarity = isset($_POST['rarity']) ? trim($_POST['rarity']) : '';

    // Debugging: Print the retrieved values
    echo "<pre>";
    echo "Name: $name\n";
    echo "Description: $description\n";
    echo "Price: $price\n";
    echo "Stock: $stock\n";
    echo "Category ID: $category_id\n";
    echo "Set ID: $set_id\n";
    echo "Rarity: $rarity\n";
    echo "</pre>";

    // Check if the image was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= 5000000) {
            $image = $_FILES['image']['tmp_name'];
            $image_content = file_get_contents($image);
        } else {
            die("Invalid image file type or size. Allowed types: jpeg, png, gif. Max size: 5MB.");
        }
    } else {
        // Handle the error case
        die("Error uploading image file.");
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert the card details
        $stmtCard = $conn->prepare("INSERT INTO cards (name, description, price, stock, category_id, set_id, rarity, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        if (!$stmtCard) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters with correct data types
        $stmtCard->bind_param("ssdiiiss", $name, $description, $price, $stock, $category_id, $set_id, $rarity, $image_content);

        // Send long data for image content
        $stmtCard->send_long_data(7, $image_content);

        // Debugging: Print the values to be inserted
        echo "<pre>";
        echo "Prepared Values:\n";
        echo "Name: $name\n";
        echo "Description: $description\n";
        echo "Price: $price\n";
        echo "Stock: $stock\n";
        echo "Category ID: $category_id\n";
        echo "Set ID: $set_id\n";
        echo "Rarity: $rarity\n";
        echo "Image Content Length: " . strlen($image_content) . "\n";
        echo "</pre>";

        // Execute the statement
        if (!$stmtCard->execute()) {
            throw new Exception("Execute failed: " . $stmtCard->error);
        }

        $stmtCard->close();

        // Commit the transaction
        $conn->commit();

        // Redirect to the card entry page with a success message
        header("Location: ../enterCards.php?success=Card inserted successfully");
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();

        // Log the error
        error_log($e->getMessage());

        // Display the error for debugging purposes
        die("Could not insert card. Error: " . $e->getMessage());

        // Redirect to the card entry page with an error message (commented out during debugging)
        // header("Location: ../enterCards.php?error=Could not insert card. Error: " . $e->getMessage());
    }

    // Close the connection
    $conn->close();
}
?>
