<?php
include "../../conexion/Conexion.php";

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
    <title>Panel | Marcas</title>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <li class="nav-item ">
                            <a class="nav-link active" href="../categorias/index.php">
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
            <h1 class="h2">Categorias</h1>
        </div>
        <?php
        if (isset($_POST['categoria'])) {
            $query = "CALL INSERTAR_CATEGORIA('" . $_POST['categoria'] . "')";
            $ejecutar = mysqli_query($link, $query);
            if ($resultados = mysqli_fetch_assoc($ejecutar)) {
        ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong><?php print $resultados['MENSAJE'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php
                
            }
        }
        ?>

        <form action="index.php" method="POST" class="cont-form">
            <div class="col campos">
                <label for="exampleFormControlInput1" class="form-label">Categoria</label>
                <input name="categoria" type="text" class="form-control" maxlength="255" id="exampleFormControlInput1">
            </div>
            <br><br>
            <section>
                <input type="submit" class="btn1 btn btn-primary" name="accion" value="Registrar categoria">
            </section>
        </form>

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