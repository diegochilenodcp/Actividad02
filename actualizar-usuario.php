<?php

if(isset($_POST)){
    //Cargar la conexión a la BD
require_once 'includes/conexion.php';
//Iniciar la sesión
If(!isset($_SESSION)){
  session_start();  
}

    
    //Recoger los valores del formulario de actualización del usuario. Escape de valores (interpreta comillas como string).
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    //$password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    //Array de errores
    $errores = array();
    
    //Validar los datos antes de guardarlos en la base de datos
    //Validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("[/0-9/]", $nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado =false;
        $errores['nombre'] = "El nombre no es válido";
    }
    //Validar apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("[/0-9/]", $nombre)){
        $apellidos_validado = true;
    }else{
        $apellidos_validado =false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }
    //Validar email - cambié !empty 
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado =false;
        $errores['email'] = "El email no es válido";
    }
    //Validar password
    //if(!empty($password)){
    //    $password_validado = true;
    //}else{
    //    $password_validado =false;
    //    $errores['password'] = "La contraseña está vacía";
    //}
    
    $guardar_usuario = false;
    
    if(count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;
        //Cifrar la contraseña
        //$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]); 
        /*Ver y verificar la contraseña
        //var_dump($password);
        //var_dump($password_segura);
        var_dump(password_verify($password, $password_segura));*/
        
        //comprobar si el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        //var_dump($isset_user);
        //die();
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
        
        //Actualizar el USUARIO EN LA BASE DE DATOS
        
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email'
                WHERE id = ".$usuario['id'];   
        
        //var_dump($_SESSION['usuario']);
        //die();
                  
        $guardar = mysqli_query($db, $sql);
        //mysqli_error($db);
        
        //var_dump($sql);
        //die();
        
        if($guardar){
            //Guardo los nuevos datos actualizados en la sesión
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
            
            $_SESSION['completado'] = "La actualización del usuario se ha completado con éxito";
            
        }else{
            $_SESSION['errores']['general'] = "Fallo al actualizar el usuario";
        }
        }else{
            $_SESSION['errores']['general'] = "El usuario ya existe!";
        }
        }else{
        $_SESSION['errores'] = $errores;
        }
    }
    
    header('Location: mis-datos.php');



