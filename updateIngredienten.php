<!-- florian -->

<?php
include_once 'ingredienten.php';
$object = new Ingredienten();
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

<?php

$valueID = $_POST['ID'];

if (isset($_POST['submitUpdate'])) {
    $ingredName = $_POST['updatenName'];
    $ingredDescription = $_POST['updatenDescription'];
    $ingredType = $_POST['updateType'];
    $ingredAlcohol = $_POST['updateAlcohol'];

    $object->update($ingredName, $ingredDescription, $ingredType, $ingredAlcohol, $valueID);
}

$object->getValuesWithID($valueID);

?>



<div class="box">
        <h3>Update Ingredient op ID</h3>
        <form method="POST">
            <label for="updatenName">type hier de naam </label><input type="text" name="updatenName" value="<?php echo $object->ingredName ?>"><br>
            <label for="updatenDescription">type hier de beschrijving </label><input type="text" name="updatenDescription" value="<?php echo $object->ingredDescription ?>"><br>
            <label for="updateType">type hier het type ingredient </label><input laceholder="Type" type="text" name="updateType" value="<?php echo $object->ingredType ?>"><br>
            <label for="updateAlcohol">type hier het type alcohol </label><input  type="text" name="updateAlcohol" value="<?php echo $object->ingredAlcohol ?>"><br>
            <label for="updateID">type hier de ID <?php echo $valueID ?> </label><input type="text" value="<?php echo $valueID ?>" name="ID" hidden><br>
            <button type="submit" name="submitUpdate">Submit</button>
        </form>
    </div><br><br>

</body>