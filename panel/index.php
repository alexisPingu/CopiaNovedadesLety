<?php
session_start();
session_destroy();

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
    <link rel="shortcut icon" href="assets/imgs/logo_novedades.png" type="image/x-icon">
    <title>Novedades Lety | Home</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        include "../conexion/Conexion.php";
        if(isset($_POST['nombre_usuario']) && isset($_POST['pass_usuario'])){
            $query="CALL usuario_sesion ('".$_POST['nombre_usuario']."','".$_POST['pass_usuario']."')";
            $ejecutar=mysqli_query($link,$query);
            if($resultados=mysqli_fetch_assoc($ejecutar)){
                session_start();
                $_SESSION['Usuario']=$resultados['NOMBRE_USUARIO_U'];
                // PRINT $_SESSION['Usuario'];
                $_SESSION['Contraseña']=$_POST['pass_usuario'];
                header("location: productos/index.php");
            }else{
                echo "<script>
                Swal.fire(
                  'Ocurrio un problema',
                  'Datos incorrectos',
                  'warning'
                )</script>";
            }
        }else{
            echo "<script>Swal.fire('Inicia sesion')</script>";
        }
    ?>
    <main class="formulario">
        <form action="index.php" method="POST">
            <h1>Acceso al panel</h1>
            <hr>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nombre_usuario" aria-describedby="emailHelp" placeholder="Nombre de usuario" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass_usuario" placeholder="Ingrese contraseña" required>
            </div>
            <section class="boton">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </section>

        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>