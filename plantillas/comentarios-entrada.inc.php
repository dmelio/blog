<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comentarios">
            <?php echo "Ver comentarios (" . count($comentarios) . ")"; ?>
        </button>
        <br>
        <br>
        <div id="comentarios" class="collapse">
            <?php
            for ($i = 0; $i < count($comentarios); $i++) {
                $comentario = $comentarios[$i];
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $comentario->obtenerTitulo(); ?>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <?php echo $comentario->obtenerAutorId(); ?>
                                </div>
                                <div class="col-md-10">
                                    <p>
                                        <?php echo $comentario->obtenerFecha(); ?>
                                    </p>
                                    <p class="text-justify">
                                        <?php echo nl2br($comentario->obtenerTexto()); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
