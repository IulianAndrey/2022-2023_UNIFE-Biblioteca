<!DOCTYPE html>
<html lang="en">
<?php
$pageTile = "Query8";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');
//def. query
$query = "
SELECT
    autore.NOME_A,
    autore.COGNOME_A,
    COUNT(Libro.id_libro) as Libri
FROM autore
LEFT OUTER JOIN libro_autore ON
    autore.ID_AUTORE = libro_autore.ID_AUTORE
LEFT OUTER JOIN libro ON
    libro_autore.ID_LIBRO = libro.ID_LIBRO
GROUP BY autore.ID_AUTORE
";

$result = $conn->query($query);

//verifico corretta esecuzione query
if ($result == TRUE) {
    $outputInfo[] = "query eseguita senza errori!";
} else {
    $outputInfo[] = "Errore query:" . $conn->error;
}

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