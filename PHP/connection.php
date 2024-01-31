<?php
//richiamo file contenente le credenziali
require_once('credentials.php');

//Connessione al server
$conn = new mysqli($servername, $username, $password);
$outputInfo = array();

//salvataggio errori dentro un array da stampare
if ($conn->connect_error) {
    $outputInfo[] = "Connection failed: " . $conn->connect_error;
}
