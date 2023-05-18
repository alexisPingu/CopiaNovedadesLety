<?php session_start();
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
    require "../conexion/Conexion.php";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/estilo.css">
        <link rel="shortcut icon" href="../assets/imgs/logo_novedades.png" type="image/x-icon">
        <title>Novedades Lety | Configuracion</title>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="../assets/css/registro.css">
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark navbar-expand-lg bg-dark shadow-sm">
                <div class="container">
                    <a href="../index.php" class="navbar-brand d-flex align-items-center">
                        <img src="../assets/imgs/logo_novedades.png" height="100px" width="100px">
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
                    </div>
                </div>
            </nav>
        </header>

        <?php
        if (!empty($_POST)) {
            $idCliente = $_SESSION['id_usuario'];
            $nombre = $_POST['NOMBRE_CLIENTE'];
            $apellidos = $_POST['APELLIDOS_CLIENTES'];
            $cp = $_POST['CP_CLIENTE'];
            $calle = $_POST['CALLE_CLIENTE'];
            $numi = $_POST['NUM_I'];
            $nume = $_POST['NUM_E'];
            $localidad = $_POST['MUNICIPIO_CLIENTE'];
            $estado = $_POST['ESTADO_CLIENTE'];
            $referencia = $_POST['REFERENCIA_CLIENTE'];
            $usuario = $_POST['NOMBRE_USUARIO'];
            $contraseña = $_POST['PASWWORD_CLIENTE'];
            $correo = $_POST['CORREO_CLIENTE'];
            $telefono = $_POST['TELEFONO_CLIENTE'];

            $mC = "CALL modificar_correo($idCliente,
                '$nombre',
                '$apellidos',
                '$cp',
                '$calle',
                '$numi',
                '$nume',
                '$localidad',
                $estado,
                '$referencia',
                '$usuario',
                '$contraseña',
                '$correo',
                '$telefono')";
                $ejecutarmC = mysqli_query($link, $mC);
                if ($resultadosmC = mysqli_fetch_assoc($ejecutarmC)) {
                    if ($resultadosmC["MENSAJE"] != "") {
                        echo "
                        <div class='alert alert-warning alert-dismissible fade show main' role='alert'>
                            <strong>" . $resultadosmC["MENSAJE"] . "</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                }
            mysqli_close($link);
            require "../conexion/Conexion.php";
            $mU = "CALL modificar_usuario($idCliente,
                '$nombre',
                '$apellidos',
                '$cp',
                '$calle',
                '$numi',
                '$nume',
                '$localidad',
                $estado,
                '$referencia',
                '$usuario',
                '$contraseña',
                '$correo',
                '$telefono')";


            $ejecutarmU = mysqli_query($link, $mU);
            if ($resultadosmU = mysqli_fetch_assoc($ejecutarmU)) {
                if ($resultadosmU["MENSAJE"] != "") {
                    echo "
                        <div class='alert alert-warning alert-dismissible fade show main' role='alert'>
                            <strong>" . $resultadosmU["MENSAJE"] . "</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }else{
                    $_SESSION['usuario'] = $usuario;
                }
            }
        }    
        ?>


        <section class="contenedor">
            <main class="main">
                <?php
                require "../conexion/Conexion.php";
                $INFO = "SELECT * FROM cliente_tienda_regalo WHERE cliente_tienda_regalo.ID_CLIENTE='" . $_SESSION['id_usuario'] . "'";
                $ejecutar = mysqli_query($link, $INFO);
                $resultados = mysqli_fetch_array($ejecutar);
                ?>
                <form action="actualiza_datos.php" method="POST">
                    <h1>Actualizar datos</h1>
                    <p>* Datos obligatorios</p>
                    <hr>
                    <section class="contenedor-grid">
                        <div class="mb-2 elementos">
                            <label class="form-label">Nombre: *</label>
                            <input type="text" class="form-control" name="NOMBRE_CLIENTE" placeholder="Nombre de pila" value="<?php print $resultados[1] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Apellidos: *</label>
                            <input type="text" class="form-control" name="APELLIDOS_CLIENTES" placeholder="Ingrese Apellidos" value="<?php print $resultados[2] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">C.P: *</label>
                            <input type="text" class="form-control" name="CP_CLIENTE" maxlength="10" placeholder="Ingrese Codigo Postal" value="<?php print $resultados[3] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Calle: *</label>
                            <input type="text" class="form-control" name="CALLE_CLIENTE" placeholder="Ingrese Calle" value="<?php print $resultados[4] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Numero Interior:</label>
                            <input type="text" class="form-control" name="NUM_I" maxlength="10" placeholder="Ingrese Numero Interior" value="<?php print $resultados[5] ?>">
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Numero exterior:</label>
                            <input type="text" class="form-control" name="NUM_E" maxlength="10" placeholder="Ingrese Numero Exterior" value="<?php print $resultados[6] ?>">
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Localidad: *</label>
                            <input type="text" class="form-control" name="MUNICIPIO_CLIENTE" placeholder="Ingrese localidad" value="<?php print $resultados[7] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Estado: *</label>
                            <select name="ESTADO_CLIENTE" class="form-control" required>
                                <?php
                                $query = "CALL MOSTRAR_ESTADOS()";
                                $ejecucion = mysqli_query($link, $query);
                                while ($resultadoss = mysqli_fetch_assoc($ejecucion)) {
                                    if ($resultadoss['ID'] == $resultados[8]) {
                                        echo "<option value='" . $resultadoss['ID'] . "' selected>" . $resultadoss['ESTADO'] . "</option>";
                                    } else {
                                        echo "<option value='" . $resultadoss['ID'] . "'>" . $resultadoss['ESTADO'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Referencias domicilio: *</label>
                            <input type="text" class="form-control" name="REFERENCIA_CLIENTE" placeholder="Referencia domiciliaria" value="<?php print $resultados[14] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Usuario: *</label>
                            <input type="text" class="form-control" name="NOMBRE_USUARIO" placeholder="Ingrese Nombre de Usuario" value="<?php print $resultados[9] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Contraseña: *</label>
                            <input type="password" class="form-control" name="PASWWORD_CLIENTE" placeholder="Ingrese una Contraseña" value="<?php print $resultados[12] ?>" required>
                        </div>
                        <div class="mb-3 elementos">
                            <label class="form-label">Correo: *</label>
                            <input type="email" class="form-control" name="CORREO_CLIENTE" placeholder="Ingrese un correo" value="<?php print $resultados[10] ?>" required>
                        </div>

                        <div class="mb-3 elementos">
                            <label class="form-label">Telefono: *</label>
                            <input type="tel" class="form-control" maxlength="15" name="TELEFONO_CLIENTE" placeholder="Ingrese un Telefono" value="<?php print $resultados[11] ?>" required>
                        </div>

                    </section>
                    <section class="boton">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </section>
                </form>
            </main>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("location: ../sesion/inicio_sesion.php");
} ?>