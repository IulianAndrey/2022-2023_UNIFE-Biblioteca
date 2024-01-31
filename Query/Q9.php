<!DOCTYPE html>
<html lang="it">
<?php
$pageTile = "Query 9";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parametroRicerca = $_POST['dipartimento']; /*nome del dipartimento va nella variabile parametro_ricerca*/

    if (isset($parametroRicerca)) {
//def. query
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

        //verifico corretta esecuzione query
        if ($result == TRUE) {
            $outputInfo[] = "query eseguita senza errori!";
        } else {
            $outputInfo[] = "Errore query:" . $conn->error;
        }
    }
}


?>
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

        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    }
    include $parentDir . '/res/footer.php'; ?>
</body>
</html>