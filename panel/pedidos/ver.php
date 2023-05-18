<?php 
session_start();
if(isset($_SESSION['Usuario']) && isset($_SESSION['Contraseña'])){

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/detalle.css">
    <link rel="shortcut icon" href="../../assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Panel | Detalle Pedido</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">


    <!-- Bootstrap core CSS -->
    <link href="../../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../../assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../productos/index.php">
            Novedades Lety | Panel
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">

                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span data-feather="users"></span>
                                <?php print $_SESSION['Usuario']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../index.php">Salir</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../productos/index.php">
                                <span data-feather="shopping-cart"></span>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pedidos/index.php">
                                <span data-feather="file"></span>
                                Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../marcas/index.php">
                                <span data-feather="book"></span>
                                Marcas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../categorias/index.php">
                                <span data-feather="book"></span>
                                Categorias
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 registrar">
    <?php
                    require_once "../../vendor/autoload.php";
                    $idPedido=$_GET['idPedido'];
                    $pedido=new novedadeslety\Pedido;
                    $info_cliente=$pedido->mostrarDatosClientePedido($idPedido);
                    $info_detalle=$pedido->mostrarDetallePedido($idPedido);


                ?>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detalle Pedido #<?php print $info_cliente['Pedido']?></h1>
        </div>
        <section>
       
            <form action="#" method="POST" class="cont-form">
                <div class="col campos">
                    <label class="form-label">Cliente:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Nombre Cliente']?>" readonly>
                </div>
                <div class="col campos">
                    <label class="form-label">Fecha:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Fecha pedido']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label class="form-label">C.P:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Codigo Postal']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label class="form-label">Calle:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Calle']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label class="form-label">Numero Interior:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Numero Interior']?>" readonly>
                </div>
                <div class="col campos">
                    <label class="form-label">Numero Exterior:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Numero Exterior']?>" readonly>
                </div>
                <div class="col campos">
                    <label class="form-label">Municipio:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Municipio']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label for="formFile" class="form-label">Telefono:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Telefono']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label for="formFile" class="form-label">Referencias:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Referencia']?>" readonly>
                </div>
                <div class="mb-3 campos">
                    <label for="formFile" class="form-label">Estado:</label>
                    <input type="text" class="form-control" value="<?php print $info_cliente['Estado']?>" readonly>
                </div>

            </form>
        </section>
        <div class="table-responsive">
            <table class="table table-striped table-sm align-middle text-center">
              <thead>
                <tr><th scope="col">#</th>
                <th scope="col">Cantidad</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Subtotal</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $info_pedido = $pedido->mostrarDetallePedido($idPedido);
                $cantidad = count($info_pedido);
                if ($cantidad > 0) {
                  $contador = 0;
                  for ($x = 0; $x < $cantidad; $x++) {
                    $contador++;
                    $item = $info_pedido[$x];
                    $total=$item['Cantidad']*$item['Precio'];
                ?>
                    <tr>
                    <td><?php print $contador ?></td>
                        <td><?php print $item["Cantidad"] ?></td>
                      <td><?php print $item["Producto"] ?></td>
                      <td class="text-center">
                                    <?php
                                    $foto = '../../upload/' . $item["Foto"];
                                    if (file_exists($foto) && $foto!="../../upload/") {
                                    ?>
                                        <img src="<?php print $foto; ?>" width="50">
                                    <?php } else { ?>
                                        <img src="../../upload/SIN_FOTO.png" width="50">
                                    <?php } ?>
                                </td>
                      <td><?php print "$ ".$item["Precio"] ?></td>
                      <td><?php print "$ ".$total ?></td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr aria-colspan="4">
                    <td>No hay productos</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                  <tr>
                            <td colspan="3">Total:</td>
                            <td colspan="3"><?php print "$ ".$info_cliente["Total pedido"]; ?></td>
                  </tr>
                  <tr>
                            <td colspan="2">
                                <a href="index.php" class="btn btn-info">Cancelar</a>
                            </td>
                                <td colspan="2">
                                <a href="../../PDF/reporte.php?idPedido=<?php print $info_cliente['Pedido'] ?>" class="btn btn-danger">Imprimir</a>
                                    
                                </td>
                                <td colspan="2" class="hidden-print">
                                    <a href="enviado.php?idPedido=<?php print $info_cliente['Pedido'] ?>"  class="btn btn-success ">Enviado</a>
                                </td>
                        </tr>
              </tfoot>
            </table>
          </div>
    </main>

                <script src="../js/imprimir.js"></script>
    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>
<?php
}else{
  header("location: ../index.php");
}


?>