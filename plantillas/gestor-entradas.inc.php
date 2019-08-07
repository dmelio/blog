<div class="row parte-gestor-entradas">
    <div class="col-md-12" id="g-publicaciones">
        <h1>Gestion de Publicaciones</h1>
        <br>
        <a href="<?php echo RUTA_NUEVA_ENTRADA; ?>" class="btn btn-lg btn-primary" id="btn-nueva-entrada" role="button">Crear entrada</a>
    </div>
</div>
<div class="row" parte-gestor-entradas>
    <div class="col-md-12" id="fondo-tabla">
        <?php if (count($array_entradas) > 0) {
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Titulo</th>
                        <th>Estado</th>
                        <th>Comentarios</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($array_entradas); $i++) {
                        $entrada_actual = $array_entradas[$i][0];
                        $comentarios_entrada_actual = $array_entradas[$i][1];
                        ?>
                        <tr>
                            <td><?php echo $entrada_actual->obtenerFecha() ?></td>
                            <td><?php echo $entrada_actual->obtenerTitulo() ?></td>
                            <td><?php echo $entrada_actual->obtenerActiva() ?></td>
                            <td><?php echo $comentarios_entrada_actual ?></td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs">Editar</button>
                            </td>
                            <td>
                                <form method="post" action="<?php echo RUTA_BORRAR_ENTRADA; ?>"> 
                                    <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual->obtenerId(); ?>">
                                    <button type="submit" name="borrar_entrada" class="btn btn-default btn-xs">Eliminar</button>  
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <h3 class="text-center">no hay entradas</h3>
            <br>
            <br>
            <?php
        }
        ?>

    </div>
</div>