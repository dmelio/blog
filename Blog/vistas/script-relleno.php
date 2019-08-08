<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';


Conexion::abrirConexion();


$nomUsuario = '';
for ($i = 1; $i <= 100; $i++) {
    $nomUsuario = 'usuario' . $i;
    //$nombre=$nomUsuario;
    $email = $nomUsuario . '@' . sa(5) . '.com';
    $password = password_hash('123456', PASSWORD_DEFAULT);

    $usuario = new Usuario('', $nomUsuario, $email, $password, '', '');
    RepositorioUsuario::insertarUsuario(Conexion::obtenerConexion(), $usuario);
}




$titEntradas = '';
for ($i = 1; $i <= 100; $i++) {
    $titEntradas = 'titulo' . $i;
    //$titulo = titulosEntradas(100);
    $url = $titEntradas;
    $texto = lorem();
    $autor = rand(1, 100);

    $entrada = new Entrada('', $autor, $url, $titEntradas, $texto, '', '');
    RepositorioEntrada::insertarEntrada(Conexion::obtenerConexion(), $entrada);
}



$titComent = '';
for ($i = 1; $i <= 100; $i++) {
    //$titulo = titulosComentarios(100);
    $titComent = 'comentario' . $i;
    $texto = lorem();
    $autor = rand(1, 100);
    $entrada = rand(1, 100);

    $comentario = new Comentario('', $autor, $entrada, $titComent, $texto, '');
    RepositorioComentario::insertarComentario(Conexion::obtenerConexion(), $comentario);
}

function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio.=$caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}

function lorem() {
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu vestibulum ex, eget ultricies diam. Ut eu ultrices nibh. Phasellus et lectus urna. Maecenas mi magna, consequat ac consequat et, mattis id erat. Nunc facilisis pulvinar tellus. Pellentesque rutrum, nulla eget faucibus aliquam, ipsum ex luctus lectus, sit amet vehicula lacus lacus et urna. Quisque nec faucibus sem. Suspendisse at condimentum nisi, sed rutrum lorem. Proin sem est, consectetur sed facilisis sit amet, eleifend quis elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

Aenean pretium augue non neque vehicula, id lobortis erat mattis. Donec nec elit ac justo tincidunt ullamcorper eu id purus. Pellentesque consectetur nibh non urna finibus, sit amet accumsan quam iaculis. Sed gravida sagittis nibh, sed lobortis sem porta quis. Sed tincidunt semper nisl, sed interdum est tristique at. Vestibulum posuere mauris in ultricies dapibus. Ut ullamcorper suscipit dapibus. Integer dictum ligula vitae leo lobortis, ut lobortis sem commodo. Nullam sit amet porttitor libero, eget congue lectus. Phasellus nec metus laoreet, laoreet lorem a, volutpat augue. Vivamus eget finibus lectus, nec sodales lacus. Mauris blandit fringilla molestie. Etiam dictum ex dui, eu aliquet nunc elementum nec.

Pellentesque accumsan quis odio non congue. Proin quam massa, scelerisque congue ornare ac, accumsan et nisl. Donec nibh magna, tincidunt sed massa eget, pretium dignissim ligula. Nunc ultricies enim at mollis lacinia. Duis erat libero, ultricies sit amet ligula vel, faucibus auctor orci. Donec lobortis vitae ligula quis pretium. Suspendisse ut pretium diam, vitae bibendum nibh. Mauris consequat, mauris ut tempor faucibus, erat risus iaculis dolor, ac fermentum erat sem in ante. Phasellus congue, neque ac placerat consequat, nunc augue rutrum felis, eget elementum turpis ex non lacus. Maecenas id felis sit amet magna rhoncus hendrerit in ut sem. Integer eget dui sed est interdum tincidunt. Praesent dignissim dolor justo, eget ultricies dolor condimentum ac.

Suspendisse vitae rhoncus neque. Integer feugiat, sem nec tempor laoreet, nunc nisl vehicula leo, pharetra iaculis libero sem vel purus. Aliquam eget posuere est, in hendrerit ex. Proin mattis libero ante. Vivamus semper magna non eleifend consectetur. Vivamus non pharetra sem. Interdum et malesuada fames ac ante ipsum primis in faucibus.

Ut vitae risus sagittis, faucibus tortor vel, placerat neque. Aliquam sit amet maximus ligula, vitae mattis turpis. Sed ullamcorper sem eget velit pellentesque varius. Integer ullamcorper tellus ac ligula aliquet, eu pharetra arcu porta. Curabitur efficitur leo in venenatis tincidunt. Suspendisse quis ligula in justo faucibus feugiat. Pellentesque elementum orci nisl, quis tristique turpis blandit ac. Integer non dignissim augue. Mauris in velit sed dui tincidunt porttitor. Donec vitae eros id elit sollicitudin sagittis in ac nisl. Aenean faucibus nisl id magna condimentum imperdiet. In et cursus nulla, id scelerisque mauris. Suspendisse malesuada odio in euismod tincidunt. Sed porta facilisis arcu varius tincidunt. ';

    return $lorem;
}
