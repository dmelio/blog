<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

include_once'plantillas/documento-declaracion.inc.php';
include_once'plantillas/navbar.inc.php';


$titulo = 'Nueva Publicacion';
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Nueva Publicacion</h1> 
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-nueva-entrada" method="post" action="<?php echo RUTA_NUEVA_ENTRADA; ?>">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo de la publicacion">
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control" id="url" placeholder="Direccion de la publicacion">
                </div>
                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea class="form-control" name="texto" rows="10" id="contenido" placeholder="Escribe el contenido de tu publicacion"></textarea>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="publicar" value="si">Marca esta opcion para publicar
                    </label>
                </div>
                <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>