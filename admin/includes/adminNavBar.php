<div class="navbar">
    <ul>
    <li class="logo"><img src="../images/JohnnyLogo.jpg" alt="header"></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="upcomingOrders.php">Upcoming Orders</a></li>
        <li><a href="enterCards.php">Enter Cards</a></li>
        <?php
            if(isset($_SESSION['username'])){
                echo '<li style="float:right"><a class="active" href="logout.php">Logout</a></li>';
            }
            else{
                echo '<li style="float:right"><a class="active" href="login.php">Login</a></li>';
            }
        ?>
    </ul>
</div>