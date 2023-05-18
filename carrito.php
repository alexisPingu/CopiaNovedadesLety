<?php
// Activar sesiones
session_start();
//print $_SESSION['usuario']; comprobar si esta el usuario
if ($_SESSION['usuario'] != null && isset($_SESSION['usuario'])) {
    //Agregar el archivo de las funcioens del carrito
    require_once("funciones-carrito.php");

    if (isset($_GET['clave'])) {
        $clave = $_GET['clave'];
        require_once "vendor/autoload.php";
        $productos = new novedadeslety\Productos;
        $resultado = $productos->mostrarProductosPorID($clave);
        //Tratar de cambiar la clave de la url
        if (!$resultado) {
            header("Location: index.php");
        }
        // Si existe o no el carrito
        if (isset($_SESSION['carrito'])) {
            // Verificar si existe el producto en el carrito
            if (array_key_exists($clave, $_SESSION['carrito'])) {
                actualizarCantidad($clave);
            } else {
                agregarProducto($resultado, $clave);
            }
        } else {
            agregarProducto($resultado, $clave);
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="shortcut icon" href="assets/imgs/logo_novedades.png" type="image/x-icon">
        <title>Novedades Lety | Carrito</title>
        <link rel="stylesheet" href="assets/css/estilo.css">
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
                            <a href="#" class="separador">
                                <button type="button" class="btn btn-primary">
                                    <img src="assets/imgs/carrito.png" width="38" height="38">
                                    <!-- Colocamos la cantidad de productos contando el producto solo una vez -->
                                    <span class="badge bg-secondary"><?php print cantidadProductos(); ?></span>
                                </button>
                            </a>
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
                        </section>
                    </div>
                </div>
            </nav>
        </header>
        <br>
        <div class="container" id="main">
            <div class="table-responsive">
                <table class="table table-hover table-sm ">
                    <thead>
                        <tr>
                            <!-- <th class="text-center" scope="col">CLAVE</th> -->
                            <th class="text-center" scope="col">PRODUCTO</th>
                            <th class="text-center" scope="col">FOTO</th>
                            <th class="text-center" scope="col">PRECIO</th>
                            <th class="text-center" scope="col">CANTIDAD</th>
                            <th class="text-center" scope="col">SUBTOTAL</th>
                            <th class="text-center" scope="col"></th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                            $_SESSION['total']=calcularTotal();
                            $total = 0;
                            foreach ($_SESSION['carrito'] as $indice => $value) {
                                $total = $value['precio'] * $value['cantidad'];
                        ?>
                                <tr>
                                    <form action="actualizar-carrito.php" method="POST">
                                        <td class="text-center"><?php print $value['producto'] ?></td>
                                        <td class="text-center">
                                            <?php
                                            $foto = 'upload/' . $value["foto"];
                                            if (file_exists($foto) && $foto!='upload/') {
                                            ?>
                                                <img src="<?php print $foto; ?>" width="35">
                                            <?php } else { ?>
                                                <img src="upload/SIN_FOTO.png" width="35">
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">$<?php print " ".$value['precio'] ?></td>
                                        <td class="text-center">
                                            <input type="hidden" name="id" value="<?php print $value['clave'] ?>">
                                            <input type="number" name="cantidad" class="text-center" value="<?php print $value['cantidad'] ?>" width="50px">
                                        </td>
                                        <td class="text-center">
                                            $<?php print " ".$total ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-success btn-xs">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>
                                        <td class="texte-center">
                                            <a href="eliminar-carrito.php?clave=<?php print $value['clave'] ?>" class="btn btn-danger btn-xs">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <circle cx="12" cy="12" r="9" />
                                                        <line x1="9" y1="12" x2="15" y2="12" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </form>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8">Ho hay productos en el carrito</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">Total:</td>
                            <td colspan="6"><?php print "$ " . calcularTotal(); ?></td>
                        </tr>

                        <tr>
                            <td colspan="5">
                                <a href="index.php" class="btn btn-info finalizar">Seguir Comprando</a>
                            </td>
                            <?php
                            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                            ?>
                                <td colspan="3">
                                    <a href="completar_pedido.php" class="btn btn-success finalizar">Finalizar compra</a>
                                </td>
                            <?php } ?>
                        </tr>


                    </tfoot>
                </table>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header("location: sesion/inicio_sesion.php");
}
?>