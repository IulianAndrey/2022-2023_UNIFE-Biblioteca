<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');
$campiDaEstrarre = "SELECT dipartimento.id_d as 'ID Dipartimetno' ";
$restoDellaQuery = "
FROM `prestito`
LEFT OUTER JOIN libro ON prestito.id_libro = libro.id_libro
LEFT OUTER JOIN dipartimento ON libro.id_dipartimento = dipartimento.id_d
GROUP BY dipartimento.id_d
ORDER BY COUNT(prestito.id) DESC
";

$query2 = "
SELECT
COUNT(prestito.id) as TOT
FROM prestito
";

$query3 = "
SELECT
    libro.*,
    COUNT(libro.id_libro) as Prestato
FROM
    dipartimento
INNER JOIN libro ON libro.id_dipartimento = dipartimento.id_d
INNER JOIN prestito ON prestito.id_libro = libro.id_libro
WHERE
    dipartimento.id_D =(
        " . $campiDaEstrarre . " " .
    $restoDellaQuery . "
LIMIT 1
)
GROUP by libro.id_libro
";

$campiDaEstrarre .= ",
dipartimento.nome_d AS 'Nome Dipartimento',
COUNT(prestito.id) AS 'Totale Prestiti' ";

$query = $campiDaEstrarre . $restoDellaQuery;


echo $campiDaEstrarre;



$result = $conn->query($query);
$result2 = $conn->query($query2);
$result3 = $conn->query($query3);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
if (!$result2) {
    die("Query failed: " . mysqli_error($conn));
}
if (!$result3) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query Extra 3";
include($parentDir . '/res/head.php');
?>

<body>
    <div style="text-align: center">
        <?php
        while ($row = $result2->fetch_assoc()) {
            echo "<p class=\"\">Totale prestiti: " . $row['TOT'] . "</p><hr>";
        }
        echo " <div class=\"row\" style=\"justify-content: space-around;\">";

        echo "<h1>Classifica biblioteche</h1>";
        echo "<h1>Classifica libri della prima biblioteca </h1>";
        echo "</div>";
        echo " <div class=\"row\" style=\"justify-content: space-around;;\">";
        echo BuildTable($result);
        echo BuildTable($result3);
        echo "</div>";
        include $parentDir . '/res/footer.php'; ?></div></body>
</html>