<?php
/**
 * Thriive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Thriive
 */
 
 /**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thriive_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'thriive' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'thriive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'thriive_widgets_init' );

add_theme_support( 'post-thumbnails' );
add_image_size('blog-header',777,427);


add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );
function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'blog-header' => __( 'Blog Header' ),
    ) );
}

?>