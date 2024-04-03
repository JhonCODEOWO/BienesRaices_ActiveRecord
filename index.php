<?php
    declare(strict_types = 1);
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium vero laboriosam doloremque omnis voluptatem, adipisci inventore beatae. Qui nihil maiores alias placeat deserunt neque aliquid a quibusdam! Iusto, labore tempore.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono seguridad" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium vero laboriosam doloremque omnis voluptatem, adipisci inventore beatae. Qui nihil maiores alias placeat deserunt neque aliquid a quibusdam! Iusto, labore tempore.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono seguridad" loading="lazy">
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium vero laboriosam doloremque omnis voluptatem, adipisci inventore beatae. Qui nihil maiores alias placeat deserunt neque aliquid a quibusdam! Iusto, labore tempore.</p>
            </div>
        </div>
    </main>

    <section class="contenedor">
        <h2>Casas y depas en venta</h2>
        <?php
            $limite = 3;
            include 'includes/templates/anuncio.php';
        ?>
        <div class="ver todas alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor te contactará en breve</p>
        <a href="contactanos.html" class="boton-amarillo-block">Contacto</a>
    </section>

    
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.jpg">
                        <source srcset="build/img/blog1.webp">
                        <img src="build/img/blog1.jpg" alt="texto-entrada-blog" loading="lazy">
                    </picture>

                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                    </a>

                    <p>
                        Consejo para construir una terraza en el techo de su casa con los mejores materiales y ahorrando dinero
                    </p>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.jpg">
                        <source srcset="build/img/blog1.webp">
                        <img src="build/img/blog1.jpg" alt="texto-entrada-blog" loading="lazy">

                    </picture>

                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                    </a>

                    <p>
                        Consejo para construir una terraza en el techo de su casa con los mejores materiales y ahorrando dinero
                    </p>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <!-- Blockquote usado para colocar testimoniales -->
                <blockquote>
                    El personal se comportó de una buena manera y el servicio fué de alta calidad
                </blockquote>
                <p>- Jonatan Juárez Valera</p>
            </div>
        </section>
    </div>

<?php
    incluirTemplate('footer');
?>