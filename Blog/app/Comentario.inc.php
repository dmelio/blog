<?php

class Comentario {

    private $id;
    private $autor_id;
    private $entrada_id;
    private $titulo;
    private $texto;
    private $fecha;

    public function __construct($id, $autor_id, $entrada_id, $titulo, $texto, $fecha) {
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->entrada_id = $entrada_id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    public function obtenerId() {
        return $this->id;
    }

    public function obtenerAutorId() {
        return $this->autor_id;
    }

    public function obtenerEntradaId() {
        return $this->entrada_id;
    }

    public function obtenerTitulo() {
        return $this->titulo;
    }

    public function obtenerTexto() {
        return $this->texto;
    }

    public function obtenerFecha() {
        return $this->fecha;
    }

    public function cambiarTexto($texto) {
        $this->texto = $texto;
    }
    public function cambiarTitulo($titulo) {
        $this->titulo = $titulo;
    }

}
