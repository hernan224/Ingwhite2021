<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap row between-md">

						<div id="main" class="col-xs-12 col-md-8" role="main">

                            <!--Widget para publicidad ancho de contenido-->
                            <?php get_sidebar('publi_ac'); ?>
                            <!--Fin widget publicidad ancho contenido-->

							<?php if (is_category()) { ?>
                                <header class="header-archive">
                                    <strong class="cat-archive h5">Sección:</strong>

                                    <h1 class="archive-title h2"><?php single_cat_title(); ?></h1>
                                </header>

							<?php } elseif (is_tag()) { ?>
                                <header class="header-archive"><strong class="cat-archive h5">Etiqeuta:</strong>

                                    <h1 class="archive-title h2">
                                        <?php single_tag_title(); ?>
                                    </h1>
                                </header>
							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
                                <header class="header-archive"><strong class="cat-archive h5">Autor:</strong>

                                    <h1 class="archive-title h2">
                                        <?php the_author_meta('display_name', $author_id); ?>
                                    </h1></header>
							<?php } elseif (is_day()) { ?>
                                <header class="header-archive"><strong class="cat-archive h5">Archivo:</strong>

                                    <h1 class="archive-title h2">
                                        <?php the_time('l, j de F de Y'); ?>
                                    </h1></header>

							<?php } elseif (is_month()) { ?>
                                <header class="header-archive"><strong class="cat-archive h5">Archivo:</strong>

                                    <h1 class="archive-title h2">
                                        <?php the_time('F Y'); ?>
                                    </h1></header>

							<?php } elseif (is_year()) { ?>
                                <header class="header-archive"><strong class="cat-archive h5">Archivo:</strong>

                                    <h1 class="archive-title h2">
                                        <?php the_time('Y'); ?>
                                    </h1></header>
							<?php } ?>


							<?php if (have_posts()) : ?>

                            <div id="masonry" class="row between-sm">

<!--                                <div class="sizer masonry--sizer"></div>-->
<!--                                <div class="sizer gutter--sizer"></div>-->

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
