<?php get_header(); ?>

        <div id="content">

            <div id="inner-content" class="wrap row between-md">

                <div id="main" class="col-xs-12 col-md-8" role="main">
<!--						<h1 class="archive-title"><span>--><?php //_e( 'Search Results for:', 'bonestheme' ); ?><!--</span> --><?php //echo esc_attr(get_search_query()); ?><!--</h1>-->

                    <!--Widget para publicidad ancho de contenido-->
                    <?php get_sidebar('publi_ac'); ?>
                    <!--Fin widget publicidad ancho contenido-->

					<header class="header-archive">
						<strong class="cat-archive h5"><?php _e( 'Search Results for:', 'bonestheme' ); ?></strong>

						<h1 class="archive-title h2"><?php echo esc_attr(get_search_query()); ?></h1>
					</header>


                    <?php if (have_posts()) : ?>

                        <div id="masonry" class="row between-sm">

<!--                            <div class="sizer masonry--sizer"></div>-->
<!--                            <div class="sizer gutter--sizer"></div>-->

                            <?php while (have_posts()) : the_post(); ?>

                                <div class="item--masonry">

                                    <?php get_template_part( 'content', 'noticias' );	?>

                                </div> <!--/.item--masonry-->

                            <?php endwhile; ?>

                        </div> <!--/#masonry-->

								<?php bones_page_navi(); ?>

				</div>

				<div class="col-xs-12 col-md-4">

					<?php get_sidebar('principal'); ?>

				</div>

				<?php else : ?>

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

			</div>

		</div>

<?php get_footer(); ?>
