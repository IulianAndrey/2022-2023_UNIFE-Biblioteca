<?php
require_once('credentials.php');
$conn = new mysqli($servername, $username, $password);
$connOutput = array();

if ($conn->connect_error) {
    $connOutput[] = "Connection failed: " . $conn->connect_error;
}
