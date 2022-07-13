<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

            <div id="content">

                <div id="inner-content" class="wrap row between-md">

                    <div id="main" class="col-xs-12 col-md-8" role="main">



                        <!--Widget para publicidad ancho de contenido-->
                        <?php get_sidebar('publi_ac'); ?>
                        <!--Fin widget publicidad ancho contenido-->

                        <h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>

                        <?php

                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $modificar_query['paged'] = $paged;
                        //$modificar_query['post_type'] = 'post';


                        //$modificar_query['posts_per_page'] = 15;
                        $modificar_query['tax_query'] = array(
                            array(
                                'taxonomy'  => 'tipomultimedia',
                                'field'     => 'slug',
                                'terms'     => 'gastronomia', // exclude media posts in the news-cat custom taxonomy
                                'operator'  => 'NOT IN'
                            ));

                        $args = array_merge($wp_query->query_vars, $modificar_query);



                        // Pagination fix
                        $temp_query = $wp_query;
                        $wp_query   = NULL;
                        $wp_query   = new WP_query($args);

                        ?>

                        <?php if (have_posts()) : ?>

                        <div id="masonry" class="row between-sm">

                            <!--                                <div class="sizer masonry--sizer"></div>-->
                            <!--                                <div class="sizer gutter--sizer"></div>-->

                            <?php while (have_posts()) : the_post(); ?>

                                <div class="item--masonry">

                                    <?php get_template_part( 'content', 'multimedia_thumb' );	?>

                                </div> <!--/.item--masonry-->

                            <?php endwhile; ?>

                        </div> <!--/#masonry-->

                        <?php bones_page_navi(); ?>

                    </div>



                    <div class="col-xs-12 col-md-4">

                        <?php get_sidebar('principal'); ?>

                    </div>

                    <?php else : ?>



                        <?php //get_template_part( 'content', 'sin_noticias' );	?>

                        <article id="post-not-found" class="hentry cf">
                            <header class="article-header">
                                <h1>¡Información no disponible!</h1>
                            </header>
                            <section class="entry-content">

                                <p>La página a la que estas intentando acceder no existe o no esta disponible en este momento. <br/>
                                    Podés seguir navegando el portal <a href="<?php echo home_url(); ?>">Ingenierowhite.com</a> volviendo a la página de inicio, o utilizar el buscador para encontrar la información que necesitás.
                                    También podes recorrer las secciones y páginas de este sitio para informarte de lo que esta pasando en <strong>Ingeniero White</strong> y la zona.
                                </p>

                            </section>

                        </article>



                    <?php endif; ?>

                    <?php
                        wp_reset_postdata();

                        // Reset main query object
                        $wp_query = NULL;
                        $wp_query = $temp_query;
                    ?>

                </div>

            </div>

<?php get_footer(); ?>