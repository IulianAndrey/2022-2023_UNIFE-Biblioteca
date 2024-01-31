<?php
//Definisco il path del parent della cartella attuale
$parentDir = dirname(__DIR__);
/**Richiamo file con connessione**/
require_once($parentDir . '/PHP/connection_database.php');
/**Richiamo file con funzione che costruisce la tabella dati**/
require_once($parentDir . '/PHP/funcBuildTable.php');
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/res/style.css" />
    <link rel="shortcut icon" href="/res/logo_unife.png" type="image/png" />
    <title><?php echo $pageTile ?></title>
</head>