<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbarstyles.css">
    <title>Enter Cards</title>
    <?php
    include 'includes/adminNavBar.php';
    ?>
</head>
<body>
    <h1>Enter Cards</h1>
    <div class="card">

    <form action="includes/enterCardsProc.php" method="post">
    <label for="name">Card Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br>

        <label for="category_id">Category ID:</label>
        <input type="number" id="category_id" name="category_id" required><br>

        <label for="set_id">Set ID:</label>
        <input type="number" id="set_id" name="set_id" required><br>

        <label for="rarity">Rarity:</label>
        <input type="text" id="rarity" name="rarity" required><br>

        <label for="setName">Set Name:</label>
        <input type="text" id="setName" name="setName" required><br>

        <label for="setDesc">Set Description:</label>
        <textarea id="setDesc" name="setDesc"></textarea><br>

        <label for="year">Year:</label>
        <input type="Date" id="year" name="year" required><br>

        <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit">Insert Card</button>
    </form>
    </div>
</body>
</html>