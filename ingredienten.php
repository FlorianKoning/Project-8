<!-- florian -->
<?php
include_once 'dbh.php';

class Ingredienten extends Dbh {
    
    public string $ingredName;
    public string $ingredDescription;
    public string $ingredType;
    public string $ingredAlcohol;
    public int $ingredID;

    public function __construct($ingredName = "", $ingredDescription = "", $ingredType = "", $ingredAlcohol = "", $ingredID = 0) {
        $this->ingredName = $ingredName;
        $this->ingredDescription = $ingredDescription;
        $this->ingredType = $ingredType;
        $this->ingredAlcohol = $ingredAlcohol;
        $this->ingredID = $ingredID;
    }

    function create($ingredID, $ingredName, $ingredDescription, $ingredType, $ingredAlcohol) {
        // zorgt er voor dat er alleen ja of nee kan ingevult worden
        if ($ingredAlcohol != "ja" || $ingredAlcohol != "nee") {
            echo "<script>alert('Je kan alleen Ja of Nee invullen bij of er alcohol inzit!')</script>";
            return;
        }

        // checkt of de ingredient al in de database zit
        $sql = "SELECT ingredName FROM ingrediënts WHERE ? = ingredName";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ingredName]);

        if($stmt->fetch()) {
            // zit het ingredient al in de database stop de function
            echo "<script>allert('Ingredient bestaat al')</script>";
            return;
        } else {
            // zit de ingredient er nog niet in dan word het ingredient aangemaakt
            $sql = "INSERT INTO ingrediënts( ingredName, ingredDescription, ingredType, ingredAlcohol) 
            VALUES ( ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            // checkt of het gelukt is ingredient te maken
            $stmt->execute([ $ingredName, $ingredDescription, $ingredType, $ingredAlcohol]);
            if ($stmt) {
                echo "<script>console.log('ingredient toegevoegt.')</script>";
            } else {
                echo "<script>console.log('Er is iets fout gegaan, kon niet de ingrediënts toevoegen.')</script>";
            }
        }

    }

    static function readAll() {
        return Ingredienten::SelectGeneric("SELECT * FROM ingrediënts", []);
    }

    static private function SelectGeneric( $SQL, $values){
        $db = new Dbh();
        $stmt = $db->connect()->prepare($SQL);
        $stmt->execute($values);

        $totalList = [];
        while ($row = $stmt->fetch()) { 
            $item = new Ingredienten($row["ingredName"], $row["ingredDescription"], $row["ingredType"], $row["ingredAlcohol"], $row["ingredID"]);
            array_push($totalList, $item);
        }
        return $totalList;
    }

    static function searchName($ingredName) {
        return Ingredienten::SelectGeneric("SELECT * FROM ingrediënts WHERE ? = ingredName", [$ingredName]);
    }

    function delete($ingredID) {
        $sql = "DELETE FROM ingrediënts WHERE ingredID = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$ingredID]);
        if ($stmt->execute()) {
            echo "<script>console.log('Gelukt ingredient te verwijderen.')</script>";
        } else {
            echo "<script>console.log('Er is iets fout gegaan, kon niet de ingredient deleten.')</script>";
        }
    }

    function nameFound($ingredName) {
    }
}