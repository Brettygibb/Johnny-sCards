<?php
session_start();
include 'includes/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbarstyles.css">

    <title>Account</title>
</head>
<body>
    <?php 
    include 'includes/navbar.php';
    ?>
    <h1>Account Details</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <h2>Order History</h2>
    <?php 
    $sql = "select * from orders where id = " . $_SESSION['id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Order History</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>Order ID: " . $row['id'] . "</p>";
            echo "<p>Order Date: " . $row['order_date'] . "</p>";
            echo "<p>Order Total: $" . $row['total'] . "</p>";
        }
    } else {
        echo "<p>No orders found.</p>";
    }
    ?>
</body>
</html>