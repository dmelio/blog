<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Comentario.inc.php';

class RepositorioComentario{
    
    public static function insertarComentario($conexion,$comentario){
        $comentario_insertado = false;
        if (isset($conexion)) {
            try {

                // preguntar a profe error: Notice: Only variables should be passed by reference in 
                $sql = "INSERT INTO comentarios(autor_id,entrada_id,titulo,texto,fecha)VALUES(:autor_id,:entrada_id,:titulo,:texto,NOW())";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $comentario->obtenerAutorId(), PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $comentario->obtenerEntradaId(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $comentario->obtenerTitulo(), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $comentario->obtenerTexto(), PDO::PARAM_STR);

                $comentario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $comentario_insertado;
    }   
    
    public static function obtenerComentarios($conexion,$entrada_id){
        $comentarios=[];
        if(isset($conexion)){
            try {
                include_once 'Comentario.inc.php';
                $sql = "SELECT * FROM comentarios WHERE entrada_id = :entrada_id";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':entrada_id',$entrada_id,PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();
                if(count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios[] = new Comentario(
                                $fila['id'], $fila['autor_id'],$fila['entrada_id'], $fila['titulo'], $fila['texto'], $fila['fecha']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $comentarios;
    }
    
    public static function contrarComentariosPorUsuario($conexion,$id_usuario){
        $total_comentarios ='';
        if(isset($conexion)){
            try{  
                $sql="SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autor_id";
                $sentencia = $conexion->prepare($sql);
                $sentencia ->bindParam(':autor_id',$id_usuario,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado= $sentencia ->fetch();
                
                if(!empty($resultado)){
                   $total_entradas =$resultado['total_comentarios'];
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        
        return $total_entradas;
    }
}