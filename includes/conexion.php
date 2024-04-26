<?php
//Conexión
$servidor = 'mysql';
$usuario_db = 'root';
$password = 'root';
$basededatos = 'blog_db';
$db = mysqli_connect($servidor, $usuario_db, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf-8'");

//Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}


