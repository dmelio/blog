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
    
    public function __construct($titulo,$url,$texto,$conexion){
        $this->aviso_inicio ="<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre ="</div>";
        
        $this->titulo = "";
        $this->url = "";
        $this->texto = "";
        
        $this->error_titulo=$this ->validarTitulo($conexion,$titulo);
        $this->error_url=$this ->validarUrl($conexion,$url);
        $this->error_texto=$this ->validarTexto($texto);
    }

    private function  variableIniciada($variable){
        if(isset($variable)&& !empty($variable)){
            return true;
        }else{
            return false;
        }
    }
    
    private function validarTitulo($conexion,$titulo){
        if(!$this->variableIniciada($titulo)){
            return "debes escribir un titulo";
        }else{
            $this ->titulo = $titulo;
        }
        if(strlen($titulo)>255){
            return "El titulo es muy largo";
        }
        
        if(RepositorioEntrada::tituloexiste($conexion,$titulo)){
            return"ya existe una entrada con ese titulo";
        }
        
    }
}
