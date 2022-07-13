<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap row between-md">

                    <?php if (have_posts()) : ?>
                        <div id="main" class="col-xs-12 col-md-8" role="main">

                        <!--Widget para publicidad ancho de contenido-->
                        <?php get_sidebar('publi_ac'); ?>
                        <!--Fin widget publicidad ancho contenido-->

						<?php while (have_posts()) : the_post(); ?>

							<?php
								/*
								 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
								 *
								 * So this function will bring in the needed template file depending on what the post
								 * format is. The different post formats are located in the post-formats folder.
								 *
								 *
								 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
								 * A SPECIFIC POST FORMAT.
								 *
								 * If you want to remove post formats, just delete the post-formats folder and
								 * replace the function below with the contents of the "format.php" file.
								*/
								get_template_part( 'post-formats/format', get_post_format() );
							?>

						<?php endwhile; ?>

					</div>

                    <div class="col-xs-12 col-md-4">

                        <?php get_sidebar('principal'); ?>

                    </div>

                    <?php else :

                        get_template_part('content', 'sin_noticias');

                    endif; ?>

				</div>

			</div>

<?php get_footer(); ?>
