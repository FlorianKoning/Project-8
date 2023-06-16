<?php
include_once 'ingredienten.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search ID | Project 8</title>
</head>

<body>
    <!-- navbar -->
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="readIngredienten.php">Read</a></li>
    </ul>

    <div class="readContainer">
        <?php
        $object = new Ingredienten();
        if (isset($_POST['searchSubmit'])) {
            $ingredID = $_POST['searchID'];

            $object->searchIngredientID($ingredID);
        }
        ?>
    </div>

</body>

</html>