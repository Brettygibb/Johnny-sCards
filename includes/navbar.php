<div class="navbar">
    <ul>
    <li class="logo"><img src="images/JohnnyLogo.jpg" alt="header"></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="hockey.php">Hockey</a></li>
        <li><a href="baseball.php">Baseball</a></li>
        <li><a href="yugioh.php">Yu-Gi-Oh</a></li>
        <li><a href="pokemon.php">Pokemon</a></li>
        <li><a href="magic.php">Magic</a></li>
        <li style="float:right"><a class="active" href="cart.php">Cart</a></li>
       
        <?php
            if(isset($_SESSION['username'])){
                
                echo '<li style="float:right"><a class="active" href="account.php">Account</a></li>';
                echo '<li style="float:right"><a class="active" href="logout.php">Logout</a></li>';
                
            }
            else{
                echo '<li style="float:right"><a class="active" href="login.php">Login</a></li>';
            }
        ?>
    </ul>
</div>