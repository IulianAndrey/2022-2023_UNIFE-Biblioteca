<?php
require_once('credentials.php');

$conn = new mysqli($servername, $username, $password);
$connOutput = array();

if ($conn->connect_error) {
    $connOutput[] = "Connection failed: " . $conn->connect_error;
}

//Check if database exists or create it
$query = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($query) === TRUE) {
    $connOutput[] = "Database created or already exists";
    require_once('connection_database.php');

    $parentDir = dirname(__DIR__);
    $tablesToCreate = [
        ["table" => "autore", "path" => $parentDir . "/SQL/autore.sql"],
        ["table" => "dipartimento", "path" => $parentDir . "/SQL/dipartimento.sql"],
        ["table" => "libro", "path" => $parentDir . "/SQL/libro.sql"],
        ["table" => "libro_autore", "path" => $parentDir . "/SQL/libro_autore.sql"],
        ["table" => "prestito", "path" => $parentDir . "/SQL/prestito.sql"],
        ["table" => "utente", "path" => $parentDir . "/SQL/utente.sql"]
    ];

    // Query per ottenere l'elenco di tutte le tabelle nel database
    $tablesQuery = $conn->query("SHOW TABLES");
    $exisingTables = $tablesQuery->fetch_all();

    foreach ($tablesToCreate as $tableInfo) {
        $tableName = $tableInfo["table"];

        if (in_array([$tableName], $exisingTables)) {
            $connOutput[] = "Table $tableName already exists.";
        } else {
            $connOutput[] = "Creating table $tableName...";
            $sqlContent = file_get_contents($tableInfo["path"]);
            $createTableResult = $conn->query($sqlContent);

            if ($createTableResult) {
                $connOutput[] = "Table created successfuly $tableName";
            } else {
                $connOutput[] = "Error while creating table: $tableName: " . $conn->error;
            }
        }
    }
} else {
    $connOutput[] = "Error guring database creation: " . $conn->error;
}

$conn->close();
