<?php
    require '../includes/app.php';
    estaAutenticado();
    use App\Propiedad;

    $resultado = $_GET['registrado'] ?? null;
    incluirTemplate('header');

    //Implementar método para obtener todas las propiedades usando active record
    $propiedades = Propiedad::all();


    //Eliminar registro
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        //Validamos que sea verdadero e int la variable $id
        if ($id) {

            //obtenemos la propiedad como objeto
            $propiedad = Propiedad::find($id);
            //Eliminamos en base a la instancia de objeto recibida..
            $resultado = $propiedad -> delete();

            if ($resultado) {
                header('Location: /bienes_raices/admin/index.php?resultado=3');
            }
        }
    }
?>

    <main class="contenedor">
        <h1>Administrador de la página</h1>
        <?php if ($resultado == 1) { ?>
            <p class="alerta exito">El registro se ha agregado correctamente</p>
        <?php } elseif($resultado == 2) {?>
            <p class="alerta exito">El registro se ha actualizado correctamente</p>
        <?php } elseif($resultado == 3) {?>
            <p class="alerta exito">El registro se ha eliminado correctamente</p>
        <?php } ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
        
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($propiedades as $propiedad) { ?>
                <tr>
                    <td> <?php echo $propiedad -> id; ?> </td>
                    <td> <?php echo $propiedad -> titulo; ?> </td>
                    <td> <?php echo $propiedad -> precio; ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad -> imagen; ?>" alt="Imagen registrada">  </td>
                    <td> 
                         <form method="POST" class="w-100">
                            <!-- Creamos un input invisible que contenga el id del registro -->
                            <input type="hidden" name="id" value="<?php echo $propiedad -> id; ?>">
                            <input type="submit" class="boton-rojo" value="Eliminar">
                         </form> 
                         <a href="propiedades/actualizar.php?id=<?php echo $propiedad -> id; ?>" class="boton-verde-block">Actualizar</a> 
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>