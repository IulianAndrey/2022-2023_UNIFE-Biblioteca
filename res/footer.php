<footer>
    <p>progetto Basi Dati 2022-2023 realizzato da Giorgia Pirelli e Iulian Andrei Halapet</p>
    <div style="text-align: center;">
        <img src="/res/logo_unife_footer.png" width="70px" />
    </div>
</footer>
<?php
//Chiusura connessione, !!!DEVE ESSERE ABBINATO ALLA CONN. CHE CONTIENE LA VAR. CON LO STESSO NOME!!!
$conn->close();
$outputInfo[] = "Chiussura connessione!"
?>
<script>
    //creo variabile js contenente il contenuto della vriabile php per poterla stampare
    //LA VAR.  $outputInfo DEVE ESSERE SEMPRE UGUALE IN TUTTE LE PAGINE PER POTERLA USARE
    var dataArray = <?php echo json_encode($outputInfo); ?>;

    //Stampo contenuto array ciclando su ogni
    for (var key in dataArray) {
        if (dataArray.hasOwnProperty(key)) {
            console.log(key + ': ' + dataArray[key]);
        }
    }
</script>