<?php
include("connect.php");  // Ensure this file establishes a $conn connection
include("init.php");


if (!isset($_POST['id'])) {
    header("Location: ../login.php?error=NoLoginForCart");
    exit();
}

