<?php

include('config.php');

$sql = "SELECT * FROM usuario";

$res = $conn->query($sql);

if ($res->num_rows > 0) {
    $html = "<table border='1'>";
    while ($row = $res->fetch_object()) {
        $html .= "<tr>";
        $html .= "<td>" . $row->id_usuario . "</td>";
        $html .= "<td>" . $row->nome_usuario . "</td>";
        $html .= "<td>" . $row->email_usuario . "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
} else {
    $html = 'Nenhum dado registrado';
}

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_option('defaultFont', 'sans');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();
?>
