<?php
// cerrar sesion del usuario
session_start();

if(isset($_SESSION['usuario'])){
    session_destroy();
}

header('Location: index.php');
