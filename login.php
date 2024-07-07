<?php
if(isset($_GET['error'])){
    if($_GET['error'] == "NoLoginForCart"){
        echo "<script>alert('You must login to add items to your cart.')</script>";
    }
    if($_GET['error']=='Invalid Username or Password'){
        echo "<script>alert('Invalid Username or Password')</script>";
    }
    if($_GET['error']=='No User Found'){
        echo "<script>alert('No User Found')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbarstyles.css">
</head>
<body>
    <?php
        include 'includes/navbar.php';
    ?>
<div class="login">
    <h1>Login</h1>
    <form action="includes/login_proc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
        <a href="register.php">Don't have an account? Register here</a>
</div>
</body>
</html>