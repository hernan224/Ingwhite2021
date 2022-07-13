<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// Libreria para crear busquedas avanzadas
require_once( 'wp-advanced-search/wpas.php' );

// Libreria para crear tumbnails al vuelo BFI_thumb
require_once( 'library/BFI_Thumb.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once( 'library/custom-post-type.php' );
require_once( 'library/custom-taxonomies.php' );

// Controlador para obtener el objeto del clima
require_once('library/Clima_Controller.php');

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style();

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  //add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Barra lateral', 'bonestheme' ),
		'description' => __( 'Barra lateral.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s col-md-12 col-sm-4 col-xs-12">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

    register_sidebar(array(
        'id' => 'publi_ac',
        'name' => __( 'Publicidad ancho contenido', 'bonestheme' ),
        'description' => __( 'Publicidad ancho contenido', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'publi_i1',
        'name' => __( 'Publicidad interna 1', 'bonestheme' ),
        'description' => __( 'Publicidad interna 1', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'publi_i2',
        'name' => __( 'Publicidad interna 2', 'bonestheme' ),
        'description' => __( 'Publicidad interna 2', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

	register_sidebar(array(
        'id' => 'publi_i3',
        'name' => __( 'Publicidad interna 3', 'bonestheme' ),
        'description' => __( 'Publicidad interna 3', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

	register_sidebar(array(
        'id' => 'publi_i4',
        'name' => __( 'Publicidad interna 4', 'bonestheme' ),
        'description' => __( 'Publicidad interna 4', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'bottom-home',
        'name' => __( 'Barra Bottom Home', 'bonestheme' ),
        'description' => __( 'Barra debajo del contenido del Home', 'bonestheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-4 col-xs-12">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/* EXTEND SUBNAV
******************************************/

class submenuWrap extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul class='sub-menu collapse'>\n";
  }
  function end_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul>\n";
  }
}


/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function white_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {

    if(is_int($post)) {
        // get the post object of the passed ID
        $post = get_post($post);
    } elseif(!is_object($post)) {
        return false;
    }

    if(has_excerpt($post->ID)) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters('the_content', $the_excerpt);
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
    $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
    $excerpt_waste = array_pop($the_excerpt);
    $the_excerpt = implode($the_excerpt);
    $the_excerpt .= $extra;

    return apply_filters('the_content', $the_excerpt);
}

/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Montserrat:400,700');
  wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'bones_fonts');



//Array para guardar posts que no se deben repetir
$posts_excluidos = array();

//Bandera para mostrar header de las miniaturas
$show_th_header = true;


// Excluir posts repetidos en el home
//function exclude_tax_multimedia($query) {
//    if(!is_admin()){
//        if ($query->is_main_query() && is_post_type_archive( 'multimedia' )) {
//            $tax_array[] = array(
//                'taxonomy'  => 'tipomultimedia',
//                'field'     => 'slug',
//                'terms'     => 'gastronomia', // exclude media posts in the news-cat custom taxonomy
//                'operator'  => 'NOT IN'
//                );
//            $query->set( 'tax_query', $tax_array);
//        }
//    }
//}
//
//add_action('pre_get_posts', 'exclude_tax_multimedia');

//function jptweak_remove_share() {
//    remove_filter( 'the_content', 'sharing_display',19 );
//    remove_filter( 'the_excerpt', 'sharing_display',19 );
//    if ( class_exists( 'Jetpack_Likes' ) ) {
//        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
//    }
//}

//add_action( 'loop_start', 'jptweak_remove_share' );


/* DON'T DELETE THIS CLOSING TAG */

/**
 * Ajax search results
 */

add_filter('uwpqsf_result_tempt', 'customize_output', '', 4);
function customize_output($results , $arg, $id, $getdata ){
    // The Query
    $apiclass = new uwpqsfprocess();
    $query = new WP_Query( $arg );
    ob_start(); $result = '';
    // The Loop

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            echo  '<div class="item--comercio col-xs-12 col-sm-6">';
            require( "content-comercio.php" );
            echo  '</div>';
        }
        echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id,'');
    } else {
        echo  'No hay resultados';
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    $results = ob_get_clean();
    return $results;
}

//Agregar http:// a un link, si es necesario
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}


/** WP Advanced Search **/
function guia_search_form() {
    $loader_img = get_stylesheet_directory_uri().'/library/images/cargando.gif';

//    $terms = get_terms('rubro_comercio');
//    $query_terms = array();
//
//    foreach( $terms as $term ){
//        $query_terms[] = $term->slug;
//    };

    $args = array();

    $args['wp_query'] = array(
        'post_type' => 'comercio',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => 20,
//        'tax_query' => array(
//            array(
//                'taxonomy' => 'rubro_comercio',
//                'field'    => 'slug',
//                'terms'    => $query_terms,
//            )
//        )
    );

    $args['form'] = array(
        'class' => 'filtro-guia',
        'auto_submit' => true,
        'disable_wrappers' => false,
        'ajax' => array(
            'enabled' => true,
            'button_text' => 'Ver más comercios',
            'loading_img' => $loader_img,
            'results_template' => 'wpas-filtro_guia-tmp.php'
        )
    );

    $args['fields'][] = array(
        'type' => 'search',
        'label' => 'Buscar por nombre o servicio',
        'placeholder' => 'Buscar...');
    $args['fields'][] = array(
        'type' => 'taxonomy',
        'taxonomy' => 'rubro_comercio',
        'format' => 'select',
        'allow_null' => 'Todos los rubros',
        'label' => 'Buscar por rubro');
    $args['fields'][] = array(
        'type' => 'reset',
        'value' => 'Reestablecer');

    register_wpas_form('guia-form', $args);
}
add_action('init', 'guia_search_form');


//MENSAJE AUTOMATICA PARA FACEBOOK Y TWITTER
// Check if JetPack is Installed and publicize is active, else do nothing.
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'publicize' ) ) {
  function jeherve_publicize_hashtags() {
    $post = get_post();
    if ( ! empty( $post ) ) {
      // Create our custom message
      $custom_message = get_the_title();
      update_post_meta( $post->ID, '_wpas_mess', $custom_message );
    }
  }
// Save that message
  function jeherve_cust_pub_message_save() {
    add_action( 'save_post', 'jeherve_publicize_hashtags' );
  }
  add_action( 'publish_post', 'jeherve_cust_pub_message_save' );

  //Dar soprote de Publicize a Tribe Events
  add_action('init', 'soporte_publicize');
  function soporte_publicize() {
      add_post_type_support( 'tribe_events', 'publicize' );
  }
}

/** Notificación Push (OneSignal) para mobile apps:
 * Debo generar una notificación adicional, porque la original (enviada para subscriptores web push)
 *   contiene el elemento launchURL, que hace que en Android se abra automáticamente el browser en lugar de la app
 * Basado en https://wordpress.org/support/topic/variable-launchurl/
 */
add_filter('onesignal_send_notification', 'onesignal_send_notification_filter', 10, 4);

function onesignal_send_notification_filter($fields, $new_status, $old_status, $post) {
  /* Goal: We don't want to modify the original $fields array, because we want the
    original web push notification to go out unmodified.
    However, we want to send an additional notification to Android and iOS
    devices with an additionalData property.
  */

  /* Not entirely sure if this PHP function makes a deep copy of our $fields array; it may not be necessary. */
  $fields_dup = $fields;
  $fields_dup['isAndroid'] = true;
  $fields_dup['isIos'] = true;
  $fields_dup['isAnyWeb'] = false;
  $fields_dup['isWP'] = false;
  $fields_dup['isAdm'] = false;
  $fields_dup['isChrome'] = false;
  unset($fields_dup['url']); // quito url para que no se abra automaticamente. Lo incluyo en payload data
  // Data custom: link, id y tipo
  $fields_dup['data'] = [
    'link' => $fields['url'],
    'id' => $post->ID,
    'tipo' => 'noticias' // usado para identificar en la app vs alertas. Una notificacion por evento tambien entra en este tipo
  ];
  $fields_dup['included_segments'] = ['Noticias'];

  /* Send another notification via cURL */
  $ch = curl_init();
  $onesignal_post_url = "https://onesignal.com/api/v1/notifications";
  /* Hopefully OneSignal::get_onesignal_settings(); can be called outside of the plugin */
  $onesignal_wp_settings = OneSignal::get_onesignal_settings();
  $onesignal_auth_key = $onesignal_wp_settings['app_rest_api_key'];
  curl_setopt($ch, CURLOPT_URL, $onesignal_post_url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . $onesignal_auth_key
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields_dup));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  // Optional: Turn off host verification if SSL errors for local testing
  // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  // Optional: cURL settings to help log cURL output response
  // curl_setopt($ch, CURLOPT_FAILONERROR, false);
  // curl_setopt($ch, CURLOPT_HTTP200ALIASES, array(400));
  // curl_setopt($ch, CURLOPT_VERBOSE, true);
  // curl_setopt($ch, CURLOPT_STDERR, $out);
  $response = curl_exec($ch);

  /* Optional: Log cURL output response
  fclose($out);
  $debug_output = ob_get_clean();
  $curl_effective_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
  $curl_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $curl_total_time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
  onesignal_debug('OneSignal API POST Data:', $fields);
  onesignal_debug('OneSignal API URL:', $curl_effective_url);
  onesignal_debug('OneSignal API Response Status Code:', $curl_http_code);
  if ($curl_http_code != 200) {
  onesignal_debug('cURL Request Time:', $curl_total_time, 'seconds');
  onesignal_debug('cURL Error Number:', curl_errno($ch));
  onesignal_debug('cURL Error Description:', curl_error($ch));
  onesignal_debug('cURL Response:', print_r($response, true));
  onesignal_debug('cURL Verbose Log:', $debug_output);
  }
  */
  curl_close($ch);
  return $fields;
}

/**
 * Agrego CORS header en la API, para GET
 * Usa * for origin
 */
function add_cors_headers_api() {

	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	add_filter( 'rest_pre_serve_request', function( $value ) {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Methods: GET' );
		header( 'Access-Control-Allow-Credentials: true' );

		return $value;
	});
}
//add_action('rest_api_init', 'add_cors_headers_api', 15 );



/**
 * Desactivar reemplazo de imagenes de JetPack
 */
function tj_dequeue_devicepx() {
 wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'tj_dequeue_devicepx' );

?>
