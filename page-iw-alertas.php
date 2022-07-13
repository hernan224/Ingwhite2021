<?php
/*
 Template Name: IW Alertas
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

            <div id="content" class="alertas--contenido_general">

                <div id="inner-content" class="wrap row between-md">

                    <div id="main" class="col-xs-12 col-md-8" role="main">
                        <h1 class="archive-title h2"><?php echo get_the_title(); ?></h1>

                        <div id="iwAlertasSection" class="contenedor-iw-alertas">
                            <div class="row alert-preloader">
                                <div class="col-xs center-xs middle-xs">
                                    <img src="<?= get_stylesheet_directory_uri().'/library/images/cargando.gif' ?>" alt="Buscando alertas...">

                                </div>
                            </div>

                        </div> <!--/#masonry-->
                    </div>

                    <div class="col-xs-12 col-md-4">

                        <?php get_sidebar('principal'); ?>

                    </div>



                </div>

            </div>


<?php get_footer(); ?>
