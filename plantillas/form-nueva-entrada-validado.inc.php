<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo de la publicacion"
           <?php $validador->mostrarTitulo();?>>
    <?php $validador->mostrarErrorTitulo(); ?>
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type="text" name="url" class="form-control" id="url" placeholder="Direccion de la publicacion"
           <?php $validador->mostrarUrl();?>>
    <?php $validador->mostrarErrorUrl(); ?>
</div>
<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" name="texto" rows="10" id="contenido" placeholder="Escribe el contenido de tu publicacion"
              ><?php $validador->mostrarTexto() ?></textarea>
    <?php $validador->mostrarErrorTexto(); ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_publica) echo 'checked'; ?>
               >Marca esta opcion para publicar
    </label>
</div>
<button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
