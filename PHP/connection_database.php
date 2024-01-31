<?php
//richiamo consessione
require_once("connection.php");

//verifico se database impostato
if (!$conn->select_db($database)) {
    $outputInfo = "Impossibile selezionare il DB: " . $conn->error;
}else{
    $conn->select_db($database);
}
?>