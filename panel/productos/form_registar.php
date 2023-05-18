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
    <title>Panel | Registrar</title>

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
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../home.php">
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Registrar producto</h1>
        </div>
        <section>
            <form action="../acciones.php" method="POST" enctype="multipart/form-data" class="cont-form">
                <div class="col campos">
                    <label for="exampleFormControlInput1" class="form-label">Código del producto:</label>
                    <input name="clave_producto_r" type="text" class="form-control" maxlength="15" id="exampleFormControlInput1" placeholder="Inserte código" requi>
                </div>
                <div class="col campos">
                    <label for="exampleFormControlInput1" class="form-label">Nombre del producto:</label>
                    <input name="nombre_producto_r" type="text" class="form-control" maxlength="14" id="exampleFormControlInput1" placeholder="Inserte nombre" required>
                </div>
                <div class="mb-3 campos">
                    <label for="formFile" class="form-label">Foto del producto:</label>
                    <input name="foto_producto_r" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3 campos">
                    <label for="exampleFormControlInput1" class="form-label">Decripción del producto:</label>
                    <input name="descripcion_producto_r" type="text" class="form-control" maxlength="255" id="exampleFormControlInput1" placeholder="Inserte descripción" required>
                </div>
                <div class="col-auto campos">
                    <label for="exampleFormControlInput1" class="form-label">Precio del producto:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input name="precio_producto_r" type="text" class="form-control" placeholder="00.00" required>
                    </div>
                </div>
                <div class="col campos">
                    <label for="exampleFormControlInput1" class="form-label">Existencias del producto:</label>
                    <input name="existencias_producto_r" type="number" class="form-control" placeholder="Existencias del producto" required>
                </div>
                <div class="mb-3 campos">
                    <label class="form-label">Marca del producto:</label>
                    <select class="form-select" name="marca_producto_r" required>
                        <option selected>--Seleccione marca--</option>
                        <?php
                        require_once "../../vendor/autoload.php";
                        $marca = new novedadeslety\marca;
                        $info_marca = $marca->mostrarMarca();
                        $cantidad = count($info_marca);

                        for ($x = 0; $x < $cantidad; $x++) {
                            $item = $info_marca[$x];

                        ?>
                            <option value="<?php print $item['ID']; ?>"><?php print $item['MARCA']; ?></option>
                        <?php } ?>
                        

                    </select>
                </div>
                <div class="mb-3 campos">
                    <label for="formFile" class="form-label">Categoria del producto:</label>
                    <select class="form-select" name="categoria_producto_r" aria-label="Default select example">
                        <option selected>--Seleccione categoria--</option>
                        <?php
                        require_once "../../vendor/autoload.php";
                        $categoria = new novedadeslety\categoria;
                        $info_cat = $categoria->mostrarCategoria();
                        $cantidad = count($info_cat);

                        for ($x = 0; $x < $cantidad; $x++) {
                            $item = $info_cat[$x];

                        ?>
                            <option value="<?php print $item['ID']; ?>"><?php print $item['CATEGORIA']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <section class="boton1 campos">
                    <input type="submit" class="btn1 btn btn-primary" value="Registrar" name="accion">
                    <a href="index.php" class="btn1 btn btn-danger">Cancelar</a>
                </section>
            </form>
        </section>
    </main>


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