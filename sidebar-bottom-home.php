<?php if ( is_active_sidebar( 'bottom-home' ) ) : ?>

    <div class="row wrap hidden-xs">
        <div class="col-xs-12">
            <div id="barra-bottom-home" class="row">

                <?php dynamic_sidebar('bottom-home'); ?>

            </div>
        </div>
    </div>

<?php endif; ?>
