<?php
/*
 *
 * GUIA COEMRCIAL ARCHIVE TEMPLATE
 *
 */
?>

<?php get_header(); ?>

            <div id="content" class="guia--contenido_general">

                <div id="inner-content" class="wrap row between-md">

                    <div id="main" class="col-xs-12" role="main">

                        <!--Fin widget publicidad ancho contenido-->
<!--                        --><?php
//
//                        print_r($query_terms);
//                        ?>

                        <h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>


                        <!--BUSCADOR GENERAL DE COMERCIOS-->
                        <?php //echo do_shortcode('[su_spoiler title="Ver más información" open="no" style="default" icon="plus-circle" anchor="" class="comercio-mas-info"]<h4>Acá no hay nada para mostrar</h4>[/su_spoiler]');?>
                        <?php
                        $my_search = new WP_Advanced_Search('guia-form');
                        $my_search->the_form();
                        ?>

                        <div id="wpas-results" class="contenedor-guia-comercial">


                        </div> <!--/#masonry-->



                    </div>



                </div>

            </div>

<?php get_footer(); ?>