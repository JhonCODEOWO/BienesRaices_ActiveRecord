<?php
//Importar base de datos
$database = conectarDB();

//Realizar consulta
$query = "SELECT * FROM propiedades LIMIT $limite";
$resultado = mysqli_query($database, $query);
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)) { ?>
            <div class="anuncio">
                <img loading="lazy" src="<?php echo 'imagenes/'.$propiedad['imagen']; ?>" alt="anuncio">
                <div class="contenido-anuncio">
                    <h3> <?php echo $propiedad['titulo']; ?></h3>
                    <p> <?php echo $propiedad['descripcion']; ?> </p>
                    <p class="precio"> <?php echo "$".$propiedad['precio']; ?> </p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img loading="lazy" src="build/img/icono_wc.svg" alt="icono baño">
                            <p> <?php echo $propiedad['wc']; ?> </p>
                        </li>
                        <li>
                            <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p> <?php echo $propiedad['estacionamiento']; ?> </p>
                        </li>
                        <li>
                            <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono cuarto">
                            <p> <?php echo $propiedad['habitaciones']; ?> </p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo">
                        Ver propiedad
                    </a>
                </div>
            </div>
    <?php } ?>
</div>
<?php
 //cerrar conexión
    mysqli_close($database);
?>