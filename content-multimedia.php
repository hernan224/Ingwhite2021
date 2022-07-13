
<?php
/*
 * This is the default post format.
 *
 * So basically this is a regular post. if you don't want to use post formats,
 * you can just copy ths stuff in here and replace the post format thing in
 * single.php.
 *
 * The other formats are SUPER basic so you can style them as you like.
 *
 * Again, If you want to remove post formats, just delete the post-formats
 * folder and replace the function below with the contents of the "format.php" file.
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <header class="article-header">

        <h1 class="h3 entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

        <p class="byline vcard">
            <?php
            $category = get_the_terms($post->ID, 'tipomultimedia');

            if(($category)&&(!is_wp_error( $category ))){

                $cat_slug = $category[0]->slug;

                switch ($cat_slug){
                    case 'fotos':
                        $icono_cat = 'camera-retro';
                        break;
                    case 'videos':
                        $icono_cat = 'film';
                        break;
                    case 'audios':
                        $icono_cat = 'microphone';
                        break;
                    case 'textos':
                        $icono_cat = 'book';
                        break;
                    case 'gastronomia':
                        $icono_cat = 'coffee';
                        break;
                    default:
                        $icono_cat = 'bookmark';
                };

                echo '<a class="categoria-multimedia" href="'.get_term_link($category[0]).'" title="'.$category[0]->name.'"><i class="fa fa-lg fa-'.$icono_cat.'"></i> '.$category[0]->name.'</a>';
            }

//            if($category[0]){
//                echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
//            }
//            ?>

<!--            <span class="fecha-noticias"> --><?php //echo get_the_time('d/m/Y') ?><!-- </span>-->

            <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
        </p>

<!--        --><?php //if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
//
//            $factor = 1.7;
//            $ancho_th = 750;
//            $alto_th = $ancho_th/$factor; ?>
<!---->
<!--            <figure>-->
<!--                <a href="--><?php //the_permalink() ?><!--" rel="bookmark" title="--><?php //the_title_attribute(); ?><!--">-->
<!--                    --><?php //the_post_thumbnail(array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" )); ?>
<!--                </a>-->
<!--            </figure>-->
<!---->
<!--        --><?php //endif; ?>

<!--        --><?php
//        if( $post->post_excerpt ) : ?>
<!--            <p class="the-excerpt">--><?php //echo get_the_excerpt() ?><!--</p>-->
<!--        --><?php //endif; ?>

        <?php/*
        if ( function_exists( 'sharing_display' ) ) {
            //echo '<div class="thumb-share">';
            sharing_display( '', true );
            //echo '</div>';
        }*/
        ?>

    </header> <?php // end article header ?>

    <section class="entry-content cf" itemprop="articleBody">
        <?php
        // the content (pretty self explanatory huh)
        //the_content();

        /*** Armar Shortcode para mostrar galeria de Flickr ***/
        //$datos_multimedia = get_post_custom($post->ID);
        //print_r($datos_multimedia);
        $gal = get_post_meta($post->ID, 'galeria_flickr', true);
        $origen_gal = get_post_meta($post->ID, 'origen_galeria', true);
        $id_gal = get_post_meta($post->ID, 'id_galeria', true);
        $id_usuario = get_post_meta($post->ID, 'id_usuario', true);
        $shortcode_gal = '';

        if($gal == 1){

            $contenido = get_the_content();
            $shortcode_gal .= '[flickr_';

            switch ($origen_gal) {
                case 'photostream':
                    $shortcode_gal .= $origen_gal;
                    if($id_usuario != ''){
                        $shortcode_gal .= ' user_id="';
                        $shortcode_gal .= $id_usuario;
                        $shortcode_gal .= '"';
                    }
                    break;
                case 'set':
                    $shortcode_gal .= $origen_gal;
                    if($id_usuario != ''){
                        $shortcode_gal .= ' user_id="';
                        $shortcode_gal .= $id_usuario;
                        $shortcode_gal .= '"';
                    }
                    if($id_gal != ''){
                        $shortcode_gal .= ' id="';
                        $shortcode_gal .= $id_gal;
                        $shortcode_gal .= '"';
                    }
                    break;
                case 'gallery':
                    $shortcode_gal .= $origen_gal;
                    if($id_usuario != ''){
                        $shortcode_gal .= ' user_id="';
                        $shortcode_gal .= $id_usuario;
                        $shortcode_gal .= '"';
                    }
                    if($id_gal != ''){
                        $shortcode_gal .= ' id="';
                        $shortcode_gal .= $id_gal;
                        $shortcode_gal .= '"';
                    }
                    break;
                case 'group':
                    $shortcode_gal .= $origen_gal;
                    if($id_gal != ''){
                        $shortcode_gal .= ' id="';
                        $shortcode_gal .= $id_gal;
                        $shortcode_gal .= '"';
                    }
                    break;
                case 'tags':
                    $shortcode_gal .= $origen_gal;
                    if($id_usuario != ''){
                        $shortcode_gal .= ' user_id="';
                        $shortcode_gal .= $id_usuario;
                        $shortcode_gal .= '"';
                    }
                    if($id_gal != ''){
                        $shortcode_gal .= ' tags="';
                        $shortcode_gal .= $id_gal;
                        $shortcode_gal .= '"';
                    }
                    break;
                default:
                    $shortcode_gal .= 'photostream';
            }
            $shortcode_gal .= ' ]';

            if ( shortcode_exists( 'flickr_'.$origen_gal ) || shortcode_exists( 'flickr_photostream') ) {
                //echo do_shortcode($shortcode_gal);
                //echo '<h5>'.$shortcode_gal.'</h5>';
                $contenido.= $shortcode_gal;
                //echo do_shortcode($contenido);
            }

            echo apply_filters( 'the_content', $contenido );

            //echo $shortcode_gal;
        }else{
            the_content();
        }





        /*
         * Link Pages is used in case you have posts that are set to break into
         * multiple pages. You can remove this if you don't plan on doing that.
         *
         * Also, breaking content up into multiple pages is a horrible experience,
         * so don't do it. While there are SOME edge cases where this is useful, it's
         * mostly used for people to get more ad views. It's up to you but if you want
         * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
         *
         * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
         *
        */
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
        ?>
    </section> <?php // end article section ?>

    <!--<footer class="article-footer">

                  <?php /*printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); */?>

                  <?php /*the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); */?>

                </footer> --><?php /*// end article footer */?>

    <?php //comments_template(); ?>

    <?php //disqus_embed('ingwhitetest'); ?>

</article> <?php // end article ?>