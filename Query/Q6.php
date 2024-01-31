<?php
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);

/*Includo file contenente la testata*/
$pageTile = "Query 6";
include($parentDir . '/res/head.php');

//ass. query
$query = "
SELECT
    Libro.titolo AS 'Titolo',
    Prestito.data_rilascio AS 'Data Rilascio',
    Utente.nome_u AS 'Nome Utente',
    Utente.cognome_u AS 'Cognome Utente',
    Utente.matricola AS 'Matricola',
    CASE WHEN Prestito.rientrato = 0 THEN 'Finito' ELSE 'Prestito in corso'
END AS 'Stato Prestito'
FROM
    Prestito
LEFT OUTER JOIN Libro ON Prestito.id_libro = Libro.id_libro
LEFT OUTER JOIN Utente ON Prestito.matricola = Utente.matricola
";

$result = $conn->query($query);

//verifico corretta esecuzione query
if ($result == TRUE) {
    $outputInfo[] = "query eseguita senza errori!";
} else {
    $outputInfo[] = "Errore query:" . $conn->error;
}

?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query5";
include($parentDir . '/res/head.php');
?>

<body>
    <?php
    echo "<p>Sono presenti $result->num_rows prestiti registrati</p><hr>";

    echo "<div class=\"row center\">";
    echo BuildTable($result);
    echo "</div>";

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>