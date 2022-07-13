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
                        $category = get_the_category();
                        if($category[0]){
                            echo '<a class="categoria-noticia" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                        }
                        ?>

                        <span class="fecha-noticias"> <?php echo get_the_time('d/m/Y') ?> </span>

                        <?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('d/m/Y'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                    </p>

                    <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.

                        $factor = 1.7;
                        $ancho_th = 750;
                        $alto_th = round($ancho_th/$factor); ?>

                        <figure>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php //the_post_thumbnail(array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" )); ?>
                              	<?php the_post_thumbnail('full', array( 'class' => " img-responsive" )); ?>
                            </a>
                        </figure>

                    <?php endif; ?>

                    <?php
                    if( $post->post_excerpt ) : ?>
                        <p class="the-excerpt"><?php echo get_the_excerpt() ?></p>
                    <?php endif; ?>

                    <?php
                        // if ( function_exists( 'sharing_display' ) ) {
                            //echo '<div class="thumb-share">';
                            // sharing_display( '', true );
                            //echo '</div>';
                        // }
                    ?>

                    <?php
                        /**
                         * SHARING BUTTONS
                         */
                        // Link y texto apra compartir
                        $linkname = urlencode(get_the_title());
                        $linkurl  = urlencode(get_the_permalink());
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
                    <?php // end sharing buttons ?>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php
                    // the content (pretty self explanatory huh)
                    the_content();

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