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
    <link rel="stylesheet" href="../../assets/css/productos.css">
    <link rel="shortcut icon" href="../../assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Panel | Productos</title>

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
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">
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

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span data-feather="users"></span>
                                <?php print $_SESSION['Usuario']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../index.php">Salir</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Productos</h1>
        </div>

        <section class="container" id="main">

            <a href="form_registar.php" class="btn btn-primary">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </span>
                Nuevo
            </a>
        </section>
        <section>
            <fieldset>
                <legend>
                    <h2>Listado de productos</h2>
                    <hr>
                </legend>
            </fieldset>
        </section>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CLAVE</th>
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">DESCRIPCION</th>
                        <th scope="col">FOTO</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">EXISTENCIAS</th>
                        <th scope="col">CATEGORIA</th>
                        <th scope="col">MARCA</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "../../vendor/autoload.php";
                    $producto = new novedadeslety\Productos;
                    $info_producto = $producto->mostrarProductos();
                    $cantidad = count($info_producto);
                    if ($cantidad > 0) {
                        $contador = 0;
                        for ($x = 0; $x < $cantidad; $x++) {
                            $contador++;
                            $item = $info_producto[$x];
                    ?>
                            <tr>
                                <td><?php print $contador ?></td>
                                <td><?php print $item["CLAVE"] ?></td>
                                <td><?php print $item["PRODUCTO"] ?></td>
                                <td><?php print $item["DESCRIPCION"] ?></td>

                                <td class="text-center">
                                    <?php
                                    $foto = '../../upload/' . $item["FOTO"];
                                    if (file_exists($foto) && $foto!='../../upload/') {
                                    ?>
                                        <img src="<?php print $foto; ?>" width="50">
                                    <?php } else {
                                     $foto = '../../upload/SIN_FOTO.PNG';
                                    ?>
                                       
                                        <img src="<?php print $foto; ?>" width="50">
                                    <?php } ?>
                                </td>
                                <td><?php print $item["PRECIO"] ?></td>
                                <td><?php print $item["EXISTENCIAS"] ?></td>
                                <td><?php print $item["CATEGORIA"] ?></td>
                                <td><?php print $item["MARCA"] ?></td>
                                <td class="text-center">
                                    <section class="botones">
                                        <a href="../productos/form_actualizar.php?CLAVE=<?php print $item['CLAVE']; ?>" class="btn btn-primary">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                </svg>
                                            </span>
                                        </a>
                                        <a href="../acciones.php?CLAVE=<?php print $item['CLAVE']; ?>" class="btn btn-danger">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </span>
                                        </a>
                                    </section>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {


                        ?>
                        <tr aria-colspan="6">
                            <td>No hay registros</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    </div>
    </div>


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