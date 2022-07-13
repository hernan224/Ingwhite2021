<?php
/**
 * Events List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is needed.
 *
 * This view contains the filters required to create an effective events list widget view.
 *
 * You can recreate an ENTIRELY new events list widget view by doing a template override,
 * and placing a list-widget.php file in a tribe-events/widgets/ directory
 * within your theme directory, which will override the /views/widgets/list-widget.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @return string
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_plural = tribe_get_event_label_plural();

$posts = tribe_get_list_widget_events();

// Check if any event posts are found.
if ( $posts ) : ?>

	<ol class="hfeed vcalendar">
		<?php
		// Setup the post data for each event.
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			?>
			<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">

				<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
				<!-- Event Title -->
<!--				<h4 class="entry-title summary">-->
<!--					<a href="--><?php //echo esc_url( tribe_get_event_link() ); ?><!--" rel="bookmark">--><?php //the_title(); ?><!--</a>-->
<!--				</h4>-->

                <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.

                    $factor = 1.7;
                    $ancho_th = 360;
                    $alto_th = 100; ?>

                    <figure class="w-li event-foto-container">
                        <a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail(array( $ancho_th, $alto_th, 'bfi_thumb' => true, 'crop' => true, 'class' => " img-responsive" )); ?>
                        </a>

                        <?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

                        <div class="duration">
                            <?php //echo tribe_events_event_schedule_details();
                            echo  '<span class="w-li event-dia">'.tribe_get_start_date(null,false, 'd').'</span>';
                            echo '<br/>';
                            echo '<span class="w-li event-mes">'.tribe_get_start_date(null,false, 'M').'</span>';
                            //echo '<br/>';
                            //echo '<span class="w-li event-hora">'.tribe_get_start_date(null,true, 'H:i').' hs.</span>';
                            ?>
                        </div>

                        <?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
                    </figure>

                <?php endif; ?>

                <h5 class="entry-title summary">
                    <a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h5>

				<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
				<!-- Event Time -->


			</li>
		<?php
		endforeach;
		?>
	</ol><!-- .hfeed -->

	<p class="tribe-events-widget-link pag-ver-mas">
<!--		<a href="--><?php //echo esc_url( tribe_get_events_link() ); ?><!--" rel="bookmark">--><?php //printf( __( 'View All %s', 'tribe-events-calendar' ), $events_label_plural ); ?><!--</a>-->
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( __( 'Ver la Agenda Completa', 'tribe-events-calendar' ), $events_label_plural ); ?></a>
	</p>

<?php
// No events were found.
else : ?>
	<p><?php printf( __( 'There are no upcoming %s at this time.', 'tribe-events-calendar' ), strtolower( $events_label_plural ) ); ?></p>
<?php
endif;
