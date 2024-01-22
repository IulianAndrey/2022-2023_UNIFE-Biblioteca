<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

$queryAutoriLibri = "
SELECT
    libro.TITOLO,
    libro.ISBN,
    libro.LINGUA,
    libro.ANNO_PUB,
    /*libro.NUMERO_COPIE AS 'COPIE',*/
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

$result = $conn->query($queryAutori);

?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query2";
include($parentDir . '/res/head.php');
?>
<body>
    <div class="container">
        <h3>Seleziona Autore</h3>
        <form method="POST">
            <?php
            echo "<select name='id_autore'>
                ";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['ID_AUTORE'] . "'>" . $row['NOME_A'] . '' . $row['COGNOME_A']. "</option>";
            }
            echo "</select>";
            ?>
            <input type="submit" class="submit" value="Cerca" />
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $parametroRicerca = $_POST['id_autore'];
        if (isset($parametroRicerca)) {
            $queryAutoriLibri .= " WHERE $parametroRicerca = autore.id_autore";
        }
    }
    $queryAutoriLibri .= "
            ORDER BY
            libro.ANNO_PUB DESC,
            autore.ID_AUTORE ASC;
        ";
    $result = $conn->query($queryAutoriLibri);
    echo formatResultAsHtml($result);
    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>

<?php
function formatResultAsHtml($result)
{
    $authorsAndBooks = array();
    $HtmlToPrint = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $author = $row['NOME_A'] . ' ' . $row['COGNOME_A'] . ' - nato il: ' . $row['DATA_NASCITA'] . ' - a: ' . $row['LUOGO_NASCITA'];
        $year = $row['ANNO_PUB'];

        $authorsAndBooks[$author][$year][] = array(
            'TITOLO' => $row['TITOLO'],
            'ISBN' => $row['ISBN'],
            'LINGUA' => $row['LINGUA'],
            //'COPIE' => $row['COPIE'],
        );
    }

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