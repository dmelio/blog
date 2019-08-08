<?php
include_once'app/EscritorEntradas.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/Entrada.inc.php';

?>
<div class="row">
    <div class="col-md-12">
        <hr>
        <h3>Te podria interesar</h3>
    </div>
    <?php
    for ($i = 0; $i < count($entradas_al_azar); $i++) {
        $entrada_actual = $entradas_al_azar[$i];
        ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    echo $entrada_actual->obtenerTitulo();
                    ?>
                </div>
                <div class="panel-body">
                    <p>
                        <?php echo EscritorEntradas::resumirTexto(nl2br($entrada_actual->obtenerTexto())); ?>
                    </p>
                    <div class="text-left">
                        <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtenerUrl() ?>" role="button">Leer mas</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="col-md-12">
        <hr>
    </div>
</div>