<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbarstyles.css">
    <title>Admin</title>
    <?php include 'includes/adminNavbar.php'; ?>
</head>
<body>
    <h1>Enter Card Details</h1>
    <?php
    if (isset($_GET['success'])) {
        echo "<p style='color: green;'>{$_GET['success']}</p>";
    }
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>{$_GET['error']}</p>";
    }
    ?>
    <form action="includes/enterCardsProc.php" method="post" enctype="multipart/form-data">
        <label for="name">Card Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="description">Card Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br><br>
        <label for="category_id">Category ID:</label>
        <select id="category_id" name="category_id" required>
            <?php
            include("../includes/connect.php");
            // Fetch categories from the database to populate the dropdown
            $result = $conn->query("SELECT id,name FROM categories");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                $result->close();
            } else {
                echo "<option value=''>No categories available</option>";
            }
            ?>
        </select><br><br>
        <label for="set_id">Set ID:</label>
        <select id="set_id" name="set_id" required>
            <?php
            // Fetch sets from the database to populate the dropdown
            $result = $conn->query("SELECT id,name FROM sets");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                $result->close();
            } else {
                echo "<option value=''>No sets available</option>";
            }
            $conn->close();
            ?>
        </select><br><br>
        <label for="rarity">Rarity:</label>
        <input type="text" id="rarity" name="rarity" required><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
