<?php

class Entrada {

    private $id;
    private $autor_id;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;

    public function __construct($id,$autor_id,$url,$titulo,$texto,$fecha,$activa){
        $this->id = $id;
        $this->autor_id=$autor_id;
        $this->url=$url;
        $this->titulo=$titulo;
        $this->texto=$texto;
        $this->fecha=$fecha;
        $this->activa=$activa;
    }

    public function obtenerId(){
        return $this->id;
    }
    public function obtenerAutorId(){
        return $this->autor_id;
    }
    public function obtenerUrl(){
        return $this->url;
    }

    public function obtenerTitulo(){
        return $this->titulo;
    }
    public function obtenerTexto(){
        return $this->texto;
    }
    public function obtenerFecha(){
        return $this->fecha;
    }
    public function obtenerActiva(){
        return $this->activa;
    }
    public function cambiarTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function cambiarTexto($texto) {
        $this->texto = $texto;
    }
    public function cambiarActiva($activa) {
        $this->activa = $activa;
    }
}
