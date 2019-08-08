<?php
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

$titulo = 'Error 404';
header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found', true, 404);

?>
<div class="row">
    <div class="col-md-12 text-center">
        <h1>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Lo sentimos, esta pagina no existe.
            </div>
        </h1>
    </div>
</div>

<?php
include_once 'plantillas/pie-pagina.inc.php';
