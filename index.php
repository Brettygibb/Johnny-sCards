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
    <title>Johnny's Cards</title>
    <?php
    include 'includes/navbar.php';
    ?>
</head>
<body>
    <?php
    $sql = "select * from cards order by rand() limit 5";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<a href='cardDetails.php?id=" . $row['id'] . "'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='" . $row['name'] . "'>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>$" . $row['price'] . "</p>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No cards available.</p>";
    }
    ?>

</body>
<footer>
    <p>Johnny's Cards</p>
    <p>123-456-7890</p>
    <p>intellectual property of Brett Gibbons</p>
</footer>
</html>