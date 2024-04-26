<?php
//redirecciona al index una vez iniciada sesion
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: index1.php ");    
}



