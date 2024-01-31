<!DOCTYPE html>
<html lang="it">
<?php
$pageTile = "Query Extra 2";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');
//def. query
$query = "
SELECT
    Autore.id_autore,
    Autore.nome_a AS 'Nome Autore',
    Autore.cognome_a AS 'Cognome Autore',
    COUNT(Prestito.id) AS 'Numero prestiti'
FROM
    Autore
JOIN Libro_Autore ON Autore.id_autore = Libro_Autore.id_autore
JOIN Libro ON Libro_Autore.id_libro = Libro.id_libro
JOIN Prestito ON Libro.id_libro = Prestito.id_libro
GROUP BY
    Autore.id_autore,
    Autore.nome_a,
    Autore.cognome_a
ORDER BY
    COUNT(Prestito.id)
DESC
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
    /*chiamiamo funzione che costruisce tabella*/
    echo "<div class=\"row center\">";
    echo BuildTable($result);
    echo "</div>";

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>