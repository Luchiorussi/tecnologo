<?php 
	require 'fpdf/fpdf.php';
	class PDF extends FPDF
	{
		function Header()
		{
		$this->Image('Cargas/Usuarios/fondo.png', 5, 5, 30 );
		$this->SetFont('Arial','B',12);
		$this->Cell(30);
		$this->Cell(120,10, 'Reporte De Estados',0,0,'C');
		$this->Ln(30);
		}

		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
		
	}
 ?>