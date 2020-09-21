<?php
require_once('../vendor/autoload.php');

//plantilla html
require_once('plantillas/reporte/index.php');


$css = file_get_contents('plantillas/reporte/style.css');

require_once('conexion.php');



$mpdf = new \Mpdf\Mpdf([
 "format" => "A4"


]);

$mpdf->SetFooter('{PAGENO}');

$plantilla = getPlantilla($conexion);

$mpdf->writeHtml($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->Output("reporteDadoAlta.pdf", "I");