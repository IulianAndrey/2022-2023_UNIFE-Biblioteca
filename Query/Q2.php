<!DOCTYPE html>
<html lang="en">
<?php
$pageTile = "Query2";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);

/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');

//definizione query
$queryAutoriLibri = "
SELECT
    libro.TITOLO,
    libro.ISBN,
    libro.LINGUA,
    libro.ANNO_PUB,
    autore.NOME_A,
    autore.COGNOME_A,
    autore.DATA_NASCITA,
    autore.LUOGO_NASCITA
FROM
    libro_autore
LEFT OUTER JOIN libro ON
    libro_autore.ID_LIBRO = libro.ID_LIBRO
LEFT OUTER JOIN autore ON
    autore.ID_AUTORE = libro_autore.ID_AUTORE
";


$queryAutori = "
SELECT
autore.ID_AUTORE,
autore.NOME_A,
autore.COGNOME_A
FROM autore";

//estraggo dati per generare la select
$result = $conn->query($queryAutori);

if ($result == TRUE) {
    $outputInfo[] = "query eseguita senza errori!";
} else {
    $outputInfo[] = "Errore query:" . $conn->error;
}
?>

<body>
    <div class="container">
        <h3>Seleziona Autore</h3>
        <form method="POST">
            <?php
            echo "<select name='id_autore'>
                ";
            //creo una option per ogni record
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['ID_AUTORE'] . "'>" . $row['NOME_A'] . '' . $row['COGNOME_A'] . "</option>";
            }
            echo "</select>";
            ?>
            <input type="submit" class="submit" value="Cerca" />
        </form>
    </div>
    <?php

    //verifico che la chiamata sia post e assegno parametro se esistente
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $parametroRicerca = $_POST['id_autore'];
        if (isset($parametroRicerca)) {
            $queryAutoriLibri .= " WHERE $parametroRicerca = autore.id_autore";
        }
    }
    //aggiungo altro pezzo alla query
    $queryAutoriLibri .= "
            ORDER BY
            libro.ANNO_PUB DESC,
            autore.ID_AUTORE ASC;
        ";
    //eseguo query e richiamo funzione
    $result = $conn->query($queryAutoriLibri);

    if ($result == TRUE) {
        $outputInfo[] = "query eseguita senza errori!";
    } else {
        $outputInfo[] = "Errore query:" . $conn->error;
    }
    //richiamo funzione
    echo formatResultAsHtml($result);
    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>

<?php

//funzione che general il codice html
function formatResultAsHtml($result)
{
    $authorsAndBooks = array();
    $HtmlToPrint = "";

    //ciclo per ogni riga presente nel result
    while ($row = mysqli_fetch_assoc($result)) {
        $author = $row['NOME_A'] . ' ' . $row['COGNOME_A'] . ' - nato il: ' . $row['DATA_NASCITA'] . ' - a: ' . $row['LUOGO_NASCITA'];
        $year = $row['ANNO_PUB'];

        //creo nuovo array che contiene al suo interno altri array, array autori che contiene array anni e ogni anno contiene i relativi libri

        $authorsAndBooks[$author][$year][] = array(
            'TITOLO' => $row['TITOLO'],
            'ISBN' => $row['ISBN'],
            'LINGUA' => $row['LINGUA'],
        );
    }
    //costruisco l'html
    foreach ($authorsAndBooks as $author => $years) {
        $HtmlToPrint .= "<h3>Autore: $author</h3>";

        $HtmlToPrint .= "<ul>";
        foreach ($years as $year => $books) {
            $HtmlToPrint .= "<li>";
            $HtmlToPrint .= "<h4>Anno: $year</h4>";
            $HtmlToPrint .= BuildTable($books);
            $HtmlToPrint .= "</li>";
        }
        $HtmlToPrint .= "</ul>";
    }
    return $HtmlToPrint;
}
?>