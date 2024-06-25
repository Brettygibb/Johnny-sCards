<?php
session_start();
include 'includes/connect.php';

if(!isset($_GET['id'])) {
    header('Location: pokemon.php');
    exit;
}
$cardId = $_GET['id'];

try{
    // Fetch the card from the database
    $query = "SELECT * FROM cards WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $cardId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the card exists
    if($result->num_rows > 0) {
        $card = $result->fetch_assoc();
    } else {
        $card = null;
    }

    $stmt->close();
} catch (Exception $e) {
    // Log the error
    error_log($e->getMessage());
    die("Error fetching card: " . $e->getMessage());
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

    <title>Card Detail</title>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="card-detail">
        <?php if(!empty($card['image'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($card['image']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>">
        <?php else: ?>
            <img src="path/to/placeholder.jpg" alt="No image available">
        <?php endif; ?>
        <h1><?php echo htmlspecialchars($card['name']); ?></h1>
        <p><?php echo htmlspecialchars($card['description']); ?></p>
        <p>$<?php echo htmlspecialchars($card['price']); ?></p>
        <p>Stock: <?php echo htmlspecialchars($card['stock']); ?></p>
        <p>Rarity: <?php echo htmlspecialchars($card['rarity']); ?></p>
    </div>
    
</body>
<footer>
    <p>Johnny's Cards</p>
    <p>123-456-7890</p>
    <p>Intellectual property of Brett Gibbons</p>
</footer>
</html>