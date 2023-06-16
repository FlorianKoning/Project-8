<!-- florian -->
<?php
include_once 'dbh.php';

class Ingredienten extends Dbh
{

    public string $ingredName;
    public string $ingredDescription;
    public string $ingredType;
    public string $ingredAlcohol;
    public int $ingredID;

    public function __construct($ingredName = "", $ingredDescription = "", $ingredType = "", $ingredAlcohol = "", $ingredID = 0)
    {
        $this->ingredName = $ingredName;
        $this->ingredDescription = $ingredDescription;
        $this->ingredType = $ingredType;
        $this->ingredAlcohol = $ingredAlcohol;
        $this->ingredID = $ingredID;
    }

    function create($ingredID, $ingredName, $ingredDescription, $ingredType, $ingredAlcohol)
    {
        // zorgt er voor dat er alleen ja of nee kan ingevult worden
        if ($ingredAlcohol != "ja" || $ingredAlcohol != "nee") {
            echo "<script>alert('Je kan alleen Ja of Nee invullen bij of er alcohol inzit!')</script>";
            return;
        }

        // checkt of de ingredient al in de database zit
        $sql = "SELECT ingredName FROM ingrediënts WHERE ? = ingredName";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName]);

        if ($stmt->fetch()) {
            // zit het ingredient al in de database stop de function
            echo "<script>al    ert('Ingredient bestaat al')</script>";
            return;
        } else {
            // zit de ingredient er nog niet in dan word het ingredient aangemaakt
            $sql = "INSERT INTO ingrediënts( ingredName, ingredDescription, ingredType, ingredAlcohol) 
            VALUES ( ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            // checkt of het gelukt is ingredient te maken
            $stmt->execute([$ingredName, $ingredDescription, $ingredType, $ingredAlcohol]);
            if ($stmt) {
                echo "<script>console.log('ingredient toegevoegt.')</script>";
                echo "<script>alert('Nieuw Ingredient aangemaakt')</script>";
            } else {
                echo "<script>console.log('Er is iets fout gegaan, kon niet de ingrediënts toevoegen.')</script>";
            }
        }
    }

    function update($ingredName, $ingredDescription, $ingredType, $ingredAlcohol, $ingredID)
    {
         // zorgt er voor dat er alleen ja of nee kan ingevult worden
         if ($ingredAlcohol != "ja" || $ingredAlcohol != "nee") {
            echo "<script>alert('Je kan alleen Ja of Nee invullen bij of er alcohol inzit!')</script>";
            return;
        }

        // SQL code om het ingredient te updaten.
        $sql = "UPDATE ingrediënts SET ingredName = ?,ingredDescription = ?, ingredType = ?, ingredAlcohol = ? 
        WHERE ingredID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName, $ingredDescription, $ingredType, $ingredAlcohol, $ingredID]);
        if ($stmt) {
            echo "<script>alert('ingrediënts zijn geupdate')</script>";
        } else {
            echo "<script>console.log('Er is iets fout gegaan, kon niet de ingrediënts toevoegen.')</script>";
        }
    }

    function readAll()
    {
        $sql = "SELECT * FROM `ingrediënts`";
        $stmt = $this->connect()->query($sql);

        while ($row = $stmt->fetch()) {
            echo "<div class='readbox' style='color: white; max-width: 300px;'>";
            echo "Naam: " .  $row['ingredName'] . ', <br>';
            echo "Beschrijving: " . $row['ingredDescription'] . ', <br>';
            echo "Ingredient type: " .  $row['ingredType'] . ', <br>';
            echo "Alcohol: " .  $row['ingredAlcohol'] . ', <br>';
            echo "Ingredient ID: " .  $row['ingredID'] . ', <br>';
            echo "</div><br>";
        }
    }

    function searchID($ingredName)
    {
        $sql = "SELECT ingredID FROM ingrediënts WHERE ? = ingredName";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName]);

        if ($row = $stmt->fetch()) {
            echo $row['ingredID'];
        }
    }

    function delete($ingredID)
    {
        $sql = "DELETE FROM ingrediënts WHERE ingredID = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$ingredID]);
        if ($stmt->execute()) {
            echo "<script>console.log('Gelukt ingredient te verwijderen.')</script>";
        } else {
            echo "<script>console.log('Er is iets fout gegaan, kon niet de ingredient deleten.')</script>";
        }
    }

    function nameFound($ingredName)
    {
        $sql = "SELECT ingredName FROM ingrediënts WHERE ? = ingredName";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName]);

        if ($row = $stmt->fetch()) {
            echo "Name was found: " . $row['ingredName'];
        } else {
            echo "No name was found as: " . $ingredName;
        }
    }

    function searchIngredientID($ingredID)
    {
        $sql = "SELECT * FROM ingrediënts WHERE ? = ingredID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredID]);

        while ($row = $stmt->fetch()) {
            echo "<div class='readbox' style='color: white; max-width: 300px; display: flex;'>";
            echo "Naam: " .  $row['ingredName'] . ', <br>';
            echo "Beschrijving: " . $row['ingredDescription'] . ', <br>';
            echo "Ingredient type: " .  $row['ingredType'] . ', <br>';
            echo "Alcohol: " .  $row['ingredAlcohol'] . ', <br>';
            echo "Ingredient ID: " .  $row['ingredID'] . ', <br>';
            echo "</div><br>";
        }
    }

    function searchIngredientName($ingredName)
    {
        $sql = "SELECT * FROM ingrediënts WHERE ? = ingredName";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName]);

        while ($row = $stmt->fetch()) {
            echo "<div class='readbox' style='color: white; max-width: 300px; display: flex;'>";
            echo "Naam: " .  $row['ingredName'] . ', <br>';
            echo "Beschrijving: " . $row['ingredDescription'] . ', <br>';
            echo "Ingredient type: " .  $row['ingredType'] . ', <br>';
            echo "Alcohol: " .  $row['ingredAlcohol'] . ', <br>';
            echo "Ingredient ID: " .  $row['ingredID'] . ', <br>';
            echo "</div><br>";
        }
    }

    function searchIngredientDiscription($ingredDescription)
    {
        $sql = "SELECT * FROM ingrediënts WHERE ? = ingredDescription";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredDescription]);

        while ($row = $stmt->fetch()) {
            echo "<div class='readbox' style='color: white; max-width: 300px; display: flex;'>";
            echo "Naam: " .  $row['ingredName'] . ', <br>';
            echo "Beschrijving: " . $row['ingredDescription'] . ', <br>';
            echo "Ingredient type: " .  $row['ingredType'] . ', <br>';
            echo "Alcohol: " .  $row['ingredAlcohol'] . ', <br>';
            echo "Ingredient ID: " .  $row['ingredID'] . ', <br>';
            echo "</div><br>";
        }
    }

    public function getValuesWithID($ingredID) {
        $sql = "SELECT * FROM ingrediënts WHERE ? = ingredID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredID]);

        while ($row = $stmt->fetch()) {
            $this->ingredID = $row['ingredID'];
            $this->ingredName = $row['ingredName'];
            $this->ingredDescription = $row['ingredDescription'];
            $this->ingredType = $row['ingredType'];
            $this->ingredAlcohol = $row ['ingredAlcohol'];
        }
    }
}
