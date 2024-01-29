<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

$query = "
SELECT
    autore.NOME_A,
    autore.COGNOME_A,
    COUNT(Libro.id_libro) as Libri
FROM autore
LEFT OUTER JOIN libro_autore ON
    autore.ID_AUTORE = libro_autore.ID_AUTORE
LEFT OUTER JOIN libro ON
    libro_autore.ID_LIBRO = libro.ID_LIBRO
GROUP BY autore.ID_AUTORE
";

$result = $conn->query($query);



?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query5";
include($parentDir . '/res/head.php');
?>

<body>
    <?php
    echo "<p>Sono presenti $result->num_rows prestiti registrati</p><hr>";

    echo BuildTable($result);

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>