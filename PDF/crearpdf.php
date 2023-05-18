<?php
session_start();
    require "../vendor/autoload.php";
    $info_cliente=new novedadeslety\Pedido;
    $valoreC=$info_cliente->mostrarDatosClientePedido($_GET['idPedido']);

    require('FPDF/fpdf.php');
    // $num = '#';
    // Creacion del Objeto
    $pdf=new FPDF('P', 'mm', 'A4');
    // Añade una nueva pagina al documento
    $pdf->AddPage();

    // Escogemos fuente, en negrita y tamaño 16
    $pdf->SetFont('Arial','B',18);
    // Una celda es una superficie rectangular, con borde si se quiere, que contiene texto.
    // Se imprime en la posicion actual
    // Especificamos sus dimensiones.
    $pdf->Cell(1, 30,'Detalle Pedido! ' . $valoreC['Pedido']);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(100, 60, 'Cliente: '.$valoreC['Nombre Cliente']);
    $pdf->Cell(-100, 60, 'Fecha: '.$valoreC['Fecha pedido']);
    $pdf->Cell(100, 90, 'C.P: '.$valoreC['Codigo Postal']);
    $pdf->Cell(-100, 90, 'Calle: '.$valoreC['Calle']);
    $pdf->Cell(100, 120, 'Numero Interior: '.$valoreC['Numero Interior']);
    $pdf->Cell(-100, 120, 'Numero Exterior: '.$valoreC['Numero Exterior']);
    $pdf->Cell(100, 150, 'Localidad: '.$valoreC['Municipio']);
    $pdf->Cell(-100, 150, 'Estado: '.$valoreC['Estado']);
    $pdf->Cell(100, 180, 'Telefono: '.$valoreC['Telefono']);
    $pdf->Cell(-100, 180, 'Referencia: '.$valoreC['Referencia']);
    //$pdf->Cell(200, 60, 'Fecha');
    //$pdf -> Cell(60, 50, 'Hecho con FPDF');
    //$pdf->Output('reporte.pdf', 'D');
    
    // Titulo de columnas
    $columnas = array('#', 'Cantidad', 'Producto', 'Precio', 'Subtotal');
    // Anchura de las columnas
    // Cabecera
    $w = array(30, 200);
    // Posicionas eje X y Y
    $pdf->SetXY(30,120);
    for($i=0; $i<count($columnas); $i++){
        $pdf->Cell($w[0], 7, $columnas[$i], 1, 0, 'C');
    }
    $pdf->Ln();
    
    $valoreD=$info_cliente->mostrarDetallePedido($_GET['idPedido']);
    $cantidad = count($valoreD);
    if ($cantidad > 0) {
        $contador = 0;
        for ($x = 0; $x < $cantidad; $x++) {
            $contador++;
            $item = $valoreD[$x];
            $pdf->SetX(30);
            $pdf->Cell($w[0], 7, $contado,  1, 0, 'C');
            $pdf->Cell($w[0], $item['Cantidad'], 1, 1, 0, 'C');
            $pdf->Cell($w[0], $item['Producto'], 2, 1, 0, 'C');
            $pdf->Cell($w[0], $item['Precio'], 3, 1, 0, 'C');
            $pdf->Cell($w[0], $item['Precio']*$item['Cantidad'], 4, 1, 0, 'C');
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    $pdf->SetX(30);
    $pdf->Cell($w[0], 7, 'Total:');
    $pdf->Cell($w[0], 7, $valoreC['Total pedido'], 1);

    // Muestra PDF
    $pdf->Output();
?>