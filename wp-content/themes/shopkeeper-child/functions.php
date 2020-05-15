<?php //Start building your awesome child theme functions

add_action( 'wp_enqueue_scripts', 'shopkeeper_enqueue_styles', 99 );
function shopkeeper_enqueue_styles() {

    // enqueue parent styles
    wp_enqueue_style( 'shopkeeper-icon-font', get_template_directory_uri() . '/inc/fonts/shopkeeper-icon-font/style.css' );
	wp_enqueue_style( 'shopkeeper-styles', get_template_directory_uri() .'/css/styles.css' );
    wp_enqueue_style( 'shopkeeper-default-style', get_template_directory_uri() .'/style.css' );

    // enqueue child styles
    wp_enqueue_style( 'shopkeeper-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'shopkeeper-default-style' ),
        wp_get_theme()->get('Version')
    );

	// enqueue RTL styles
    if( is_rtl() ) {
    	wp_enqueue_style( 'shopkeeper-child-rtl-styles',  get_template_directory_uri() . '/rtl.css', array( 'shopkeeper-styles' ), wp_get_theme()->get('Version') );
    }
}
