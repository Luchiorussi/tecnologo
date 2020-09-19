<?php
include 'plantillaPDF.php';
require 'conexionPDF.php';

$query = "SELECT m.NombreMobiliario as mobiliario, m.CodigoMobiliario as codigo, a.NombreAula as aula, e.NombreEstadoMobiliario as estado  FROM mobiliarioaula m INNER JOIN aula as a ON a.id = m.id INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario WHERE e.NombreEstadoMobiliario like'Regular'
    	ORDER BY m.NombreMobiliario";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(55, 8, 'Mobiliario', 1, 0, 'C', 1);
$pdf->Cell(40, 8, 'Codigo', 1, 0, 'C', 1);
$pdf->Cell(55, 8, 'Aula', 1, 0, 'C', 1);
$pdf->Cell(40, 8, 'Estado Mobiliario', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->MultiCell(55, 6, utf8_decode($row['mobiliario']), 1, 'C', 0);
    $pdf->MultiCell(40, 6, utf8_decode($row['codigo']), 1, 'C', 0);
    $pdf->MultiCell(55, 6, utf8_decode($row['aula']), 1, 'C', 0);
    $pdf->MultiCell(40, 6, utf8_decode($row['estado']), 1, 'C', 0);
}

$pdf->Output();
