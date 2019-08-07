<?php

include_once 'RepositorioEntrada.inc.php';

class validadorEntrada {

    private $aviso_inicio;
    private $aviso_cierre;
    private $titulo;
    private $url;
    private $texto;
    private $error_titulo;
    private $error_url;
    private $error_texto;

    public function __construct($titulo, $url, $texto, $conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->titulo = "";
        $this->url = "";
        $this->texto = "";

        $this->error_titulo = $this->validarTitulo($conexion, $titulo);
        $this->error_url = $this->validarUrl($conexion, $url);
        $this->error_texto = $this->validarTexto($conexion, $texto);
    }

    private function variableIniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validarTitulo($conexion, $titulo) {
        if (!$this->variableIniciada($titulo)) {
            return "debes escribir un titulo";
        } else {
            $this->titulo = $titulo;
        }
        if (strlen($titulo) > 255) {
            return "El titulo es muy largo";
        }

        if (RepositorioEntrada::tituloexiste($conexion, $titulo)) {
            return"ya existe una entrada con ese titulo";
        }
    }

    private function validarUrl($conexion, $url) {
        if (!$this->variableIniciada($url)) {
            return "debes escribir una URL";
        } else {
            $this->url = $url;
        }
        //valida espacios en blanco
        $url_tratada = str_replace(' ','',$url);
        $url_tratada = preg_replace('/\s+/','',$url_tratada);
        
        
        
        if (strlen($url) != strlen($url_tratada)) {
            return "la URL no puede tener espacios";
        }
        if (RepositorioEntrada::urlExiste($conexion, $titulo)) {
            return"ya existe un articulo con esta URL";
        }
    }

    private function validarTexto($conexion, $texto) {
        if (!$this->variableIniciada($texto)) {
            return "debes escribir un cuerpo a tu articulo";
        } else {
            $this->texto = $texto;
        }
    }

    public function obtenerTitulo() {
        return $this->titulo;
    }

    public function obtenerUrl() {
        return $this->url;
    }

    public function obtenerTexto() {
        return $this->texto;
    }

    public function mostrarTitulo() {
        if (!$this->titulo != "") {
            echo 'value = "' . $this->titulo . '"';
        }
    }

    public function mostrarUrl() {
        if (!$this->url != "") {
            echo 'value = "' . $this->url . '"';
        }
    }

    public function mostrarTexto() {
        if ($this->texto != "" && strlen(trim($this->texto) > 0)) {
            echo $this->texto;
        }
    }

    public function mostrarErrorTitulo() {
        if ($this->error_titulo != "") {
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
        }
    }

    public function mostrarErrorUrl() {
        if ($this->error_url != "") {
            echo $this->aviso_inicio . $this->error_url . $this->aviso_cierre;
        }
    }

    public function mostrarErrorTexto() {
        if ($this->error_texto != "") {
            echo $this->aviso_inicio . $this->error_texto . $this->aviso_cierre;
        }
    }

    public function entradaValida() {
        if ($this->error_titulo == "" && $this->error_url == "" && $this->error_texto == "") {
            return true;
        } else {
            return false;
        }
    }

}
