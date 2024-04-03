<?php
    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro blog</h1>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
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
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.webp" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="texto-entrada-blog" loading="lazy">

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
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.webp" type="image/jpeg">
                    <img src="build/img/blog3.jpg" alt="texto-entrada-blog" loading="lazy">

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
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.webp" type="image/jpeg">
                    <img src="build/img/blog4.jpg" alt="texto-entrada-blog" loading="lazy">

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
    </main>

<?php
    incluirTemplate('footer');
?>