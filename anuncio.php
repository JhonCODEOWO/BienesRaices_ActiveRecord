<?php
    require 'includes/app.php';
    incluirTemplate('header');

    // require 'includes/config/database.php';
    $db = conectarDB();

    //Obtener id mediante get
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('location: /');
    }

    //Usar id para la consulta
    $query = "SELECT * FROM propiedades INNER JOIN vendedores ON propiedades.vendedores_id = vendedores.id WHERE propiedades.id = $id";
    $resultado = mysqli_query($db,$query);

    if ($resultado -> num_rows == 0) {
        header('Location: /');
    }
    //Convertir a arreglo asociativo
    $propiedad = mysqli_fetch_assoc($resultado);
?>

    <main class="contenedor contenido-centrado seccion">
        <h1>Casa en venta en frente del bosque</h1>
        <img src="<?php echo 'imagenes/'.$propiedad['imagen']; ?>" alt="imagen-depa">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?> </p>
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

            <p> <?php echo $propiedad['descripcion'] ?> </p>
        </div>

        <h2>¿Te interesa esta propiedad? Comunicate con su vendedor</h2>
        <h3>Vendedor: <?php echo $propiedad['nombre']." ".$propiedad['apellidos']; ?></h3>
        <h3>Telefono: <?php echo $propiedad['telefono'] ?></h3>
    </main>

<?php
    incluirTemplate('footer');
?>