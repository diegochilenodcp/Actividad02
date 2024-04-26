<?php
//ATENCION, acá van las consultas a la bd, manejo de sesiones, mostrar erorres
// para no colocarlo en las demás páginas y así modularizar.
function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class = 'alerta alerta-error'>".$errores[$campo].'</div>';
    }
    return $alerta;
}

function borrarErrores(){
    $borrado = false;
    if(isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
    $borrado = true;
    //Esto no va en lo paréntesis de session_unset porque no se le pasa parámetros($_SESSION['errores'])
    }
    
    if(isset($_SESSION['errores_entrada'])){
    $_SESSION['errores_entrada'] = null;
    $borrado = true;
    }
    $completo = false;
    if(isset($_SESSION['completado'])){
    $_SESSION['completado'] = null;
    $borrado = true;
    }    
    return $borrado;
}

//var_dump($_SESSION['errores']);

function conseguirCategorias($conexion){
    $sql = " SELECT * FROM categorias ORDER BY id ASC ";
    $categorias = mysqli_query($conexion, $sql);
    
    
    $resultado = array();
    //Lo de abajo es para saber si hay categorías y no está vacío
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = $categorias;
        
    }
    
    return $resultado;
}

function conseguirCategoria($conexion, $id){
    $sql = " SELECT * FROM categorias WHERE id = $id ";
    $categorias = mysqli_query($conexion, $sql);
    
    
    $resultado = array();
    //Lo de abajo es para saber si hay categorías y no está vacío
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = mysqli_fetch_assoc($categorias);
        
    }
    
    return $resultado;
}

function conseguirEntrada($conexion, $id){
    $sql = " SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, '  ' ,u.apellidos) AS 'usuario' FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            INNER JOIN usuarios u ON e.usuario_id = u.id
            WHERE e.id = $id ";

    $entrada = mysqli_query($conexion, $sql);
    //var_dump($sql);
    //var_dump($conexion);
    $resultado = array();
    
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }
    //var_dump($resultado);
    
    return $resultado;
}
    

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null ){
    
    //Las consultas NO van concatenadas con un punto, trae problemas
    $sql = " SELECT e.*, c.nombre AS 'categoria' FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id ";
    
    if(!empty($categoria)){
        $sql .= " WHERE e.categoria_id = $categoria ";
    }
    
    if(!empty($busqueda)){
        $sql .= " WHERE e.titulo LIKE '%$busqueda%' ";
    }
    
    $sql .= " ORDER BY e.id DESC ";
    
      
    if($limit){
        $sql .= " LIMIT 4 "; 
    }
    //echo $sql;
    //var_dump($sql);
    //var_dump($limit);
    //var_dump($categoria);
    //die();
    
    $entradas = mysqli_query($conexion, $sql);
    //El var_dump me permite ver como está hecha la consulta ---MUY UTIL---
    //var_dump($sql);
    //die();
    
    $resultado = array();
    //Para saber que no está vacía la entrada
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
        
    }
    
    return $entradas;
}

