<?php
/*
 Template Name: Page witout sidebar
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf row">

                    <?php if ( have_posts() ) : ?>
                        <div id="main" class="col-xs-12 col-md-12" role="main">

                            <?php
                            	// Mostrar publicidad ancho contenido
                            	// get_sidebar('publi_ac');
                            ?>

                            <?php while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title h2" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <?php // end article section ?>

							</article>

							<?php endwhile; ?>

						</div>

                    <?php else :

                        get_template_part( 'content', 'sin_noticias' );

                    endif; ?>

				</div>

			</div>

<?php get_footer(); ?>