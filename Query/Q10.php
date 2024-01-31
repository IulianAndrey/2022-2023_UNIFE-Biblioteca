<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');


$query ="
SELECT
    Autore.id_autore,
    Autore.nome_a,
    Autore.cognome_a,
    COUNT(Libro.id_libro) AS Numero_libri
FROM
    Libro_Autore
LEFT OUTER JOIN Libro ON Libro_Autore.id_libro = Libro.id_libro
LEFT OUTER JOIN Autore ON Libro_Autore.id_autore = Autore.id_autore
GROUP BY
    Autore.id_autore
ORDER BY COUNT(Libro.id_libro) DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query 10";
include($parentDir . '/res/head.php');
?>

<body>


    <?php


    //$parametroRicerca = $_POST['anno']; /*anno che si vuole va nella variabile parametro_ricerca*/

    /*sql query 10*/



    $result = $conn->query($query);

    /*chiamiamo funzione che costruisce tabella*/
    echo BuildTable($result);

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>