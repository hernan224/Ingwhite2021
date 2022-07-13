<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>
	<!--<div id="tribe-events-pg-template">-->
    <div class="wrap">



        <div class="row between-md">
            <div class="col-xs-12 col-md-8">
                <!--Widget para publicidad ancho de contenido-->
                <?php get_sidebar('publi_ac'); ?>
                <!--Fin widget publicidad ancho contenido-->

                <?php tribe_events_before_html(); ?>
                <?php tribe_get_view(); ?>
                <?php tribe_events_after_html(); ?>
            </div>

            <div class="col-xs-12 col-md-4">

                <?php get_sidebar('principal'); ?>

            </div>

        </div>



	</div> <!-- #tribe-events-pg-template -->
<?php get_footer(); ?>