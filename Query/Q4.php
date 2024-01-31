<!DOCTYPE html>
<html lang="en">
<?php
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);

/*Includo file contenente la testata*/
$pageTile = "Query4";
include($parentDir . '/res/head.php');

//definizione query
$query = "
SELECT
    matricola AS 'Matricola',
    nome_u AS 'Nome',
    cognome_u AS 'Cognome',
    via_u AS 'Via',
    civico_u AS 'Civico',
    cap_u AS 'CAP',
    citta_u AS 'Città',
    telefono_u AS 'Telefono'
FROM
    Utente
";

//esecuzione query
$result = $conn->query($query);
if ($result == TRUE) {
    $outputInfo[] = "query eseguita senza errori!";
} else {
    $outputInfo[] = "Errore query:" . $conn->error;
}

?>
<body>
    <?php

    echo "<p>Sono presenti $result->num_rows utenti registrati</p><hr>";

    echo "<div class=\"row center\">";
    echo BuildTable($result);
    echo "</div>";

    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>
