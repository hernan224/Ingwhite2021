<?php /** Query para noticias por categoría **/ ?>

<?php  if ( isset($categoria_query) && term_exists($categoria_query, 'category') !== NULL ):

    $cat_objeto = get_category_by_slug( $categoria_query );

    //$args_cat['category_name'] = $categoria_query;
    $args_cat['category__in'] = intval($cat_objeto->term_id);
    $args_cat['posts_per_page'] = 3;
    if (isset($posts_excluidos) && (count($posts_excluidos) > 0)){
        $args_cat['post__not_in'] = $posts_excluidos;
    }

    $query_cat = new WP_query($args_cat);

    if($query_cat->have_posts()): ?>

        <section class="wrap home--noticias_categoria categoria--<?php echo $categoria_query ?>">
            <header class="cabecera--seccion_categoria">
                <h2>
                    <a href="<?php echo get_category_link(intval($cat_objeto->term_id)); ?>"><?php echo $cat_objeto->name ?></a>
                </h2>
            </header>

            <div class="row">

                <?php while ($query_cat->have_posts()) : $query_cat->the_post(); ?>

                    <div class="col-sm-4 col-xs-12">

                        <?php get_template_part( 'content', 'noticias' );	?>

                    </div>

                    <?php
                    $posts_excluidos[] = $post->ID;
                endwhile; ?>

            </div>
        </section>

    <?php endif;
    wp_reset_postdata();
    /* $query_cat->have_posts() */

endif; /* isset($categoria_query) */ ?>
