<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>
<!DOCTYPE HTML>
<html lang ="es">
<head>
    <meta charset="utf-8" />
    <title>Blog de noticias</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>
    <!-- CABECERA -->
    <header id="cabecera">
        <!-- LOGO -->    
        <div id="logo" style="text-align: right;">
            <a href="index1.php">
                BLOG DE NOTICIAS
            </a>
        </div>
        
        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index1.php">Inicio</a>
                </li>
                <?php //Se muestran las categorías
                $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)): ?> 
                        <li>
                            <a href="categoria.php?id=<?=$categoria['id']; ?>"><?=$categoria['nombre']; ?></a>
                        </li>
                <?php endwhile;
                endif;
                ?>
                <li>
                    <a href="index1.php">Sobre mi</a>
                </li>
                <li>
                    <a href="index1.php">ContaSctos</a>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
</body>
</html>

