<!DOCTYPE html>
<html lang="it">
<?php
$pageTile = "Query 1";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');

//Definizione query
$query = "
SELECT
    Libro.ID_LIBRO AS 'ID',
    Libro.TITOLO AS 'Titolo',
    Libro.ISBN AS 'ISBN',
    Libro.LINGUA AS 'Lingua',
    Libro.ANNO_PUB AS 'Anno Pub.',
    Dipartimento.Nome_D AS 'Dipartimento'
FROM
    Libro
LEFT OUTER JOIN Dipartimento ON Libro.ID_DIPARTIMENTO = Dipartimento.ID_D
";
?>
<body>
    <div class="container">
        <h3> Nome libro da cercare (anche parzialmente)</h3>
        <form method="POST">
            <input type="text" name="ricerca_libro" />
            <input type="submit" class="submit" value="Cerca" />
        </form>
    </div>
    <?php

    //Verifico che la chiamata sia POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //asseg. parametro
        $parametroRicerca = $_POST['ricerca_libro'];
        //verifica che parametro non sia vuoto
        if (isset($parametroRicerca)) {
            $query .= " WHERE Libro.titolo LIKE '%" . $parametroRicerca . "%'";
        }else{

        }
    }
    //Eseguo query
    $result = $conn->query($query);

    //verifico corretta esecuzione query
    if($result == TRUE){
        $outputInfo[] = "query eseguita senza errori!";
    }else{
        $outputInfo[] = "Errore query:" .$conn->error;
    }

    //verifica che parametro non sia vuoto
    if (isset($parametroRicerca)) {
        echo "<p>Sono presenti $result->num_rows record per la ricerca: $parametroRicerca</p><hr>";
    } else {
        echo "<p>Sono presenti $result->num_rows record</p><hr>";
    }

    //costruisco div contenente la tabella
    echo "<div class=\"row center\">";
    echo BuildTable($result);
    echo "</div>";

    /*Includo file contenente il footer*/
    include $parentDir . '/res/footer.php'; ?>

</body>
</html>
