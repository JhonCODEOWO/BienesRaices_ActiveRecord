<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Título</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo de la propiedad" value="<?php echo  s($propiedad -> titulo) ?>">

    <label for="precio">Precio</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio a asignar a la propiedad" value="<?php echo s($propiedad -> precio) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png">

    <?php if($propiedad -> imagen) {?>
        <h3 style="text-align: left; margin: 0;">Imagen actual</h2>
                <img style="width: 30rem;" src="../../imagenes/<?php echo $propiedad -> imagen ?>" alt="imagen_actual">
    <?php } ?>

    <label for="descripcion">Descripcion para los compradores</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10"><?php echo s($propiedad -> descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="propiedades">Propiedades disponibles</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" min="1" value="<?php echo s($propiedad -> habitaciones) ?>">

    <label for="wc">Baños</label>
    <input type="number" name="propiedad[wc]" id="wc" min="1" value="<?php echo s($propiedad -> wc) ?>">

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" min="1" value="<?php echo s($propiedad -> estacionamiento) ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedores_id]">
        <option value="">Seleccione</option>
        <?php while ($vendedores = mysqli_fetch_assoc($resultado)) { ?>
            <!-- <option <?php echo $vendedor === $vendedores['id'] ? 'selected' : ''; ?> value="1"> <?php echo $vendedores['nombre'] . " " . $vendedores['apellidos']; ?> </option> -->
            <option value="1">PRUEBA NADAMAS</option>
        <?php }; ?>
    </select>
</fieldset>-