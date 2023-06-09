<!-- florian -->

<?php
include_once 'ingredienten.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Index Huts</title>
</head>

<body>

    <!-- navbar -->
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="readIngredienten.php">Read</a></li>
    </ul>

    <div class="box">
        <h3>Creates een nieuwe Ingredient</h3>

        <form method="POST">
            <label for="Name">Ingredient Naam </label><input placeholder="Name Here" type="text" name="Name"><br>
            <label for="Description">Ingredient Description </label><input placeholder="Description Here" type="text" name="Description"><br>
            <label for="Type">Ingredient Type </label><input placeholder="Type Here" type="text" name="Type"><br>
            <label for="Alcohol">zit er Alcohol in </label><input placeholder="ja of nee" type="text" name="Alcohol"><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <?php
        $object = new Ingredienten();
        if (isset($_POST['submit'])) {
            $ingredID = NULL;
            $ingName = $_POST['Name'];
            $ingDescription = $_POST['Description'];
            $ingType = $_POST['Type'];
            $ingAlcohol = $_POST['Alcohol'];

            $object->create($ingredID, $ingName, $ingDescription, $ingType, $ingAlcohol);
        }
        ?>
    </div><br><br>

    <div class="box">
        <h3>Ingredienten bij naam opzoeken en krijg ID terug</h3>
        <form method="POST">
            <label for="searchName">Type hier wat je wilt opzoeken </label><input placeholder="naam hier" type="text" name="searchName"><br>
            <button type="submit" name="submit2">Submit</button>
        </form>

        <?php
        $object = new Ingredienten();
        if (isset($_POST['submit2'])) {
            $ingName = $_POST['searchName'];

            $object->searchID($ingName);
        }
        ?>
    </div><br><br>

    <div class="box">
        <h3>Kijken of een ingredient al bestaat</h3>
        <form method="POST">
            <label for="ingrednaam">Type hier wat je wilt opzoeken </label><input placeholder="naam hier" type="text" name="ingrednaam"><br>
            <button type="submit" name="submit4">Submit</button>
        </form>

        <?php
        $object = new Ingredienten();
        if (isset($_POST['submit4'])) {
            $ingName = $_POST['ingrednaam'];

            $object->nameFound($ingName);
        }
        ?>
    </div><br><br>

    <div class="box">
        <h3>Ingredienten deleten met ID</h3>
        <form method="POST">
            <label for="DeleteID">type hiere de ID </label><input placeholder="ID hier" type="text" name="DeleteID"><br>
            <button type="submit" name="submitDelete">Submit</button>
        </form>

        <?php
        $object = new Ingredienten();
        if (isset($_POST['submitDelete'])) {
            $ingredID = $_POST['DeleteID'];

            $object->delete($ingredID);
        }
        ?>
    </div><br><br>

    <div class="box">
        <h3>Update Ingredient op ID</h3>
        <form method="POST">
            <label for="updatenName">type hier de naam </label><input placeholder="Naam" type="text" name="updatenName"><br>
            <label for="updatenDescription">type hier de beschrijving </label><input placeholder="Beschrijving" type="text" name="updatenDescription"><br>
            <label for="updateType">type hier het type ingredient </label><input placeholder="Type" type="text" name="updateType"><br>
            <label for="updateAlcohol">type hier het type ingredient </label><input placeholder="Alcohol" type="text" name="updateAlcohol"><br>
            <label for="updateID">type hiere de ID </label><input placeholder="ID" type="text" name="updateID"><br>
            <button type="submit" name="submitUpdate">Submit</button>
        </form>

        <?php
        $object = new Ingredienten();
        if (isset($_POST['submitUpdate'])) {
            $ingredName = $_POST['updatenName'];
            $ingredDescription = $_POST['updatenDescription'];
            $ingredType = $_POST['updateType'];
            $ingredAlcohol = $_POST['updateAlcohol'];
            $ingredID = $_POST['updateID'];

            $object->update($ingredName, $ingredDescription, $ingredType, $ingredAlcohol, $ingredID);
        }
        ?>
    </div><br><br>

    <div class="box">
        <h3>Searchbar, opzoeken op ID.</h3>
        <form action="SearchID.php" method="POST">
            <input name="searchID" type="text" placeholder="Search...">
            <button type="submit" name="searchSubmit">Submit</button>
        </form>
    </div><br><br>
</body>

</html>