<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

$query = "
SELECT
    dipartimento.nome_d AS 'Nome Dipartimento',
    COUNT(prestito.id) AS 'Totale Prestiti'
FROM `prestito`
LEFT OUTER JOIN libro ON prestito.id_libro = libro.id_libro
LEFT OUTER JOIN dipartimento ON libro.id_dipartimento = dipartimento.id_d
GROUP BY dipartimento.id_d
ORDER BY COUNT(prestito.id) DESC;
";

$result = $conn->query($query);

$query2 = "
SELECT
COUNT(prestito.id) as TOT
FROM prestito
";

$result2 = $conn->query($query2);

?>

<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "QueryeXTRA2";
include($parentDir . '/res/head.php');
?>

<body>
    <?php
    while ($row = $result2->fetch_assoc()) {
        echo "<p class=\"\">Totale prestiti: " .$row['TOT'] . "</p><hr>";
    }

    echo BuildTable($result);

    include $parentDir . '/res/footer.php'; ?>
</body>
</html>