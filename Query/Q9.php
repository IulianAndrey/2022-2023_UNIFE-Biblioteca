<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parametroRicerca = $_POST['dipartimento']; /*nome del dipartimento va nella variabile parametro_ricerca*/
    if (isset($parametroRicerca)) {
        $query = "
SELECT
    COUNT(Prestito.id) AS Numero_prestiti
FROM
    Prestito
LEFT OUTER JOIN Libro ON Prestito.id_libro = Libro.id_libro
LEFT OUTER JOIN Dipartimento ON Libro.id_dipartimento = Dipartimento.id_d
WHERE Dipartimento.nome_d LIKE '%" . $parametroRicerca . "%' "
        ;

        $result = $conn->query($query);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query 9";
include($parentDir . '/res/head.php');
?>

<body>
    <div class="container">
        <h1>Inserisci il nome del dipartimento/succursale di interesse</h1>
        <form method="POST" action="Q9.php">
            <input type="text" name="dipartimento" />
            <input type="submit" class="submit" value="Ricerca" />
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<p>\n\nnumero dei prestiti nel dipartimento di $parametroRicerca</p>";

        echo BuildTable($result);
    }
    include $parentDir . '/res/footer.php'; ?>
</body>
</html>