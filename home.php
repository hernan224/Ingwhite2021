<?php get_header(); ?>

<?php
    //Array con los ids de los posts que ya se mostraron
    global $posts_excluidos;
    global $show_th_header;

    //Mostrar noticias destacadas unicamente en el Home
    if ( $paged < 2 ) {
        //get_template_part( 'content', 'destacadas_home' );
        /*}*/

        /* Preparar query para noticias destacadas */

        $post_por_pagina = 1;
        $args_destacados = array(
            'post_type' => 'post',
            //'articulo_destacado' => 'articulo-destacado',
            'tax_query' => array(
                array(
                    'taxonomy' => 'articulo_destacado',
                    'field' => 'slug',
                    'terms' => 'articulo-destacado',
                ),
            ),
            'posts_per_page' => $post_por_pagina,
            'fields' => 'ids'
        );

        $id_noticias_destacadas = get_posts($args_destacados);
    }
?>
            <section id="content">

				<div class="wrap row between-md">

                    <div id="main" class="col-xs-12 col-md-8" role="main">


                        <?php if ($paged < 2) : ?>
                        <!-- Alertas en hompage -->
                        <section id="iwAlertasHome" class="swiper-container hidden">
                            <div class="swiper-wrapper">
                            </div>
                            <div class="swiper-pagination"></div>
                        </section>


                        <?php if (count($id_noticias_destacadas) == $post_por_pagina) : ?>
                        <!-- Noticias destacadas -->
                        <section class="noticias_destacadas">

                            <?php $id_post = $id_noticias_destacadas[0]; //primer elemento ?>

                            <article id="post-<?php echo $id_post; ?> cf" class="nota--destacada destacada--principal" role="article">

                                <section class="entry-content cf">

<!--                                    <p class="byline vcard">-->
<!--                                        --><?php
//                                            $category = get_the_category($id_post);
//                                            if($category[0]){
//                                                echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
//                                            }
//                                        ?>
<!---->
<!--                                        <span class="fecha-noticias"> --><?php //echo get_the_time('d/m/Y', $id_post) ?><!-- </span>-->
<!---->
<!--                                    </p>-->

<!--                                    --><?php
//                                        if ( function_exists( 'sharing_display' ) ) {
//                                            echo '<div class="thumb-share">';
//                                            sharing_display( '', true );
//                                            echo '</div>';
//                                        }
//                                    ?>

                                    <?php if ( has_post_thumbnail($id_post) ) :  ?>

                                        <figure>
                                            <a href="<?php echo get_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>">
                                                <?php

                                                    $factor = 1.7;
                                                    $ancho_th = 750;
                                                    $alto_th = round($ancho_th/$factor);
                                                    //echo get_the_post_thumbnail($id_post, array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" ));
                                              			echo get_the_post_thumbnail($id_post, 'full', array( 'class' => " img-responsive" ));

                                                ?>

                                            </a>
                                        </figure>

                                    <?php endif; ?>

                                    <h1 class="h3 entry-title"><a href="<?php echo get_the_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>"><?php echo get_the_title($id_post); ?></a></h1>

                                    <?php echo white_excerpt_by_id($id_post, 50); ?>

                                    <?php
                                        /**
                                         * SHARING BUTTONS
                                         */
                                        // Link y texto apra compartir
                                        $linkname = urlencode(get_the_title($id_post));
                                        $linkurl  = urlencode(get_the_permalink($id_post));
                                    ?>
                                    <span class="share-title">Comparte esto:</span>
                                    <!-- Sharingbutton Facebook -->
                                    <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
                                    <div class="resp-sharing-button resp-sharing-button--facebook "><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    </a>

                                    <!-- Sharingbutton Twitter -->
                                    <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=<?=$linkname?>&amp;url=<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
                                    <div class="resp-sharing-button resp-sharing-button--twitter "><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    </a>

                                    <!-- Sharingbutton WhatsApp -->
                                    <a class="resp-sharing-button__link" href="whatsapp://send?text=<?= $linkname ?>%20<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
                                    <div class="resp-sharing-button resp-sharing-button--whatsapp "><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    </a>

                                </section>
                            </article>

                        </section> <!--/noticias destacadas-->
                                <?php
                                $posts_excluidos = array_merge($posts_excluidos, $id_noticias_destacadas);
                                endif; ?>

                        <?php  endif;

                            //print_r($posts_excluidos);
                            wp_reset_postdata();
                        ?>

                        <!--Widget para publicidad ancho de contenido-->

                        <?php get_sidebar('publi_ac'); ?>

                        <!--Fin widget publicidad ancho contenido-->

                            <?php

                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $modificar_query['paged'] = $paged;
                                //$modificar_query['post_type'] = 'post';
                                    /** Preparando Query principal **/
                                if (isset($posts_excluidos) && (count($posts_excluidos) > 0)){
                                    $modificar_query['post__not_in'] = $posts_excluidos;
                                }

                                //$modificar_query['posts_per_page'] = 15;
    							$modificar_query['category__not_in'] = array(15,16);

                                $args = array_merge($wp_query->query_vars, $modificar_query);

                                $home_query = new WP_query($args);

                                // Pagination fix
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $home_query;

                            ?>

                            <?php if ($home_query->have_posts()) :

                                $i=1;?>

                                <div id="masonry" class="row between-sm">

<!--                                    <div class="sizer masonry--sizer"></div>-->
<!--                                    <div class="sizer gutter--sizer"></div>-->

                               <?php while ($home_query->have_posts()) : $home_query->the_post(); ?>

                                    <?php if ($i === 5 && $paged < 2) :  //Muestro publi interna 1?>

                                        <?php get_sidebar('publi_i1'); ?>

                                        <div class="item--masonry">

                                            <?php get_template_part( 'content', 'noticias' );	?>

                                        </div> <!--/.item--masonry-->

									<?php elseif($i === 7 && $paged < 2) : //Muestro publi internar 4?>

                                        <?php get_sidebar('publi_i4'); ?>

                                        <div class="item--masonry">

                                            <?php get_template_part( 'content', 'noticias' );	?>

                                        </div> <!--/.item--masonry-->

                                    <?php elseif($i === 9 && $paged < 2) : //Muestro publi internar 2?>

                                        <?php get_sidebar('publi_i2'); ?>

                                        <div class="item--masonry">

                                            <?php get_template_part( 'content', 'noticias' );	?>

                                        </div> <!--/.item--masonry-->

									<?php elseif($i === 13 && $paged < 2) : //Muestro publi internar 3?>

                                        <?php get_sidebar('publi_i3'); ?>

                                        <div class="item--masonry">

                                            <?php get_template_part( 'content', 'noticias' );	?>

                                        </div> <!--/.item--masonry-->

                                    <?php else : //Muestro noticia?>

                                        <div class="item--masonry">

                                            <?php get_template_part( 'content', 'noticias' );	?>

                                        </div> <!--/.item--masonry-->

                                    <?php endif; ?>

                                    <?php if ($paged < 2) {
                                        //array_push($posts_excluidos, get_the_ID());
                                        $posts_actuales[] = $post->ID;
                                    } ?>

                                    <?php $i++; ?>

                                <?php endwhile; ?>

                            </div> <!--/#masonry-->


								<?php if( $paged < 2 ):?>
									<div class='pag-ver-mas'> <?php next_posts_link( 'Ver más noticias'  ); ?></div>
								<?php else: 	bones_page_navi();

                                endif;?>




                            <?php else : ?>

<!--                                <div class="col-xs-12">-->

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

<!--                                </div>-->

                            <?php endif; ?>

                        <?php
                            if (isset($posts_actuales) && (count($posts_actuales) > 0)){
                                $posts_excluidos = array_merge($posts_excluidos, $posts_actuales);
                            }

                            wp_reset_postdata();

                            // Reset main query object
                            $wp_query = NULL;
                            $wp_query = $temp_query;
                        //print_r($posts_excluidos);
                        ?>


                    </div>

                    <div class="col-xs-12 col-md-4">

                        <?php get_sidebar('principal'); ?>

                    </div>

				</div>

            </section> <!--/.cuerpo_central--home-->

        <?php  if ($paged < 2) {

            get_sidebar('bottom-home');


        /* Seccion noticias personajes en Home */
            $categoria_query = 'personajes';
            $show_th_header = false;
            include(locate_template('content-cat_home.php'));


            /* Seccion noticias historia en Home */
            $categoria_query = 'historia';
            $show_th_header = false;
            include(locate_template('content-cat_home.php'));

        }
        ?>

<?php get_footer(); ?>