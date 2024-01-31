<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query3";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');

$queryLuogoNascita = "SELECT luogo_nascita FROM autore GROUP BY luogo_nascita";

$resultLuogoNascita = $conn->query($queryLuogoNascita);
if ($resultLuogoNascita == TRUE) {
    $outputInfo[] = "query eseguita senza errori!";
} else {
    $outputInfo[] = "Errore query:" . $conn->error;
}
?>

<body>
    <div class="container">
        <h1>Ricerca autori</h1>
        <form method="POST">
            <div class="row">
                <p>Inserisci il nome dell'autore</p>
                <input type="text" name="ricerca_nome_autore" />
            </div>
            <div class="row">
                <p>Inserisci il nome dell'autore</p>
                <input type="text" name="ricerca_cognome_autore" />
            </div>
            <div class="row">
                <p>Inserisci la data di nascita dell'autore</p>
                <input type="text" name="ricerca_data_autore" />
            </div>
            <div class="row">
                <p>Inserisci il luogo di nascita  dell'autore</p>
                <?php
                echo "<select name='ricerca_luogo_autore'>
                ";
                    echo "<option value=\"\">"."Seleziona luogo di nascita"."</option>";

                while ($row = mysqli_fetch_assoc($resultLuogoNascita)) {
                    echo "<option value=".$row['luogo_nascita'].">".$row['luogo_nascita']."</option>";
                }
                echo "</select>";
                ?>
            </div>
            <br />
            <input type="submit" class="submit" value="Ricerca" />
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $parametroRicerca = $_POST['ricerca_nome_autore'] ?? ""; /*NOME autore che si vuole va nella variabile parametro_ricerca*/
        $parametroRicerca2 = $_POST['ricerca_cognome_autore'] ?? ""; /*COGNOME autore che si vuole va nella variabile parametro_ricerca*/
        $parametroRicerca3 = $_POST['ricerca_data_autore'] ?? ""; /*Data nascita autore che si vuole va nella variabile parametro_ricerca*/
        $parametroRicerca4 = $_POST['ricerca_luogo_autore'] ?? ""; /*Luogo nascita autore che si vuole va nella variabile parametro_ricerca*/
        $query = "
SELECT
    Autore.id_autore AS 'ID',
    Autore.nome_a AS 'Nome',
    Autore.cognome_a AS 'Cognome',
    Autore.data_nascita AS 'Data Nascita',
    Autore.luogo_nascita AS 'Luogo Nascita'
FROM
    Autore
WHERE
    1
";

        //aggiungo filtro se parametri impostati
        if (isset($parametroRicerca)) {
            $query .= " AND Autore.nome_a LIKE '%".$parametroRicerca."%' ";
        }
        if (isset($parametroRicerca2)) {
            $query .= "  AND Autore.cognome_a LIKE '%".$parametroRicerca2."%' ";
        }
        if (isset($parametroRicerca3)) {
            $query .= " AND Autore.data_nascita LIKE '%".$parametroRicerca3."%' ";
        }
        if (isset($parametroRicerca4)) {
            $query .= " AND Autore.luogo_nascita LIKE '%".$parametroRicerca4."%' ";
        }

        //eseguo query
        $result = $conn->query($query);

        //verifico corretta esecuzione query
        if ($result == TRUE) {
            $outputInfo[] = "query eseguita senza errori!";
        } else {
            $outputInfo[] = "Errore query:" . $conn->error;
        }

        if (isset($parametroRicerca)) { /*isset controlla se una variabile è vuota*/
            echo "<p>Sono presenti $result->num_rows record per questa ricerca</p><hr>";
        }

        /*chiamiamo funzione che costruisce tabella*/
        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    }


    ?>


    <?php include $parentDir.'/res/footer.php'; ?>
</body>
</html>