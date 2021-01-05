<?php
//Conexión
$servidor = 'localhost';
$usuario_db = 'root';
$password = 'pro870app0';
$basededatos = 'blog_master';
$db = mysqli_connect($servidor, $usuario_db, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf-8'");

//Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}


