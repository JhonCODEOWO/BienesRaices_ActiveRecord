<?php
    require 'includes/app.php';
    $db = conectarDB();

    //echo $_SERVER['REQUEST_METHOD'];
    $errores = [];

    //autenticar el usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Valida si el dato almacenado es de tipo email, devolviendo false y true
        $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        //var_dump($email);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }

        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if (empty($errores)) {
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);
            //var_dump($resultado);
            //Si el resultado obtuvo 0 filas entonces...
            if ($resultado -> num_rows == 0) {
                $errores[] = "El usuario que escribiste no existe";
            }else{
                //Asignamos como arreglo asociativo el resultado a una variable
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto usando un hash devuelve un true o un false y recibe primero la contraseña en formato normal, y como segundo argumento el hash
                $auth = password_verify($password, $usuario['password']);
                //var_dump($auth);
                if ($auth) {
                    //Usuario autenticado
                    session_start();

                    //Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    //var_dump($_SESSION);
                    header('Location: /bienes_raices/admin/index.php');
                }else{
                    //Se ha ingresado la contraseña incorrecta
                    $errores[] = "Has ingresado la contraseña incorrecta";
                }
            }
        }
    }


    // require 'includes/funciones.php';
    incluirTemplate('header', $inicio = false);
?>

    <main class="contenedor">
        <h1>Iniciar sesión</h1>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php } ?>
        <form class="formulario" action="" method="POST">
            <fieldset>
                <legend>Email y password</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Tu contraseña" required>

                <input class="boton boton-verde" type="submit" value="Iniciar sesión">
            </fieldset>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>