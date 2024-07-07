<?php

include("init.php");

if(!isset($_SESSION['id'])){
    die("You must be logged in to remove items from your cart.");

}

$card_id = intval($_GET['id']);

if(isset($_SESSION['cart'][$card_id])){
    unset($_SESSION['cart'][$card_id]);
}

header("Location: ../cart.php");
exit();