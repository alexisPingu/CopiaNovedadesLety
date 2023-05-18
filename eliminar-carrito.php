<?php
// Eliminar el producto del carrito
session_start();

//Si no existe ninguna clave entonces mandalos a carrito
if(!isset($_GET['clave'])){
    header("location: carrito.php");
}
$clave=$_GET['clave'];
if(isset($_SESSION['carrito'])){
    //unset para eliminar una parte especifica de
    // la variable de sesion o una variable de sesion
    unset($_SESSION['carrito'][$clave]);
    header("location: carrito.php");
}else{
    header("location: index.php");
}
?>