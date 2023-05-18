<?php
include "../conexion/Conexion.php";
$nombre_cliente="";
$apellidos_cliente="";
$cp_cliente="";
$calle_cliente="";
$numero_interior="";
$numero_exterior="";//6
$municipio_cliente="";//7
$estado_cliente="";//8
$nombre_usuario="";//9
$contraseña_cliente="";
$telefono_cliente="";
$correo_cliente="";
$referencia="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Novedades Lety | Registro</title>
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
            </div>
        </nav>
    </header>
    <?php


        if(isset($_POST['ESTADO_CLIENTE'])){
            $nombre_cliente=$_POST['NOMBRE_CLIENTE'];
            $apellidos_cliente=$_POST['APELLIDOS_CLIENTES'];
            $cp_cliente=$_POST['CP_CLIENTE'];
            $calle_cliente=$_POST['CALLE_CLIENTE'];
            $numero_interior=$_POST['NUM_I'];
            $numero_exterior=$_POST['NUM_E'];//6
            $municipio_cliente=$_POST['MUNICIPIO_CLIENTE'];//7
            $estado_cliente=$_POST['ESTADO_CLIENTE'];//8
            $nombre_usuario=$_POST['NOMBRE_USUARIO'];//9
            $contraseña_cliente=$_POST['PASWWORD_CLIENTE'];
            $telefono_cliente=$_POST['TELEFONO_CLIENTE'];
            $correo_cliente=$_POST['CORREO_CLIENTE'];
            $referencia=$_POST['REFERENCIA_CLIENTE'];
            if($_POST['ESTADO_CLIENTE']!=0){
                $query="CALL INSERTAR_CLIENTE('$nombre_cliente',
                '$apellidos_cliente',
                '$cp_cliente',
                '$calle_cliente',
                '$numero_interior',
                '$numero_exterior',
                '$municipio_cliente',
                $estado_cliente,
                '$nombre_usuario',
                '$correo_cliente',
                '$telefono_cliente',
                '$contraseña_cliente',
                '$referencia')";
                $consultar=mysqli_query($link,$query);
                $resultados=mysqli_fetch_assoc($consultar);

                if($resultados['Mensaje']=="Se creo tu perfil correctamente"){
                    // echo "<script>Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'Perfil creado, no olvides nunca tu usuario ni contraseña',
                    //     showConfirmButton: false,
                    //     timer: 5000
                    //   })</script>";
                      header("location: inicio_sesion.php");
                }else{
                    if($resultados['Mensaje']=="Nombre de usuario no valido"){
                        echo "<script> Swal.fire('".$resultados['Mensaje']."')</script>";
                        $nombre_usuario="";
                    }else{
                        echo "<script> Swal.fire('".$resultados['Mensaje']."')</script>";
                        $correo_cliente="";
                    }
                    //header("location: registrar_cliente.php");
                    // print @$_SERVER['HTT_REFERER'];
                }
            }else{
                echo "<script>Swal.fire(
                    'Selecciona un estado',
                    '',
                    'question')</script>";
                // header("location: ../archivo.php");
                
            }
        }
    ?>
    <section class="contenedor">
    <main class="main">
        <form action="registrar_cliente.php" method="POST">
            <h1>Registrate</h1>
            <p>* Datos obligatorios</p>
            <hr>
            <section class="contenedor-grid">
                <div class="mb-2 elementos">
                    <label class="form-label">Nombre: *</label>
                    <input type="text" class="form-control" name="NOMBRE_CLIENTE" placeholder="Nombre de pila" value='<?php print $nombre_cliente; ?>' required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Apellidos: *</label>
                    <input type="text" class="form-control" name="APELLIDOS_CLIENTES" placeholder="Ingrese Apellidos" value='<?php print $apellidos_cliente; ?>'required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">C.P: *</label>
                    <input type="text" class="form-control" name="CP_CLIENTE" maxlength="10" placeholder="Ingrese Codigo Postal" value='<?php print $cp_cliente; ?>' required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Calle: *</label>
                    <input type="text" class="form-control" name="CALLE_CLIENTE" placeholder="Ingrese Calle" value='<?php print $calle_cliente; ?>' required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Numero Interior:</label>
                    <input type="text" class="form-control" name="NUM_I" maxlength="10" placeholder="Ingrese Numero Interior" value='<?php print $numero_interior; ?>'>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Numero exterior:</label>
                    <input type="text" class="form-control" name="NUM_E" maxlength="10" placeholder="Ingrese Numero Exterior" value='<?php print $numero_exterior; ?>'>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Localidad: *</label>
                    <input type="text" class="form-control" name="MUNICIPIO_CLIENTE" placeholder="Ingrese localidad" value='<?php print $municipio_cliente; ?>'required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Estado: *</label>
                    <select name="ESTADO_CLIENTE" class="form-control" required>
                        <option value="0">--Selecciona un Estado--</option>
                        <?php
                            $query="CALL MOSTRAR_ESTADOS()";
                            $ejecucion=mysqli_query($link,$query);
                            while($resultados=mysqli_fetch_assoc($ejecucion)){
                                echo "<option value='".$resultados['ID']."'>".$resultados['ESTADO']."</option>";                                
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Referencias domicilio: *</label>
                    <input type="text" class="form-control" name="REFERENCIA_CLIENTE" placeholder="Referencia domiciliaria" value='<?php print $referencia; ?>'required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Usuario: *</label>
                    <input type="text" class="form-control" name="NOMBRE_USUARIO" value='<?php print $nombre_usuario; ?>' placeholder="Ingrese Nombre de Usuario" required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Contraseña: *</label>
                    <input type="password" class="form-control" name="PASWWORD_CLIENTE" value='<?php print $contraseña_cliente; ?>'placeholder="Ingrese una Contraseña" required>
                </div>
                <div class="mb-3 elementos">
                    <label class="form-label">Correo: *</label>
                    <input type="email" class="form-control" name="CORREO_CLIENTE" placeholder="Ingrese un correo" value='<?php print $correo_cliente; ?>'required>
                </div>

                <div class="mb-3 elementos">
                    <label class="form-label">Telefono: *</label>
                    <input type="tel" class="form-control" maxlength="15" name="TELEFONO_CLIENTE" placeholder="Ingrese un Telefono" value='<?php print $telefono_cliente; ?>'required>
                </div>
                
            </section>
            <section class="boton">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </section>
        </form>
    </main>
    </section>
    
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>