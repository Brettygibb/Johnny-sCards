<?php 

include("includes/connect.php");
include("includes/init.php");

if(!isset($_SESSION['id'])){
    header("Location: login.php?error=You must login to add items to your cart.");
    exit();
}

$card_id = intval($_GET['id']);

$stmt = $conn->prepare("select * from cards where id = ?");
$stmt->bind_param("i", $card_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

    $card = $result->fetch_assoc();

}
else{
    header("Location: index.php?error=Card not found.");
    exit();
}

$stmt->close();


if(!isset($_SESSION['cart'][$card_id])){
    $_SESSION['cart'][$card_id] = [
        'id' => $card['id'],
        'name' => $card['name'],
        'price' => $card['price'],
        'quantity' => 1
    ];
}
else{
    $_SESSION['cart'][$card_id]['quantity']++;
}

header("Location: index.php?success=Card added to cart.");
exit();
?>