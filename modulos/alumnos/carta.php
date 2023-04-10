<?php
require("../../libs/fpdf/fpdf.php");
include("../../bd.php");

class PDF extends FPDF
{
//Aquí va el código para la carta en PDF
}

// Consulta a la base de datos
$registro = $conn->prepare("SELECT * FROM tbl_alumnos WHERE id = :id");
$registro->bindParam(':id', $_GET['id']);
$registro->execute();

//Obtener los datos del alumno
$nombres = $registro->fetch(PDO::FETCH_ASSOC);

//Crear objeto PDF
$pdf = new PDF();
$pdf->AddPage();

//Aquí va el contenido de la carta en PDF
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Carta para los representantes de '.$nombres['nombres']);

//Descargar la carta en PDF
$pdf->Output('nombres', 'carta.pdf');
?>