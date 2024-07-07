<?php 
if(isset($_GET['error'])){
    if($_GET['error'] == "email"){
        echo "<script>alert('Email already exists')</script>";
    }
    if($_GET['error'] == "CouldNotBeCreated"){
        echo "<script>alert('Account could not be created')</script>";
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
    
    <div class="register">
    <h1>Register</h1>
    <p>Already have an account? <a href="login.php">Login</a></p>
    <form action="includes/register_proc.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
    </div>
</body>
</html>