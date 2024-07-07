<?php

include("includes/connect.php");
include("includes/init.php");

if(!isset($_SESSION['id'])){
    header("Location: login.php?error=NoLoginForCart");
    exit();
}

$total =0;
foreach($_SESSION['cart'] as $card){
    $total += $card['price'] * $card['quantity'];
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
    <title>Shopping Cart</title>
</head>
<body>
    <?php include("includes/navbar.php"); ?>

    <h1>Your Shopping Cart</h1>

    <?php if(count($_SESSION['cart']) > 0): ?>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)); ?></td>
                    <td>
                        <a href="includes/removeFromCartProc.php?id=<?php echo $item['id']; ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Total: $<?php echo htmlspecialchars(number_format($total, 2)); ?></h2>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

</body>
<footer>
    <p>Johnny's Cards</p>
    <p>123-456-7890</p>
    <p>Intellectual property of Brett Gibbons</p>
</footer>
</html>
