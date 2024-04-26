<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Conexión a la base de datos
    $conexion = mysqli_connect("mysql", "root", "root", "blog_db");

    // Verificar conexión
    if ($conexion === false) {
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }

    // Preparar consulta SQL
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$contraseña', CURDATE())";

    // Ejecutar consulta SQL
    if (mysqli_query($conexion, $sql)) {
        header("Location: index.php?registro=exitoso");
        exit();
    } else {
        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>
