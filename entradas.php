<?php require_once 'includes/cabecera.php'; ?>
    
        <div id="contenedor"> 
        <!-- BARRA LATERAL -->
<?php require_once 'includes/lateral.php'; ?>        
        <!-- CAJA PRINCIPAL -->
            <div id="principal">
                 <h1>Todas las noticias</h1>
                     <?php
                        $entradas = conseguirEntradas($db);
                        if(!empty($entradas)):
                            while($entrada = mysqli_fetch_assoc($entradas)):
                     ?>
                        <article class="entrada">
                             <a href="entrada.php?id=<?=$entrada['id']?>">
                             <h2><?= $entrada['titulo']?></h2>
                         <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                                <p>
                                    <!--substr Función para limitar la cantidad de caracteres en PHP-->
                                    <?=substr($entrada['descripcion'], 0, 180)."..."?>                
                                </p>
                            </a>
                        </article>
                    <?php 
                            endwhile;
                        endif;
                     ?>   
                <div id="ver-todas">
                    <a href="entradas.php">Ver todas las noticias</a>
                </div>    
            </div> <!--Fin pricipal-->         
         <div class="clearfix"></div>   
    </div> <!---Fin del contenedor--->  
        <!-- PIE DE PAGINA --->
   
<?php require_once 'includes/pie.php';        
