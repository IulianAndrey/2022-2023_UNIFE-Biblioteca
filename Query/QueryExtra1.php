<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

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
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
$pageTile = "Query extra 1";
include($parentDir . '/res/head.php');
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
        echo BuildTable($result);
    }

    include $parentDir . '/res/footer.php';
    ?>
</body>
</html>