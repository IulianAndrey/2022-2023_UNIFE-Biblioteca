<!DOCTYPE html>
<html lang="en">
<?php
$pageTile = "Query7";
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/*Includo file contenente la testata*/
include($parentDir . '/res/head.php');


?>

<body>
    <div class="container">
        <h1> Inserisci il range di date </h1>

        <form method="POST" action="Q7.php">
            <br><input type="date" name="data1" /><br>

            <br><input type="date" name="data2" /><br>
            <br><input type="submit" class="submit" value="Ricerca" /><br>
            <hr />
        </form>
    </div>
    <?php
    $parametroRicerca = $_POST['data1'];
    $parametroRicerca2 = $_POST['data2']; /*inserendo il range di date nel parametro_ricerca*/


    if (!empty($parametroRicerca) && !empty($parametroRicerca2)) {
        /*sql query 7*/
        $query = "SELECT *
            FROM Prestito
            WHERE data_rilascio BETWEEN '$parametroRicerca' AND '$parametroRicerca2'"
        ;

        $result = $conn->query($query);


        /*chiamiamo funzione che costruisce tabella*/
        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    } else {
        $giorni = 30;
        echo 'LIBRI IN SCADENZA';
        $query = "SELECT Utente.nome_u,Utente.cognome_u,Utente.telefono_u, Prestito.data_rilascio,Libro.titolo, Dipartimento.nome_d
            FROM Prestito,Utente,Libro, Dipartimento
            WHERE Utente.matricola=Prestito.matricola
            AND Libro.id_libro=Prestito.id_libro
            AND Libro.id_dipartimento=Dipartimento.id_dipartimento
            AND restituito=0 AND data_rilascio < date_sub(current_date(), interval '$giorni' day)
        order by data_rilascio;"
        ;
        $result = $conn->query($query);
        echo "<div class=\"row center\">";
        echo BuildTable($result);
        echo "</div>";
    }
    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>