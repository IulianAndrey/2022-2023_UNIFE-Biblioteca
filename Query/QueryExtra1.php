<!DOCTYPE html>
<html lang="it">
<?php
$pageTile = "Query extra 1";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');
//def. query

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restituito = "1";
    $parametroRicerca = $_POST['disponibile']; /*NOME LIBRO che si vuole va nella variabile parametro_ricerca*/
    if (isset($parametroRicerca)) {
        $query = "
SELECT
    Libro.titolo,
    Dipartimento.nome_d AS Locazione
FROM prestito
LEFT OUTER JOIN Libro ON prestito.id_libro = Libro.id_libro
LEFT OUTER JOIN Dipartimento ON Libro.id_dipartimento = Dipartimento.id_d
WHERE  Libro.titolo LIKE '%" . $parametroRicerca . "%'  AND Prestito.rientrato = $restituito ";

        $result = $conn->query($query);

        //verifico corretta esecuzione query
        if ($result == TRUE) {
            $outputInfo[] = "query eseguita senza errori!";
        } else {
            $outputInfo[] = "Errore query:" . $conn->error;
        }
    }
}
?>

<body>
    <div class="container">

        <h1>Inserisci il nome del libro di interesse da cercare</h1>

        <form method="POST" action="QueryExtra1.php">
            <input type="text" name="disponibile" />
            <input type="submit" class="submit" value="Cerca disponibilità" />
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    }

    include $parentDir . '/res/footer.php';
    ?>
</body>
</html>