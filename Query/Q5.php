<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parametroRicerca = $_POST['utente'];

    $query = @"
SELECT
Utente.nome_u,
Utente.cognome_u,
Utente.matricola,
Libro.titolo,
Prestito.data_rilascio

FROM Prestito
LEFT OUTER JOIN Libro ON
    Prestito.id_libro= Libro.id_libro
LEFT OUTER JOIN Utente ON
    Prestito.matricola=Utente.matricola
WHERE Prestito.matricola LIKE '%" . $parametroRicerca . "%'
";

    $result = $conn->query($query);
}



?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query5";
include($parentDir . '/res/head.php');
?>
<body>
    <div class="container">
        <h1> Inserisci la matricola dell'utente di interesse da cercare </h1>

        <form method="POST" action="Q5.php">
            <input type="text" name="utente" />
            <input type="submit" class="submit" value="Ricerca" />
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo BuildTable($result);
    }

    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>
