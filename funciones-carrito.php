<?php
    function agregarProducto($resultado,$clave,$cantidad=1){
    //[usar otro nombre para identificar y no se repita esa variable de sesion]
        $_SESSION['carrito'][$clave]=array(
            'clave'=>$resultado['CLAVE'],
            'producto'=>$resultado['PRODUCTO'],
            'foto'=>$resultado['FOTO'],
            'precio'=>$resultado['PRECIO'],
            'cantidad'=>$cantidad
        );
    }
    function actualizarCantidad($clave,$cantidad=FALSE){
        if($cantidad){
            //Desde el carrito agregas x cantidad de productos
            $_SESSION['carrito'][$clave]['cantidad']=$cantidad;
        }else{
            //Cada vez que agreges desde la pagina principal
            $_SESSION['carrito'][$clave]['cantidad']+=1;
        }
    

    }
    function calcularTotal(){
        $total=0;
        if(isset($_SESSION['carrito'])){
            foreach ($_SESSION['carrito'] as $indice => $value){
                $total+=$value['precio']*$value['cantidad'];
            }
        }
        return $total;
    }
    function cantidadProductos(){
        $cantidad=0;
        if(isset($_SESSION['carrito'])){
            foreach ($_SESSION['carrito'] as $indice => $value){
                $cantidad++;
            }
        }
        return $cantidad;
    }

?>