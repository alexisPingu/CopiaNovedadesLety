<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <link rel="shortcut icon" href="assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Novedades Lety | Finalizar</title>
</head>

<body>
<header>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark shadow-sm">
            <div class="container">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <img src="assets/imgs/logo_novedades.png" height="100px" width="100px">
                    <strong>Novedades Lety</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="https://api.whatsapp.com/send?phone=+525576401059&text=Hola, Nececito mas informacion!">Contactanos</a>
                        </li>
                    </ul>
    
                    <section class="separador_Arriba">
                        <?php 
                        if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
                        ?>
                            <a href="cerrar_sesion.php" class="separador">
                            <button type="button" class="btn btn-primary">
                                <img src="assets/imgs/cerrar.png" width="38" height="38">
                            </button>
                        </a>
                        <?php } ?>
                       
                    </section>

                </div>
            </div>
        </nav>
    </header>
    <br>
    <main class="container">
        <section class="row">
            <?php
            require_once "vendor/autoload.php";
            if (isset($_SESSION['usuario']) && !empty($_SESSION['carrito'])) {
                $pedido = new novedadeslety\Pedido;

                $id = $_SESSION['id_usuario'];
                $total = $_SESSION['total'];
                //print_r($_SESSION) ;
                $idPedido = $pedido->registrarPedido($id, $total);
                // print $idPedido['ID'];
                foreach ($_SESSION['carrito'] as $indice => $value) {
                    $clave = $value['clave'];
                    $precio = $value['precio'];
                    $cantidad = $value['cantidad'];
                    $pedido->registrarDetalle($idPedido['ID'],$clave,$precio,$cantidad);
                }
                // Limpiar el carrito
                $_SESSION['carrito'] = array();
            }else{
                header("location: index.php");
            }
            ?>
            <div class="alert alert-success" role="alert">
                Gracias por hacer tu pedido en breve nos comunicaremos contigo !
                <a href="index.php">Seguir navegando</a>
            </div>
        </section>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>