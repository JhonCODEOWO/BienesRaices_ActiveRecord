<?php
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor">
        <h1>Contactanos</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="image-contactanos">
        </picture>

        <h2>Llene el formulario del contacto</h2>
        <!-- Fieldset agrupa campos que están relacionados -->
        <form class="formulario" action="">
            <fieldset>
                <legend>Información personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tú nombre">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tú correo electrónico">
                <label for="telefono">Telefono</label>
                <input type="tel" id="telefono" placeholder="Tú número telefónico">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" cols="30" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o compra</label>
                <select name="" id="opciones">
                    <option value="" disabled selected>Seleccione una</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">
                    <label for="contactar-email">Email</label>
                    <input type="radio" value="Email" name="contacto" id="contactar-email">
                </div>
                <p>Si eligió telefono elija la hora y fecha para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" name="" id="fecha">
                <label for="hora">Hora</label>
                <input type="time" name="" id="hora" min="09:00" max="10:00">
            </fieldset>

            <input type="submit" class="boton-verde" value="Envíar">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>