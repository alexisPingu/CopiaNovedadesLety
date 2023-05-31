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


   



$ruta='C:\\Users\\alexi\\OneDrive\\Escritorio\\'.$idPedido.'.pdf';
$pdf->Output($ruta,'F');

//require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();
$email->setFrom("L201923150@jilotepec.tecnm.mx", "Novedadeslety");
$email->setSubject("Gracias pro su compra");
$email->addTo($cliente['Correo'], "Example User");
// $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
// Crear una tabla HTML con los detalles de la compra
// [clave] => 7622210546296 [producto] => Funda audifonos   [precio] => 90 [cantidad] => 1
// Crear una tabla HTML con los detalles de la compra
// Agregar el contenido HTML al correo
//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
// Adjunta el archivo PDF
$fileContent = file_get_contents($ruta);
$attachment = new \SendGrid\Mail\Attachment();
$attachment->setContent(base64_encode($fileContent));
$attachment->setType("application/pdf");
$attachment->setFilename("factura.pdf");
$attachment->setDisposition("attachment");
$email->addAttachment($attachment);

$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
   /* print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";*/
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
header("location: ../panel/pedidos/index.php");

?>