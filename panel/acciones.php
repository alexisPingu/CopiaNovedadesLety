<?php
require_once "../vendor/autoload.php";
$productos=new novedadeslety\Productos;
// Solo se ejecute cuando la infomacion se envie por post
if($_SERVER['REQUEST_METHOD']==='POST'){
    if($_POST['accion']==='Registrar'){

        if(empty($_POST['clave_producto_r'])) 
            exit('Completar clave');

        if(empty($_POST['nombre_producto_r'])) 
            exit('Completar nombre');
        
        if(empty($_POST['descripcion_producto_r'])) 
            exit('Completar descripcion');
        
        if(empty($_POST['precio_producto_r'])) 
            exit('Añade un precio');
        
        if(empty($_POST['existencias_producto_r'])) 
             exit('Añade existencias');

        if(empty($_POST['marca_producto_r'])) 
            exit('Seleccionar marca');

        if(!is_numeric($_POST['marca_producto_r'])) 
            exit('Seleccionar marca valida');

        if(empty($_POST['categoria_producto_r'])) 
            exit('Seleccionar categoria');

        if(!is_numeric($_POST['categoria_producto_r'])) 
            exit('Seleccionar categoria valida');

        $clave=$_POST['clave_producto_r'];
        $nombre=$_POST['nombre_producto_r'];
        $descripcion=$_POST['descripcion_producto_r'];
        $foto=subirFoto();
        $precio=$_POST['precio_producto_r'];
        $existencias=$_POST['existencias_producto_r'];
        $idCategoria=$_POST['categoria_producto_r'];
        $idMarca=$_POST['marca_producto_r'];

        $respuesta=$productos->registrarProducto($clave,$nombre,$descripcion,$foto,$precio,$existencias,$idCategoria,$idMarca);
        header('Location: productos/index.php');

    }
    if($_POST['accion']==='Actualizar'){

        
        if(empty($_POST['clave_producto_a'])) 
            exit('Completar clave');

        if(empty($_POST['nombre_producto_a'])) 
            exit('Completar nombre');
        
        if(empty($_POST['descripcion_producto_a'])) 
            exit('Completar descripcion');
        
        if(empty($_POST['precio_producto_a'])) 
            exit('Añade un precio');
        
        if(empty($_POST['existencias_producto_a'])) 
             exit('Añade existencias');

        if(empty($_POST['marca_producto_a'])) 
            exit('Seleccionar marca');

        if(!is_numeric($_POST['marca_producto_a'])) 
            exit('Seleccionar marca valida');

        if(empty($_POST['categoria_producto_a'])) 
            exit('Seleccionar categoria');

        if(!is_numeric($_POST['categoria_producto_a'])) 
            exit('Seleccionar categoria valida');

        $clave=$_POST['clave_producto_a'];
        $nombre=$_POST['nombre_producto_a'];
        $descripcion=$_POST['descripcion_producto_a'];
        $precio=$_POST['precio_producto_a'];
        $existencias=$_POST['existencias_producto_a'];
        $idCategoria=$_POST['categoria_producto_a'];
        $idMarca=$_POST['marca_producto_a'];

        if(!empty($_POST['foto_temp'])){
            $foto=$_POST['foto_temp'];
        }
        if(!empty($_FILES['foto_producto_r']['name'])){
            $foto=subirFoto();
        }

        $respuesta=$productos->actualizarProducto($clave,$nombre,$descripcion,$foto,$precio,$existencias,$idCategoria,$idMarca);
        header('Location: productos/index.php');

    }

}
if($_SERVER['REQUEST_METHOD']==='GET'){
    $clave=$_GET['CLAVE'];
    $respuesta=$productos->eliminarProducto($clave);
    header('Location: productos/index.php');
}

function subirFoto(){
    $carpeta=__DIR__.'/../upload/';
    $archivo=$carpeta.$_FILES['foto_producto_r']['name']; 
    move_uploaded_file($_FILES['foto_producto_r']['tmp_name'],$archivo);
    return $_FILES['foto_producto_r']['name'];
}
