<?php
session_start();
include 'includes/connect.php';

try {
    // Fetch all cards from the database
    $query = "SELECT * FROM cards";
    $result = $conn->query($query);

    // Check if any cards exist
    if ($result->num_rows > 0) {
        $cards = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $cards = [];
    }

    $result->close();
} catch (Exception $e) {
    // Log the error
    error_log($e->getMessage());
    die("Error fetching cards: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbarstyles.css">
    <link rel="stylesheet" href="css/cardstyles.css">
    <title>Johnny's Cards</title>
    
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<h1>All Cards</h1>

<div class="card-container">
    <?php if (count($cards) > 0): ?>
        <?php foreach ($cards as $card): ?>
            <div class="card">
                <!-- Link to the cardDetail.php page with the card ID -->
                <a href="cardDetails.php?id=<?php echo $card['id']; ?>">
                    <?php if (!empty($card['image'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($card['image']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>">
                    <?php else: ?>
                        <img src="path/to/placeholder.jpg" alt="No image available">
                    <?php endif; ?>
                    <h2><?php echo htmlspecialchars($card['name']); ?></h2>
                    <p>$<?php echo htmlspecialchars($card['price']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No cards available.</p>
    <?php endif; ?>
</div>

</body>
<footer>
    <p>Johnny's Cards</p>
    <p>123-456-7890</p>
    <p>Intellectual property of Brett Gibbons</p>
</footer>
</html>
