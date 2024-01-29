<?php
$parentDir = dirname(__DIR__);
require_once($parentDir . '/PHP/connection_database.php');
require_once($parentDir . '/PHP/funcBuildTable.php');

$query = "
SELECT
matricola   as 'Matricola',
nome_u      as 'Nome',
cognome_u   as 'Cognome',
via_u       as 'Via',
civico_u    as 'Civico',
cap_u       as 'CAP',
citta_u     as 'Città',
telefono_u  as 'Telefono'
FROM Utente";


$result = $conn->query($query);


?>
<!DOCTYPE html>
<html lang="en">
<?php

$pageTile = "Query4";
include($parentDir . '/res/head.php');
?>
<body>
    <?php

    echo "<p>Sono presenti $result->num_rows utenti registrati</p><hr>";

    echo BuildTable($result);

    ?>

    <?php include $parentDir . '/res/footer.php'; ?>
</body>
</html>
