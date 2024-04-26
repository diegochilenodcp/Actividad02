<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Conexión a la base de datos
    $conexion = mysqli_connect("mysql", "root", "root", "blog_db");

    // Verificar conexión
    if ($conexion === false) {
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }

//Consulta para comprobar las credenciales del usuario
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$login = mysqli_query($db, $sql);

if($login && mysqli_num_rows($login) == 1){
    $usuario = mysqli_fetch_assoc($login);
    //var_dump($usuario);
    //die();
    //Comprobar la password / cifrar
    $verify = password_verify($contrasena, $usuario['password']);

    if($verify){
         //Utilizar una sesión para guardar los datos del usuario loguedo
        $_SESSION['usuario']= $usuario;
        
        
    }else{
        //Si algo falla enviar una sesión con el fallo
        $_SESSION['error_login'] = "Login incorrecto!!!";
    }       
}else{   
    //mensaje de error
    $_SESSION['error_login'] = "Login incorrecto!!!";
}
}

//Redirigir al index.php
Header('Location: index1.php');
?>
