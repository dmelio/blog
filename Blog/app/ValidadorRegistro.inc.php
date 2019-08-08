<?php
include_once'RepositorioUsuario.inc.php';
include_once'Usuario.inc.php';

class ValidadorRegistro {

    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $email;
    private $clave;
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;

    public function __construct($nombre, $email, $clave1, $clave2,$conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";


        $this->nombre = "";
        $this->email = "";
        $this->clave = "";

        $this->error_nombre = $this->validarNombre($conexion,$nombre);
        $this->error_email = $this->validarEmail($conexion,$email);
        $this->error_clave1 = $this->validarClave1($clave1);
        $this->error_clave2 = $this->validarClave2($clave1, $clave2);

        if ($this->error_clave1 === "" && $this->error_clave2 === "") {
            $this->clave = $clave1;
        }
    }

    private function variableIniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validarNombre($conexion,$nombre) {
        if (!$this->variableIniciada($nombre)) {
            return "Debes escribir un nombre de usuario";
        } else {
            $this->nombre = $nombre;
        }
        if (strlen($nombre) < 6) {
            return "el nombre debe tener mas de 6 caracteres";
        }
        if (strlen($nombre) > 24) {
            return "el nombre debe tener menos de 24 caracteres";
        }
        
        if(RepositorioUsuario:: nombreExiste($conexion,$nombre)){
            return "Este nombre de usuario ya esta en uso, por favor, prueba otro nombre.";
        }
        return "";
    }

    private function validarEmail($conexion,$email) {
        if (!$this->variableIniciada($email)) {
            return "Debes escribir un email valido";
        } else {
            $this->email = $email;
        }
        if(RepositorioUsuario:: emailExiste($conexion,$email)){
            return "Este email ya esta en uso, pruebe otro email o <a href='#'>intente recuperar su contraseña</a>";
        }
        return "";
    }

    private function validarClave1($clave1) {
        if (!$this->variableIniciada($clave1)) {
            return "Debes escribir una password valida";
        }
        return "";
    }

    private function validarClave2($clave1, $clave2) {

        if (!$this->variableIniciada($clave2)) {
            return "Debes confirmar la contraseña";
        }
        if ($clave1 !== $clave2) {
            return "Las contraseñas no coinciden";
        }
        return "";
    }

    public function obtenerNombre() {
        return $this->nombre;
    }

    public function obtenerEmail() {
        return $this->email;
    }

    public function obtenerClave() {
        return $this->clave;
    }

    public function obtenerErrorNombre() {
        return $this->error_nombre;
    }

    public function obtenerErrorEmail() {
        return $this->error_email;
    }

    public function obtenerErrorClave1() {
        return $this->error_clave1;
    }

    public function obtenerErrorClave2() {
        return $this->error_clave2;
    }

    public function mostrarNombre() {
        if ($this->nombre !== "") {
            echo'value="' . $this->nombre . '"';
        }
    }

    public function mostrarErrorNombre() {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrarEmail() {
        if ($this->email !== "") {
            echo'value="' . $this->email . '"';
        }
    }

    public function mostrarErrorEmail() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrarErrorClave1() {
        if ($this->error_clave1 !== "") {
            echo $this->aviso_inicio . $this->error_clave1 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorClave2() {
        if ($this->error_clave2 !== "") {
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }

    public function registroValido() {
        if ($this->error_nombre === "" &&
                $this->error_email === "" &&
                $this->error_clave1 === "" &&
                $this->error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }

}
