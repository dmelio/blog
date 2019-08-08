<!DOCTYPE html>
<?php error_reporting(0); ?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if(!isset($titulo) || empty($titulo)){
            $titulo = 'Blog de Mierda';
        }
        echo "<title>$titulo</title>";
        ?>
        <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>fontawesome.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet">
    </head>
    <body>