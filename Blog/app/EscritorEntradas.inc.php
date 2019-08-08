<?php
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/Entrada.inc.php';

class EscritorEntradas {

    public static function escribirEntradas() {
        $entradas = RepositorioEntrada::obtenerTodasPorFechaDescendiente(Conexion::obtenerConexion());

        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribirEntrada($entrada);
            }
        }
    }

    public static function escribirEntrada($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php
                        echo $entrada->obtenerTitulo();
                        ?>
                    </div>
                    <div class="panel-body">
                        <p>
                            <strong>
                                <?php
                                echo $entrada->obtenerFecha();
                                ?>
                            </strong>
                        </p>
                        <div class="text-justify">
                            <?php
                            //new line to break rule
                            echo nl2br(self::resumirTexto($entrada->obtenerTexto()));
                            ?>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-left">
                                    <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtenerUrl() ?>" role="button">Leer mas</a>
                                </div>
                            </div>

                            <div class="col-md-3" id="likesandcoment">
                                <div class="text-right">
                                   <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                   Likes
                                </div>
                            </div>
                            <div class="col-md-3" id="likesandcoment">
                                <div class="text-right">
                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 
                                    Comentarios
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function resumirTexto($texto) {
        $longitud_maxima = 400;
        $resultado = '';

        if (strlen($texto) >= $longitud_maxima) {
            $resultado = substr($texto, 0, $longitud_maxima);
            $resultado.='...';
        } else {
            $resultado = $texto;
        }
        return $resultado;
    }

}
