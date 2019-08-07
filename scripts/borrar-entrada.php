<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['borrar_entrada'])) {
   $id_entrada = $_POST['id_borrar'];
   
   Conexion::abrirConexion();
   RepositorioEntrada::eliminarComentariosyEntradas(Conexion::obtenerConexion(),$id_entrada);
   
   Conexion::cerrarConexion();
   Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
} 