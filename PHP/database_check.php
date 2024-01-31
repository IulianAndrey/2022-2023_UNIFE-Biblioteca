<?php

//Aggiungo file credenziali
require_once('credentials.php');

//Connessione al server
$conn = new mysqli($servername, $username, $password);

//Verifico se ci sono errori
if ($conn->connect_error) {
    $outputInfo[] = "Connection failed: " . $conn->connect_error;
}

//Check se db non esiste crealo
$query = "CREATE DATABASE IF NOT EXISTS $database";
//Verifico esito positivo della query
if ($conn->query($query) === TRUE) {
    $outputInfo[] = "DB creato o esistente";
    require_once('connection_database.php');

    $parentDir = dirname(__DIR__);
    //Mappatura tabelle e relativo file di creazione
    $tablesToCreate = [
        ["table" => "autore", "path" => $parentDir . "/SQL/autore.sql"],
        ["table" => "dipartimento", "path" => $parentDir . "/SQL/dipartimento.sql"],
        ["table" => "libro", "path" => $parentDir . "/SQL/libro.sql"],
        ["table" => "libro_autore", "path" => $parentDir . "/SQL/libro_autore.sql"],
        ["table" => "prestito", "path" => $parentDir . "/SQL/prestito.sql"],
        ["table" => "utente", "path" => $parentDir . "/SQL/utente.sql"]
    ];

    //Query per ottenere l'elenco di tutte le tabelle nel database
    $tablesQuery = $conn->query("SHOW TABLES");
    $exisingTables = $tablesQuery->fetch_all();
    //Ciclo e verifico se le tabelle sono presenti nella lista delle tabelle presenti a db altrimenti le creo
    foreach ($tablesToCreate as $tableInfo) {
        $tableName = $tableInfo["table"];

        if (in_array([$tableName], $exisingTables)) {
            $outputInfo[] = "La tabella $tableName esiste gia'.";
        } else {
            $outputInfo[] = "Creazione tabella $tableName...";
            $sqlContent = file_get_contents($tableInfo["path"]);
            $createTableResult = $conn->query($sqlContent);

            //comunicazione di avvenuta creazione o relativo errore
            if ($createTableResult) {
                $outputInfo[] = "Tabella $tableName creata";
            } else {
                $outputInfo[] = "Errore durante la creazione della tabella $tableName: " . $conn->error;
            }
        }
    }
} else {
    $outputInfo[] = "Errore durante la creazione del DB: " . $conn->error;
}

