<!DOCTYPE html>
<html lang="it">

<?php
$pageTile = "Gestione biblioteca universitaria UNIFE";
require_once('PHP/database_check.php');
include 'res/head.php';
?>
<body>

    <div class="container">
        <h1>Benvenuti nella pagina di gestione della Biblioteca di UNIFE</h1>
        <p>Scegli la ricerca da effettuare</p>
        <a class="button" href="upload.php">Aggiungi i dati dai file</a>
    </div>
    <!-- prima query-->
    <div class="container">
        <form action="Query/Q1.php">
            <h4>Query 1</h4>
            <p>Ricerca di un libro inserendo il titolo (anche parziale) - nel caso in cui nessun parametro venga specificato deve essere presentata la lista completa dei libri:</p>
            <input type="submit" class="submit" value="Esegui la ricerca" />
        </form>
    </div>
    <!-- seconda query-->
    <div class="container">
        <form action="Query/Q2.php">
            <h4>Query 2</h4>
            <p>Visualizzazione di tutti i libri di un determinato autore, eventualmente suddivisi per anno di pubblicazione:</p>
            <input type="submit" class="submit" value="Visualizza" />
        </form>
    </div>
    <!-- terza query-->
    <div class="container">
        <form action="Query/Q3.php">
            <h4>Query 3</h4>
            <p>Ricerca degli autori inserendo uno o più parametri (anche parziali), in forma libera o eventualmente guidata (per esempio menù a tendina con i soli valori possibili):</p>
            <input type="submit" class="submit" value="Esegui la ricerca" />

        </form>
    </div>
    <!-- quarta query-->
    <div class="container">
        <form action="Query/Q4.php">
            <h4>Query 4</h4>
            <p>Consultare elenco degli utenti della biblioteca (con le informazioni principali):</p>
            <input type="submit" class="submit" value="Mostra elenco" />

        </form>
    </div>
    <!-- quinta query-->
    <div class="container">
       <form action="Query/Q5.php">
           <h4>Query 5</h4>
            <p>Ricerca di un utente della biblioteca e il suo storico dei prestiti (compresi quelli in corso):</p>
            <input type="submit" class="submit" value="Esegui la ricerca" />
        </form>
    </div>
    <!-- sesta query-->
    <div class="container">
        <form action="Q6.php" method="POST">
            <h4>Query 6</h4>
            <p>Consultare lo storico dei prestiti:</p>
            <input type="submit" class="submit" value="Mostra" />

        </form>
    </div>
    <!-- settima query-->
    <div class="container">
        <form action="Q7.php" method="POST">
            <h4>Query 7</h4>
            <p>Ricerca dei prestiti effettuati in un range di date – nel caso in cui non vengano inserite date deve mostrare i prossimi in scadenza (quelli che scadranno in futuro):</p>
            <input type="submit" class="submit" value="Esegui la ricerca" />
        </form>
    </div>

    <!-- le 3 query statistiche-->
    <br /><h3 class="title">Query statistiche</h3><hr /><br />
    <div class="container">
        <form action="Query/Q8.php" method="POST">
            <h4>Query 8</h4>
            <p>Numero di libri pubblicati in un determinato anno:</p>
            <input type="submit" class="submit" value="Mostra" />

        </form>
    </div>

    <div class="container">
        <form action="Q9.php" method="POST">
            <h4>Query 9</h4>
            <p>Numero di prestiti effettuati in una determinata succursale:</p>
            <input type="submit" class="submit" value="Mostra" />
        </form>
    </div>

    <div class="container">
        <form action="Q10.php" method="POST">
            <h4>Query 10</h4>
            <p>Numero di libri per autore:</p>
            <input type="submit" class="submit" value="Mostra" />
        </form>
    </div>

    <!-- extra query-->
    <br /><h3 class="title">Query extra</h3><hr /><br />
    <div class="container">
        <form action="Queryextra1.html" method="POST">
            <h4>QueryExtra 1</h4>
            <p>Libri più letti per generazione, maschi e femmine:</p>
            <input type="submit" class="submit" value="Mostra" />
        </form>
    </div>

    <?php include 'res/footer.php' ?>
</body>
</html>