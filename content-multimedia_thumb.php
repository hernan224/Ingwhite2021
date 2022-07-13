<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

    <header class="article-header">

        <p class="byline vcard mm-cat">
            <?php
            $category = get_the_terms($post->ID, 'tipomultimedia');

            if(($category)&&(!is_wp_error( $category ))){

                //$icono_cat ='';
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

<!--            <span class="compartir">--><?php //echo do_shortcode ("[sharify]"); ?><!--</span>-->

            <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
        </p>
      	<?php 
      			///// BOTONES ADD TO ANY
      			/*if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
  							echo '<div class="thumb-share">';
                ADDTOANY_SHARE_SAVE_KIT( array(
                  'buttons' => array( 'facebook', 'twitter', 'whatsapp' ),
                  'linkname' => get_the_title(),
                  'linkurl'  => get_the_permalink()
                ) );
  							echo '</div>';
              } */?>
        <?php
        if ( function_exists( 'sharing_display' ) ) {
            echo '<div class="thumb-share">';
            sharing_display( '', true );
            echo '</div>';
        }        ?>
    </header>

    <section class="entry-content cf">

        <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.

                $factor = 1.25;
                $ancho_th = 480;
                $alto_th = $ancho_th/$factor; ?>

            <figure>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail(array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" )); ?>
                </a>
            </figure>

            <h1 class="h4 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

        <?php else : ?>

            <h1 class="h4 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

            <?php //the_excerpt(); ?>

        <?php endif; ?>

    </section>

    <!--                                        <footer class="article-footer cf">-->
    <!--                                            <p class="footer-comment-count">-->
    <!--                                                --><?php //comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
    <!--                                            </p>-->
    <!---->
    <!---->
    <!--                            --><?php //printf( '<p class="footer-category">' . __('filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>
    <!---->
    <!--                          --><?php //the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
    <!---->
    <!---->
    <!--                                        </footer>-->

</article>
