<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

$query = "
SELECT
Libro.titolo AS 'Titolo',
Prestito.data_rilascio AS 'Data Rilascio',
Utente.nome_u AS 'Nome Utente',
Utente.cognome_u AS 'Cognome Utente',
Utente.matricola AS 'Matricola',
CASE
   WHEN Prestito.rientrato = 0 THEN 'Finito'
   ELSE 'Prestito in corso'
END as 'Stato Prestito'

FROM Prestito
LEFT OUTER JOIN Libro ON
    Prestito.id_libro= Libro.id_libro
LEFT OUTER JOIN Utente ON
    Prestito.matricola=Utente.matricola
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