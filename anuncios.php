<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Anuncio</h1>
        <?php 
            $limite = 10000;
            include 'includes/templates/anuncio.php';
        ?>
    </main>

<?php
    incluirTemplate('footer');
?>