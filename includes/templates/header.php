<?php
    //Si ya está iniciada la variable sesión no hace nada, en caso contrario la inicia.
    if (isset($_SESSION)) {
        
    }else{
        session_start();
    }

    //Si no existe un valor en login entonces la variable será nula
    $auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/bienes_raices/build/css/app.css">
    <link rel="stylesheet" href="/bienes_raices/build/css/appAlter.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienes_raices/index.php" class="logo">
                    BienesRaices
                </a>
                
                <div class="mobile-menu">
                    <img src="/bienes_raices/build/img/barras.svg" alt="">
                </div>

                <div class="derecha">
                    <img src="/bienes_raices/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contactanos</a>
                        <!-- Si la variable auth es true muestra el elemento de cerrar sesión -->
                        <?php if($auth) {?>
                            <a href="/bienes_raices/cerrar-sesion.php">Cerrar sesión</a>
                        <?php } ?>
                    </nav>
                </div>
            </div>

            <?php if ($inicio) { ?>
                <h1>Venta de casas y departamentos exclusivos de Lujo</h1>
            <?php } ?>
            
        </div>
    </header>