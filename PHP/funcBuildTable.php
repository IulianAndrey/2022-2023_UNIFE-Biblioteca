<?php
function BuildTable($dataIn)
{
    $HtmlToPrint = '';

    if (is_array($dataIn)) {
        if (!empty($dataIn)) {
            $HtmlToPrint .= "<table border='1'><thead><tr>";
            $fieldNames = array_keys($dataIn[0]);
            foreach ($fieldNames as $fieldName) {
                $HtmlToPrint .= "<th>$fieldName</th>";
            }
            $HtmlToPrint .= "</tr></thead><tbody>";

            foreach ($dataIn as $row) {
                $HtmlToPrint .= "<tr>";
                foreach ($row as $value) {
                    $HtmlToPrint .= "<td>$value</td>";
                }
                $HtmlToPrint .= "</tr>";
            }
            $HtmlToPrint .= "</tbody></table>";
        } else {
            $HtmlToPrint = "Nessun dato disponibile.";
        }
    } elseif ($dataIn instanceof mysqli_result) {
        if ($dataIn->num_rows > 0) {
            $HtmlToPrint .= "<table border='1'><thead><tr>";
            $fieldInfo = $dataIn->fetch_fields();
            foreach ($fieldInfo as $field) {
                $HtmlToPrint .= "<th>{$field->name}</th>";
            }
            $HtmlToPrint .= "</tr></thead><tbody>";

            while ($row = $dataIn->fetch_assoc()) {
                $HtmlToPrint .= "<tr>";
                foreach ($row as $value) {
                    $HtmlToPrint .= "<td>$value</td>";
                }
                $HtmlToPrint .= "</tr>";
            }
            $HtmlToPrint .= "</tbody></table>";
        } else {
            $HtmlToPrint = "Nessun dato disponibile.";
        }
    } else {
        $HtmlToPrint = "Tipo di dati non supportato.";
    }

    return $HtmlToPrint;
}
?>




