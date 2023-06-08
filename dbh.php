<?php

// Florian Koning

class Dbh
{
    // variabelen
    private $IP;
    private $DBName;
    private $userName;
    private $password;

    public function connect()
    {
        // alle variabelen die nodig zijn om met de database te verbinden
        $this->IP = "localhost";
        $this->DBName = "project8";
        $this->userName = "root";
        $this->password = "";

        // maakt de connectie met de database en geeft alert box wanneer er iets fout gaat
        try {
            // verbind met de database
            $dbConnectie = new PDO("mysql:host =" . $this->IP . ";dbname=" . $this->DBName, $this->userName, $this->password);
            $dbConnectie->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $dbConnectie;
        } catch (PDOException $e) {
            // maakt de alert box
            die("<script>alert('Er is iets fout gegaan met de database!')</script>" . $e->getMessage());
        }
    }
}