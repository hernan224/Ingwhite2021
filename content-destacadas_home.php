<?php
//Array con los ids de los posts que ya se mostraron
global $posts_excluidos;

/** Preparando el query para las noticias destacadas **/

$post_por_pagina = 3;
$args_destacados = array(
    'post_type' => 'post',
    //'articulo_destacado' => 'articulo-destacado',
    'tax_query' => array(
        array(
            'taxonomy' => 'articulo_destacado',
            'field'    => 'slug',
            'terms'    => 'articulo-destacado',
        ),
    ),
    'posts_per_page' => $post_por_pagina,
    'fields' => 'ids'
);

$id_noticias_destacadas = get_posts( $args_destacados );

//echo count($id_noticias_destacadas);

if (count($id_noticias_destacadas) == $post_por_pagina) :
    ?>

    <section class="noticias_destacadas--home">
        <div class="row wrap between-md">
            <div class="col-xs-12 col-md-8">
                <?php $id_post = $id_noticias_destacadas[0]; //primer elemento ?>

                <article id="post-<?php echo $id_post; ?>" class="nota--destacada destacada--principal" role="article">
                    <figure>
                        <a href="<?php echo get_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>">
                            <?php

                            if ( has_post_thumbnail($id_post) ) {

                                $factor = 1.7;
                                $ancho_th = 750;
                                $alto_th = $ancho_th/$factor;
                                echo get_the_post_thumbnail($id_post, array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" ));
                            }

                            ?>

                        </a>
                    </figure>

                    <header class="article-header">

                        <p class="byline vcard">
                            <?php
                            $category = get_the_category($id_post);
                            if($category[0]){
                                echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                            }
                            ?>

                            <span class="fecha-noticias"> <?php echo get_the_time('d/m/Y', $id_post) ?> </span>

                            <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                        </p>

                        <h1 class="h2 entry-title"><a href="<?php echo get_the_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>"><?php echo get_the_title($id_post); ?></a></h1>

                    </header>
                </article>

            </div> <!--/.nota destacada principal-->

            <div class="col-xs-12 col-md-4">

                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-12">

                        <?php $id_post = $id_noticias_destacadas[1]; //segundo elemento ?>
                        <article id="post-<?php echo $id_post; ?>" class="nota--destacada destacada--principal" role="article">
                            <figure>
                                <a href="<?php echo get_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>">
                                    <?php

                                    if ( has_post_thumbnail($id_post) ) {

                                        $factor = 1.7;
                                        $ancho_th = 480;
                                        $alto_th = $ancho_th/$factor;
                                        echo get_the_post_thumbnail($id_post, array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" ));
                                    }

                                    ?>

                                </a>
                            </figure>

                            <header class="article-header">

                                <p class="byline vcard">
                                    <?php
                                    $category = get_the_category($id_post);
                                    if($category[0]){
                                        echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                                    }
                                    ?>

                                    <span class="fecha-noticias"> <?php echo get_the_time('d/m/Y', $id_post) ?> </span>

                                    <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                                </p>

                                <h1 class="h4 entry-title"><a href="<?php echo get_the_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>"><?php echo get_the_title($id_post); ?></a></h1>

                            </header>
                        </article>

                    </div> <!--/.destacada secundaria 1-->

                    <div class="col-xs-12 col-sm-6 col-md-12">

                        <?php $id_post = $id_noticias_destacadas[2]; //segundo elemento ?>
                        <article id="post-<?php echo $id_post; ?>" class="nota--destacada destacada--principal" role="article">
                            <figure>
                                <a href="<?php echo get_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>">
                                    <?php

                                    if ( has_post_thumbnail($id_post) ) {

                                        $factor = 1.7;
                                        $ancho_th = 480;
                                        $alto_th = $ancho_th/$factor;
                                        echo get_the_post_thumbnail($id_post, array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" ));
                                    }

                                    ?>

                                </a>
                            </figure>

                            <header class="article-header">

                                <p class="byline vcard">
                                    <?php
                                    $category = get_the_category($id_post);
                                    if($category[0]){
                                        echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                                    }
                                    ?>

                                    <span class="fecha-noticias"> <?php echo get_the_time('d/m/Y', $id_post) ?> </span>

                                    <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                                </p>

                                <h1 class="h4 entry-title"><a href="<?php echo get_the_permalink($id_post) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=> $id_post)); ?>"><?php echo get_the_title($id_post); ?></a></h1>

                            </header>
                        </article>

                    </div> <!--/.destacada secundaria 2-->

                </div>

            </div>
        </div>
    </section> <!--/.noticias_destacadas--home-->

<?php endif;
$posts_excluidos = array_merge($posts_excluidos, $id_noticias_destacadas);
//print_r($posts_excluidos);
wp_reset_postdata();?>
