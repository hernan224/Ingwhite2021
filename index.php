<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap cf row">

        <div id="main" class="col-xs-12 col-md-8" role="main">

            <div class="row">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div class="col-xs-12 col-sm-6">

                        <?php get_template_part( 'content', 'noticias' );	?>

                    </div> <!--/.col-sm-6-->

                <?php endwhile; ?>

                    <?php bones_page_navi(); ?>

            </div> <!--/.row-->

        </div>

        <div class="col-xs-12 col-md-4">

            <?php get_sidebar('principal'); ?>

        </div>

        <?php else : ?>

            <div class="col-xs-12 ">

                <?php get_template_part( 'content', 'sin_noticias' );	?>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php get_footer(); ?>
