<?php

session_start();
session_destroy();

header("location: sesion/inicio_sesion.php");

?>