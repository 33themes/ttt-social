<?php // Register Sidebar
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // end if

function custom_sidebar() {

	$args = array(
		'id'            => 'tttsocial-sidebar',
		'name'          => __( 'TTTSocial Secondary Widget Area', 'text_domain' ),
		'description'   => __( 'Section Widgets.', 'text_domain' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	);
	register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action('widgets_init', 'custom_sidebar' );
?>