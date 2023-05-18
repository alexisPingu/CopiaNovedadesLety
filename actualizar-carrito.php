<?php
// print '<pre>';
// print_r($_POST);
session_start();
if ($_SESSION['usuario'] != null && isset($_SESSION['usuario'])) {
if($_SERVER['REQUEST_METHOD']==='POST'){
    require "funciones-carrito.php";
    $clave=$_POST['id'];
    $candtidad=$_POST['cantidad'];
    // print_r($_POST);
    if(is_numeric($candtidad)){
        if (array_key_exists($clave, $_SESSION['carrito'])) {
            actualizarCantidad($clave,$candtidad);
        }
    }
    header("location: carrito.php");
}
}else{
    header("location: sesion/inicio_sesion.php");
}
?>