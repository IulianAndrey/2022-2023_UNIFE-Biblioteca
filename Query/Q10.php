<!DOCTYPE html>
<html lang="it">
<?php
$pageTile = "Query 10";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');
//def. query


$query ="
SELECT
    Autore.id_autore AS 'ID',
    Autore.nome_a AS 'Nome',
    Autore.cognome_a AS 'Cognome',
    COUNT(Libro.id_libro) AS 'Numero Libri'
FROM
    Libro_Autore
LEFT OUTER JOIN Libro ON Libro_Autore.id_libro = Libro.id_libro
LEFT OUTER JOIN Autore ON Libro_Autore.id_autore = Autore.id_autore
GROUP BY
    Autore.id_autore
ORDER BY COUNT(Libro.id_libro) DESC
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
    //exec query
    $result = $conn->query($query);

    /*chiamiamo funzione che costruisce tabella*/
    echo "<div class=\"row center\">";
    echo BuildTable($result);
    echo "</div>";

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>