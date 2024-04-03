<?php
require '../../includes/app.php'; 

use App\Propiedad;

$auth = estaAutenticado();

//Base de datos
conectarDB();

//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query(conectarDB(), $consulta);
//Templates
incluirTemplate('header');

$propiedad = new Propiedad;

//Crear arreglo con errores. Aqui se ve el uso de un método que se comparte sin instanciar la clase lo cual hace que obtengamos el anterior arreglo
$errores = Propiedad::getErrores();

//Si el metodo de respuesta es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Crea una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    //Crear carpeta
    $carpeta = '../../imagenes/';

    //Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Realiza un resize a la imagen con intervention
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        // $manager = new Image(Driver::class);
        // $image = $manager->read($_FILES['imagen']['tmp_name']);
        // $image->cover(800, 600);

        //Convertir peso de imagen a MB
        $size = round($_FILES['propiedad']['size']['imagen'] / 1048576, 4);

        //Verificar que el peso sea el permitido por el servidor
        if ($size < 10) {
            //Setea el nombre de la imagen
            $propiedad->setImagen($nombreImagen);
        }else{
            $propiedad ->setImagen('OUT_OF_SIZE');
        }
    }

    //Validar datos retorna el arreglo con los errores encontrados
    $errores = $propiedad->validar();

    //Revisamos que el arreglo de erores esté vacío
    if (empty($errores)) {

        //Si la carpeta no existe...
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
            chmod(CARPETA_IMAGENES, 0777);
        }

        move_uploaded_file($_FILES['propiedad']['tmp_name']['imagen'], CARPETA_IMAGENES . $nombreImagen);

        //Guardar en la base de datos
        $propiedad->guardar();

        if ($resultado) {
            echo 'insertado correctamente';
            //Redireccionar a la página inicial
            header('Location: /bienes_raices/admin/index.php?registrado=1');
        }
    } else {
    }
}
?>

<main class="contenedor">
    <h1>Crea nuevas propiedades</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div style="text-align:center; text-transform:uppercase; color:white; margin-top:1rem; padding:.5rem; background-color: red;">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form action="" class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear publicación" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>