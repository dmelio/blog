<?php
error_reporting(0);
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/validador-entrada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
$titulo = 'Nueva Publicacion';

$entrada_publica = 0;
if (isset($_POST['guardar'])) {
    Conexion::abrirConexion();

    $validador = new ValidadorEntrada($_POST['titulo'], $_POST['url'], htmlspecialchars($_POST['texto']), Conexion::obtenerConexion());

    if (isset($_post['publicar']) && $_POST['publicar'] == 'si') {
        $entrada_publica = 1;
    }
    
    if($validador ->entradaValida()){
        if(ControlSesion::sesionIniciada()){
            $entrada = new Entrada('',$_SESSION['id_usuario'],$validador ->obtenerUrl(),
                    $validador->obtenerTitulo(),$validador->obtenerTexto(),'',$entrada_publica);
            
            $entrada_insertada = RepositorioEntrada::insertarEntrada(Conexion::obtenerConexion(),$entrada);
            if($entrada_insertada){
                Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }
        }else{
            Redireccion::redirigir(RUTA_LOGIN);
        }
        Conexion::cerrarConexion();
    }
}
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
               <?php
               if(isset($_POST['guardar'])){
                   include_once 'plantillas/form-nueva-entrada-validado.inc.php';
               }else{
                   include_once 'plantillas/form-nueva-entrada-vacio.inc.php';
               }
               ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/pie-pagina.inc.php';
?>