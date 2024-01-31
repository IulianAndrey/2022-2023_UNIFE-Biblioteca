<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query5";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');
//verifico chiamata
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parametroRicerca = $_POST['utente'];

    //ass. query
    $query = "
SELECT
    Utente.nome_u AS 'Nome',
    Utente.cognome_u AS 'Cognome',
    Utente.matricola AS 'Matricola',
    Libro.titolo AS 'Titolo Libro',
    Prestito.data_rilascio AS 'Data Rilascio'
FROM
    Prestito
LEFT OUTER JOIN Libro ON Prestito.id_libro = Libro.id_libro
LEFT OUTER JOIN Utente ON Prestito.matricola = Utente.matricola
WHERE Prestito.matricola LIKE '%" . $parametroRicerca . "%'
";
    //exec. query
    $result = $conn->query($query);

    //verifico corretta esecuzione query
    if ($result == TRUE) {
        $outputInfo[] = "query eseguita senza errori!";
    } else {
        $outputInfo[] = "Errore query:" . $conn->error;
    }
}


?>

<body>
    <div class="container">
        <h1> Inserisci la matricola dell'utente di interesse da cercare </h1>

        <form method="POST" action="Q5.php">
            <input type="text" name="utente" />
            <input type="submit" class="submit" value="Ricerca" />
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    }

    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>
