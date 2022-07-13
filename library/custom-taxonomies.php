<?php
// Register Custom Taxonomy
function destacado_tax() {

    $labels = array(
        'name'                       => _x( 'Artículos Destacados', 'Taxonomy General Name', 'ingwhite' ),
        'singular_name'              => _x( 'Artículo Destacado', 'Taxonomy Singular Name', 'ingwhite' ),
        'menu_name'                  => __( 'Destacado', 'ingwhite' ),
        'all_items'                  => __( 'Todos los destacados', 'ingwhite' ),
        'parent_item'                => __( 'Parent Item', 'ingwhite' ),
        'parent_item_colon'          => __( 'Parent Item:', 'ingwhite' ),
        'new_item_name'              => __( 'Nuevo destacado', 'ingwhite' ),
        'add_new_item'               => __( 'Añadir destacado', 'ingwhite' ),
        'edit_item'                  => __( 'Editar destacado', 'ingwhite' ),
        'update_item'                => __( 'Actualizar destacado', 'ingwhite' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'ingwhite' ),
        'search_items'               => __( 'Buscar destacados', 'ingwhite' ),
        'add_or_remove_items'        => __( 'Agregar o quitar destacados', 'ingwhite' ),
        'choose_from_most_used'      => __( 'Choose from the most used items', 'ingwhite' ),
        'not_found'                  => __( 'Not Found', 'ingwhite' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
        'show_in_rest'               => true 
    );
    register_taxonomy( 'articulo_destacado', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'destacado_tax', 0 );
	

?>
