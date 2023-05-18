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
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="shortcut icon" href="../assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Novedades Lety | Inicias Sesion</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    <?php
    
    require ("../conexion/Conexion.php");
    if(isset($_POST['nombre_cliente']) && isset($_POST['pass_cliente'])){
        $nombreCliente=$_POST['nombre_cliente'];
        $password=$_POST['pass_cliente'];
        $query="CALL sesion_cliente('$nombreCliente','$password')";
        $consultar=mysqli_query($link,$query);
        $resultados = mysqli_fetch_assoc($consultar);
        if($resultados && $resultados['USUARIO']!=null){
            $_SESSION['usuario']=$resultados['USUARIO'];
            $_SESSION['id_usuario']=$resultados['ID'];
            //Añadimos el correo a las sesion
            $_SESSION['correo_usuario']=$resultados['CORREO'];
            header("location: ../carrito.php");
         }else{
            echo "<script>Swal.fire(
                'Ocurrio un error',
                'Datos incorrectos',
                'warning'
                )</script>";
        }
    }
    ?>
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
    <main class="formulario">
        <form action="inicio_sesion.php" method="POST">
            <h1>Inicia sesion</h1>
            <hr>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nombre_cliente" aria-describedby="emailHelp" placeholder="Nombre de usuario" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass_cliente" placeholder="Ingrese contraseña" required>
            </div>
            <section class="boton">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </section>
            <br>
            <a href="registrar_cliente.php">¿No tienes cuenta? Registrate</a>

        </form>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>