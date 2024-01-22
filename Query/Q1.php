<?php
$parentDir = dirname(__DIR__);
$pageTile = "Query1";

$query = "
SELECT
Libro.ID_LIBRO as 'ID',
Libro.TITOLO as 'Titolo',
Libro.ISBN as 'ISBN',
Libro.LINGUA as 'Lingua',
Libro.ANNO_PUB as 'Anno Pub.',
Dipartimento.Nome_D as 'Dipartimento'
/*Libro.NUMERO_COPIE as 'N. Copie'*/
FROM Libro
LEFT OUTER JOIN Dipartimento
ON Libro.ID_DIPARTIMENTO= Dipartimento.ID_D
";

?>
<!DOCTYPE html>
<html lang="it">
<?php include($parentDir . '/res/head.php'); ?>
<body>
    <div class="container">
        <h3> Nome libro da cercare (anche parzialmente)</h3>
        <form method="POST">
            <input type="text" name="ricerca_libro" />
            <input type="submit" class="submit" value="Cerca" />
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $parametroRicerca = $_POST['ricerca_libro'];
        if (isset($parametroRicerca)) {
            $query .= " WHERE Libro.titolo LIKE '%" . $parametroRicerca . "%'";
        }
    }
    require_once($parentDir . '/PHP/funcBuildTable.php');
    $result = $conn->query($query);
    if (isset($parametroRicerca)) {
        echo "<p>Sono presenti $result->num_rows record per la ricerca: $parametroRicerca</p><hr>";
    }

    echo BuildTable($result);
    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>
