<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

$titulo = $entrada->obtenerTitulo();

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php
                echo $entrada->obtenerTitulo();
                ?>
            </h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                por
                <a href="#">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo $autor->obtenerNombre(); ?>
                </a>
                el
                <?php echo $entrada->obtenerFecha(); ?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify"><?php echo nl2br($entrada->obtenerTexto()); ?></article>
        </div>
    </div>
    <?php
    include_once'plantillas/entradas_al_azar.inc.php';
    ?>
    <br>
    <?php
        if(count($comentarios) > 0){
            include_once 'plantillas/comentarios-entrada.inc.php';
        }else{
            echo '<p>Todavia no hay comentarios</p>';
        }
    ?>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
