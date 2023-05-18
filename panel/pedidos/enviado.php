<?php 
if(isset($_GET['idPedido']) && !empty($_GET['idPedido'])){
    require "../../vendor/autoload.php";
    $idPedido=$_GET['idPedido'];
    $pedido= new novedadeslety\Pedido;
    $pedido->enviarPedido($idPedido);
    header("location: index.php");
}else{
    header("location: index.php");
}


?>