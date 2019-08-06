<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion :: abrirConexion();
    $validador = new ValidadorRegistro($_POST['nombre'], $_POST['email'], 
            $_POST['clave1'], $_POST['clave2'],Conexion::obtenerConexion());

    if ($validador->registroValido()) {
        $usuario = new usuario('', $validador->obtenerNombre(), 
                $validador->obtenerEmail(),
                password_hash($validador->obtenerClave(),PASSWORD_DEFAULT), 
                '',
                '');
        $usuario_insertado = RepositorioUsuario :: insertarUsuario(Conexion::obtenerConexion(), $usuario);
        if ($usuario_insertado) {
            //redirigir a registro correcto
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario->obtenerNombre());
        }
    }
    
    Conexion :: cerrarConexion();
}

$titulo = 'Registro';

include_once'plantillas/documento-declaracion.inc.php';
include_once'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de registro</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Instrucciones
                    </h3>
                </div>
                <div class="panel-body">
                    <br>
                    <p class="text-justify">
                        Para unirte a este blog de mierda debes ingresar 
                        los datos que se pediran a continuacion. <br>
                        la informacion que ingreses debe ser real para evitar inconvenientes.<br>
                        Asegurate que tu contraseña sea segura, para esto utiliza letras mayusculas y minusculas ademas de numeros,letras y caracteres.
                    </p>
                    <br>
                    <a href="#">¿Ya tienes cuenta?</a>
                    <br>
                    <br>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                    <br>
                    <br>    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Introduce tus datos
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>