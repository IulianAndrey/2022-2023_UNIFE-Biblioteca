<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

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
    'Numero prestiti'
DESC
";

?>

<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query Extra 2";
include($parentDir . '/res/head.php');
?>

<body>
    <?php
    $result = $conn->query($query);

    /*chiamiamo funzione che costruisce tabella*/
    echo BuildTable($result);

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>