<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Motif
 */

/**
 * Add support for Jetpack features.
 */
function motif_jetpack_setup() {
	/**
	 * Add theme support for Jetpack Testimonials
	 */
	add_theme_support( 'jetpack-testimonial' );

	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'motif_infinite_scroll_render',
		'footer'    => 'page',
	) );

	/**
	 * Add a new image size for Site Logo
	 */
	add_image_size( 'motif-logo', 640, 220 );

	/**
	 * Add theme support for Site Logo
	 */
	add_theme_support( 'site-logo', array( 'size' => 'motif-logo' ) );
}
add_action( 'after_setup_theme', 'motif_jetpack_setup' );

/**
 * Return early if Site Logo is not available.
 */
function motif_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}

/**
 * Flush the Rewrite Rules for the testimonials CPT after the user has activated the theme.
 */
function motif_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'motif_flush_rewrite_rules' );

/**
 * Define the code that is used to render the posts added by Infinite Scroll.
 *
 * Includes the whole loop. Used to include the correct template part for the Testimonials CPT.
 */
function motif_infinite_scroll_render() {
	while( have_posts() ) {
		the_post();

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			get_template_part( 'content', 'testimonial' );
		} else {
			get_template_part( 'content', get_post_format() );
		}
	}
}

/**
 * Filter the 'infinite_scroll_has_footer_widgets' value.
 * If the navigation menu in the footer is used or if the footer sidebar contains any widgets, the scroll will be changed to 'click' from 'scroll'.
 */
function motif_infinite_scroll_has_footer_widgets( $has_widgets ) {
	if ( has_nav_menu( 'secondary' )
		|| is_active_sidebar( 'sidebar-2' )
		|| is_active_sidebar( 'sidebar-3' )
		|| is_active_sidebar( 'sidebar-4' ) ) {
			$has_widgets = true;
	}

	return $has_widgets;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'motif_infinite_scroll_has_footer_widgets' );
