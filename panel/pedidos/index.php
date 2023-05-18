<?php
session_start();
if (isset($_SESSION['Usuario']) && isset($_SESSION['Contraseña'])) {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <link rel="shortcut icon" href="../../assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Panel | Pedidos</title>

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

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span data-feather="users"></span>
                  <?php print $_SESSION['Usuario'] ?>
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
              <li class="nav-item ">
                <a class="nav-link active" href="index.php">
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

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pedidos</h1>
          </div>

          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

          <h2>Lista de pedidos</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm align-middle text-center">
              <thead>
                <tr>
                  <th scope="col">Pedido</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Total Pedido</th>
                  <th scope="col">Fecha Pedido</th>
                  <th scope="col">Ver Pedido</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once "../../vendor/autoload.php";
                $pedido = new novedadeslety\Pedido;
                $info_pedido = $pedido->mostrarPedido();
                $cantidad = count($info_pedido);
                if ($cantidad > 0) {
                  $contador = 0;
                  for ($x = 0; $x < $cantidad; $x++) {
                    $contador++;
                    $item = $info_pedido[$x];
                ?>
                    <tr>
                      <td><?php print $item["Numero Pedido"] ?></td>
                      <td><?php print $item["Nombre Cliente"] ?></td>
                      <td><?php print $item["Correo"] ?></td>
                      <td><?php print $item["Total pedido"] ?></td>
                      <td><?php print $item["Fecha Pedido"] ?></td>
                      <td>
                        <a href="ver.php?idPedido=<?php print $item['Numero Pedido'] ?>" class="btn btn-primary">
                          <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eyeglass-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M8 4h-2l-3 10v2.5" />
                              <path d="M16 4h2l3 10v2.5" />
                              <line x1="10" y1="16" x2="14" y2="16" />
                              <circle cx="17.5" cy="16.5" r="3.5" />
                              <circle cx="6.5" cy="16.5" r="3.5" />
                            </svg>
                          </span>
                        </a>
                      </td>

                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr aria-colspan="6">
                    <td>No hay pedidos</td>
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
} else {
  header("location: ../index.php");
}


?>