<?php

require '../../includes/app.php';

use App\Propiedad;

//Uso de la libreria intervention image
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

//Verificar login
estaAutenticado();

//Validar url get para evitar hackeos
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
}

//Guardamos en una variable el resultado, como la plantilla usa un objeto con nombre $propiedad podemos se debe nombrar igual para que acceda a sus propiedades NOTA: Recuerda que al usar find ya se genera y retorna un objeto por lo que la variable $propiedad ahora será una instancia del objeto aunque no la hayamos instanciado directamente en el código.
$propiedad = Propiedad::find($id);

//Base de datos
$db = conectarDB();

//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query(conectarDB(), $consulta);
//Templates
incluirTemplate('header');

//Crear arreglo con errores accediendo al método de la clase que es estático y con el objeto ya creado anteriormente.
$errores = Propiedad::getErrores();

//Si el metodo de respuesta es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Asignar los atributos haciendo uso de arreglos asociativos en formularios
    $args = $_POST['propiedad'];

    //Setear nuevos valores a la instancia del objeto en memoria siempre
    $propiedad->sincronizar($args);

    //Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Subida de archivos
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        //Generar el peso en MB
        $size = round($_FILES['propiedad']['size']['imagen'] / 1048576, 4);

        //Validar que la imagen sea del tamaño admitido por el servidor
        if ($size < 10) {
            //Setea el nombre de la imagen
            $propiedad->setImagen($nombreImagen);
        } else {
            $propiedad->setImagen('OUT_OF_SIZE');
        }
    }

    //Validamos los datos del objeto y almacenamos el retorno en un arreglo
    $errores = $propiedad->validar();

    //Revisamos que el arreglo de erores esté vacío
    if (empty($errores)) {

        //Si la carpeta no existe...
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
            chmod(CARPETA_IMAGENES, 0777);
        }

        move_uploaded_file($_FILES['propiedad']['tmp_name']['imagen'], CARPETA_IMAGENES . $nombreImagen);

        $propiedad -> guardar();

        if ($resultado) {
            echo 'insertado correctamente';
            //Redireccionar a la página inicial
            header('Location: /bienes_raices/admin/index.php?registrado=2');
        }
    } else {
    }
}
?>

<main class="contenedor">
    <h1>Actualizar propiedad</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div style="text-align:center; text-transform:uppercase; color:white; margin-top:1rem; padding:.5rem; background-color: red;">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>