<!DOCTYPE html>
<html lang="it">

<?php

$pageTile = "Upload Data";
require_once('res/head.php');


$parentDir = dirname(__DIR__);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];

        //Check file
        $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
        if ($fileType == "csv") {

            $tempPath = $file["tmp_name"];

            //Insert data into selectedTable
            $selectedTable = isset($_POST['table']) ? $_POST['table'] : null;

            if ($selectedTable) {
                $file = $_FILES["file"]["tmp_name"];
                $file = mysqli_real_escape_string($conn, $file);
                $sql = "LOAD DATA INFILE '$file' INTO TABLE $selectedTable FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES";

                if ($conn->query($sql) !== TRUE) {
                    $output .= "Error: " . $conn->error . "<br>";
                } else {
                    $output .= "Data uploaded successfuly!";
                }
            }
        } else {
            $output .= "Please select a valid table.";
        }

        //$conn->close();
    } else {
        $output .= "Error: Only CSV files are allowed.";
    }
}




?>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Inserimento dati in tabella</h3>
            <div>
                <label for="file">Seleziona il file CSV:</label>
                <input type="file" name="file" accept=".csv" required />
            </div>
            <br />
            <div>
                <label for="table">Seleziona la tabella:</label>
                <select name="table" required>
                    <?php
                    $result = $conn->query("SHOW TABLES");
                    while ($row = $result->fetch_row()) {
                        $tableName = $row[0];
                        echo "<option value=\"$tableName\">$tableName</option>";
                    }
                    ?>
                </select>
            </div>
            <br />
            <div>
                <input type="submit" value="Upload CSV" />
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<hr /><div>Output: <br /> " . $output . "</div>";
        }
        ?>
    </div>
</body>

<?php include 'res/footer.php' ?>

</html>


