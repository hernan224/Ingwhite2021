<?php global $show_th_header; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

    <?php if($show_th_header) : ?>
    <header class="article-header">

        <p class="byline vcard">
            <?php
            $agenda_post_type = 'tribe_events';
           if ( $agenda_post_type == get_post_type() ){
              echo '<a class="categoria-noticia" href="'.site_url( "/agenda" ).'">Agenda</a>';
           }else{
                $category = get_the_category();
                if($category[0]){
                    echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                }

           }  ?>

<!--            <span class="fecha-noticias"> --><?php //echo get_the_time('d/m/Y') ?><!-- </span>-->

<!--            <span class="compartir">--><?php //echo do_shortcode ("[sharify]"); ?><!--</span>-->

            <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
        </p>
        <?php
            /**
             * SHARING BUTTONS
             */
            // Link y texto apra compartir
            $linkname = urlencode(get_the_title($id_post));
            $linkurl  = urlencode(get_the_permalink($id_post));
        ?>
        <div class="thumb-share">
            <!-- Sharingbutton Facebook -->
            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                </div>
            </div>
            </a>

            <!-- Sharingbutton Twitter -->
            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=<?= $linkname ?>&amp;url=<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                </div>
            </div>
            </a>

            <!-- Sharingbutton WhatsApp -->
            <a class="resp-sharing-button__link" href="whatsapp://send?text=<?= $linkname ?>%20<?= $linkurl ?>" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
        <?php
        // if ( function_exists( 'sharing_display' ) ) {
        //     echo '<div class="thumb-share">';
        //     sharing_display( '', true );
        //     echo '</div>';
        // }        ?>
    </header>
    <?php endif; ?>
    <section class="entry-content cf">

        <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.

                $factor = 1.7;
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

            <?php the_excerpt(); ?>

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
