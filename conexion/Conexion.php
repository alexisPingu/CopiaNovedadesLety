<?php
    //Conexion 
    $servidor="localhost";
    $user="root";
    $password="";
    $dbname="novedadeslety";

    $link = mysqli_connect($servidor,$user,$password,$dbname) OR DIE ("Conexion Fallida");
    mysqli_query($link, "SET NAMES 'utf8'");
?>