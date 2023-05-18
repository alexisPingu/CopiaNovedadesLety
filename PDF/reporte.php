<?php
require('FPDF/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
// function Header()
// {
//     // // Logo
//     // $this->Image('logo.png',10,8,33);
//     // // Arial bold 15
//     // $this->SetFont('Arial','B',15);
//     // // Movernos a la derecha
//     // $this->Cell(80);
//     // // Título
//     // $this->Cell(30,10,'Title',1,0,'C');
//     // // Salto de línea
//     // $this->Ln(20);
// }

// // Pie de página
// function Footer()
// {
//     // // Posición: a 1,5 cm del final
//     // $this->SetY(-15);
//     // // Arial italic 8
//     // $this->SetFont('Arial','I',8);
//     // // Número de página
//     // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
//}
}
$idPedido=$_GET['idPedido'];
require "../vendor/autoload.php";
$info=new novedadeslety\Pedido;

$cliente=$info->mostrarDatosClientePedido($idPedido);
// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('imgs/logo_novedades.png',10,8,40);
$pdf->SetFont('Times','',18);
$pdf->SetX(85);
$pdf->Cell(39,40,utf8_decode('DETALLE PEDIDO #'.$idPedido),10,1);
$pdf->SetFont('Times','',12);
$pdf->Cell(10,8,utf8_decode('Fecha de realizacion: '.$cliente['Fecha pedido']),10,1);
$pdf->Cell(10,8,utf8_decode('Cliente: '.$cliente['Nombre Cliente']),10,1);
$pdf->Cell(10,8,utf8_decode('Telefono: '.$cliente['Telefono']),10,1);
$pdf->Cell(10,8,utf8_decode('Dirección: '),10,1);
$pdf->SetX(15);
$pdf->Cell(10,2,utf8_decode('Estado: '.$cliente['Estado']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,10,utf8_decode('Localidad: '.$cliente['Municipio']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,2,utf8_decode('C.P: '.$cliente['Codigo Postal']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,10,utf8_decode('Calle: '.$cliente['Calle']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,2,utf8_decode('Número interior: '.$cliente['Numero Interior']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,10,utf8_decode('Número exterior: '.$cliente['Numero Interior']),15,1);
$pdf->SetX(15);
$pdf->Cell(10,2,utf8_decode('Referencia Domiciliaria: '.$cliente['Referencia']),15,1);
$pdf->Ln(10);
// Tabla
$pdf->SetTextColor(255,255, 255);
$pdf->SetFillColor(2, 46, 236);
$pdf->Cell(25,8,'#',1,0,'C',1);
$pdf->Cell(30,8,'Cantidad',1,0,'C',1);
$pdf->Cell(65,8,'Producto',1,0,'C',1);
$pdf->Cell(30,8,'Precio',1,0,'C',1);
$pdf->Cell(40,8,'Subtotal',1,1,'C',1);


$pdf->SetTextColor(0,0,0);

$pedido=new novedadeslety\Pedido;
$detalle=$pedido->mostrarDetallePedido($idPedido);
$cuantos=count($detalle);
$contador=1;
for($i=0;$i<$cuantos;$i++){
    $item=$detalle[$i];
    $pdf->SetX(10);
    $pdf->Cell(25,8,$contador,1,0,'C',0);
    $pdf->Cell(30,8,$item["Cantidad"],1,0,'C',0);
    $pdf->Cell(65,8,utf8_decode($item["Producto"]),1,0,'C',0);
    $pdf->Cell(30,8,"$ ".$item["Precio"],1,0,'C',0);
    $sub=$item["Cantidad"]*$item["Precio"];
    $pdf->Cell(40,8,"$ ".$sub,1,1,'C',0);
    $contador++;
}
$pdf->SetX(130);
$pdf->SetTextColor(255,255, 255);
$pdf->Cell(30,8,"Total:",1,0,'C',1);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,8,"$ ".$cliente["Total pedido"],1,0,'C',0);


   

$pdf->Output();
?>