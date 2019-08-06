<div class="form-group">
    <label>Nombre de usuario</label>
    <input type="text" class="form-control" name="nombre" placeholder="Alias" <?php $validador->mostrarNombre() ?>>
    <?php 
    $validador->mostrarErrorNombre();
    ?>
</div>  
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="usuario@email.com" <?php $validador->mostrarEmail() ?>>
    <?php 
    $validador->mostrarErrorEmail();
    ?>
</div> 
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="clave1">
    <?php 
    $validador->mostrarErrorClave1();
    ?>
</div> 
<div class="form-group">
    <label>Confirmar contraseña</label>
    <input type="password" class="form-control" name="clave2">
    <?php 
    $validador->mostrarErrorClave2();
    ?>
</div> 
<br>
<button type="reset" class="btn btn-default" >Limpiar formulario</button>
<button type="submit" class="btn btn-default" name="enviar" >Enviar Datos</button>