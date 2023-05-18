<?php
session_start();
require "funciones-carrito.php";
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
    <title>Novedades Lety | Home</title>
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

                        <a href="carrito.php" class="separador">
                            <button type="button" class="btn btn-primary">
                                <img src="assets/imgs/carrito.png" width="38" height="38">
                                <span class="badge bg-secondary"><?php print cantidadProductos(); ?>
                                </span>
                            </button>
                        </a>
                        <?php
                        if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
                        ?>
                            <a href="cerrar_sesion.php" class="separador">
                                <button type="button" class="btn btn-primary">
                                    <img src="assets/imgs/cerrar.png" width="38" height="38">
                                </button>
                            </a>
                            <a href="cliente/actualiza_datos.php" class="separador">
                                <button type="button" class="btn btn-primary">
                                    <img src="assets/imgs/configuracion.png" width="38" height="38">
                                </button>
                            </a>
                        <?php } else { ?>
                            <a href="sesion/inicio_sesion.php" class="separador">
                                <button type="button" class="btn btn-primary">
                                    <img src="assets/imgs/usuario.png" width="38" height="38">
                                    </span>
                                </button>
                            </a>
                            <a href="panel/index.php" class="separador">
                                <button type="button" class="btn btn-primary">
                                    <img src="assets/imgs/registro.png" width="38" height="38">
                                    </span>
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
            $productos = new novedadeslety\Productos;
            $info_productos = $productos->mostrarProductosVender();
            $cantidad = count($info_productos);
            if ($cantidad > 0) {
                for ($x = 0; $x < $cantidad; $x++) {
                    $item = $info_productos[$x];
            ?>
                    <br><br>
                    <article class="col-12 col-md-3 ">
                        <div class="row row-cols-1 row-cols-md-1 g-4">
                            <div class="col">
                                <div class="card text-center">

                                    <div class="card-header">
                                        <h4 class="text-center titulo-producto"><?php print $item['PRODUCTO'] ?></h4>
                                    </div>
                                    <?php
                                    $foto = 'upload/' . $item["FOTO"];
                                    if (file_exists($foto) && $foto!='upload/') {
                                    ?>
                                        <img src="<?php print $foto; ?>" class="img-responsive">
                                    <?php } else { ?>
                                        <img src="upload/SIN_FOTO.png" class="img-responsive">
                                    <?php } ?>
                                    <div class="card-body">
                                        <h4 class="card-text">Precio: $<?php print $item['PRECIO']; ?></h4>

                                    </div>
                                    <div class="card-footer">

                                        <a href="carrito.php?clave=<?php print $item['CLAVE']; ?>" class="btn btn-primary boton">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="6" cy="19" r="2" />
                                                <circle cx="17" cy="19" r="2" />
                                                <path d="M17 17h-11v-14h-2" />
                                                <path d="M6 5l14 1l-1 7h-13" />
                                            </svg>
                                            Comprar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </article>
                <?php }
            } else { ?>
                <h4>No hay registros</h4>
            <?php } ?>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>