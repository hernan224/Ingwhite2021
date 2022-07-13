<?php if ( have_posts() ): ?>
    <?php while ( have_posts() ): the_post(); ?>

        <div class="item--comercio col-xs-12 col-sm-6">

            <?php get_template_part( 'content', 'comercio' );	?>

        </div> <!--/.item--masonry-->

    <?php endwhile; ?>

<?php else : ?>

    <p>Lo sentimos, no hemos podido encontrar el comercio que busca.</p>

<?php endif; ?>

<?php wp_reset_query(); ?>
