<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';

class RepositorioEntrada {

    public static function insertarEntrada($conexion, $entrada) {
        $entrada_insertada = false;
        if (isset($conexion)) {
            try {

                // preguntar a profe error: Notice: Only variables should be passed by reference in 
                $sql = "INSERT INTO entradas(autor_id,url,titulo,texto,fecha,activa)VALUES(:autor_id,:url,:titulo,:texto,NOW(),0)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $entrada->obtenerAutorId(), PDO::PARAM_STR);
                $sentencia->bindParam(':url', $entrada->obtenerUrl(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $entrada->obtenerTitulo(), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $entrada->obtenerTexto(), PDO::PARAM_STR);

                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $entrada_insertada;
    }

    public static function obtenerTodasPorFechaDescendiente($conexion) {
        $entradas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function obtenerEntradaPorUrl($conexion, $url) {
        $entrada = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url LIKE :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new Entrada(
                            $resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']
                    );
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }

        return $entrada;
    }

    public static function obtenerEntradasAlAzar($conexion, $limite) {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $limite ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function contrarEntradasActivasUsuario($conexion, $id_usuario) {
        $total_entradas = '';
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa =1";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    public static function contrarEntradasInactivasUsuario($conexion, $id_usuario) {
        $total_entradas = '';
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa =0";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    public static function obtenerEntradasUsuarioFechaDescendente($conexion, $id_usuario) {
        $entradas_obtenidas = [];
        if (isset($conexion)) {
            try {
                $sql = "Select a.id,a.autor_id,a.url,a.titulo,a.fecha,a.activa,Count(b.id) as 'cantidadComentarios' 
                         FROM entradas a 
                         LEFT JOIN comentarios b ON a.id=b.entrada_id 
                         WHERE a.autor_id = :autor_id
                         GROUP BY a.id 
                         ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(
                            new Entrada(
                                    $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']),
                            $fila['cantidadComentarios']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }

    public static function tituloExiste($conexion, $titulo) {
        $titulo_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE titulo= :titulo ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)){
                    $titulo_existe=true;
                }else{
                    $titulo_existe=false;
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $titulo_existe;
    }
    
     public static function urlExiste($conexion, $url) {
        $url_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url= :url ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)){
                    $url_existe=true;
                }else{
                    $url_existe=false;
                }
            } catch (PDOException $ex) {
                print'ERROR' . $ex->getMessage();
            }
        }
        return $url_existe;
    }

}
