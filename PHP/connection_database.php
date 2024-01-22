<?php
require_once("connection.php");

if (!$conn->select_db($database)) {
    $connOutput[] = "Database selection filed: " . $conn->error;
}else{
    $conn->select_db($database);
}
?>