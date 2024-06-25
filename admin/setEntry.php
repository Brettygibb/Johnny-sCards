<?php
include("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $setName = $_POST['setName'];
    $setDesc = $_POST['setDesc'];
    $releaseDate = $_POST['releaseDate'];

    try {
        // Insert the set details
        $stmt = $conn->prepare("INSERT INTO sets (name, description, release_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $setName, $setDesc, $releaseDate);
        $stmt->execute();
        $stmt->close();

        // Redirect to a success page or display a success message
        header("Location: setEntry.php?success=Set inserted successfully");
    } catch (Exception $e) {
        // Handle errors (e.g., display an error message)
        header("Location: setEntry.php?error=Could not insert set. Error: " . $e->getMessage());
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbarstyles.css">
    <title>Admin</title>
    <?php
    include 'includes/adminNavbar.php';
    ?>
</head>
<body>
    <h1>Enter Set Details</h1>
    <?php
    if (isset($_GET['success'])) {
        echo "<p style='color: green;'>{$_GET['success']}</p>";
    }
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>{$_GET['error']}</p>";
    }
    ?>
    <form action="setEntry.php" method="post">
        <label for="setName">Set Name:</label>
        <input type="text" id="setName" name="setName" required><br><br>
        <label for="setDesc">Set Description:</label>
        <textarea id="setDesc" name="setDesc" required></textarea><br><br>
        <label for="releaseDate">Release Date:</label>
        <input type="date" id="releaseDate" name="releaseDate" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
