<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function scribbles_move_elements() {

	// Hero image
	remove_action( 'primer_header', 'primer_add_hero' );
	add_action( 'primer_after_header', 'primer_add_hero' );

	// Page titles (will be displayed in hero instead)
	remove_action( 'primer_after_header', 'primer_add_page_title' );

}
add_action( 'template_redirect', 'scribbles_move_elements' );

/**
 * Add custom hero content.
 *
 * @action primer_hero
 * @since  1.0.0
 */
function scribbles_add_hero_content() {

	get_template_part( 'templates/parts/hero-content' );

}
add_action( 'primer_hero', 'scribbles_add_hero_content' );

/**
 * Display site search in the header.
 *
 * @action primer_header
 * @since  1.0.0
 */
function scribbles_add_header_search() {

	get_template_part( 'templates/parts/search' );

}
add_action( 'primer_header', 'scribbles_add_header_search', 20 );

/**
 * Display author avatar over the post thumbnail.
 *
 * @since 1.0.0
 */
function scribbles_add_author_avatar() {

	?>
	<div class="avatar-container">

		<?php echo get_avatar( get_the_author_meta( 'user_email' ), '128' ); ?>

	</div>
	<?php

}
add_action( 'primer_after_post_thumbnail', 'scribbles_add_author_avatar' );

/**
 * Add a footer menu.
 *
 * @filter primer_nav_menus
 * @since  1.0.0
 *
 * @param  array $nav_menus
 *
 * @return array
 */
function scribbles_nav_menus( $nav_menus ) {

	$nav_menus['footer'] = esc_html__( 'Footer Menu', 'scribbles' );

	return $nav_menus;

}
add_filter( 'primer_nav_menus', 'scribbles_nav_menus' );

/**
 * Set images sizes.
 *
 * @filter primer_image_sizes
 * @since  1.0.0
 *
 * @param  array $sizes
 *
 * @return array
 */
function scribbles_image_sizes( $sizes ) {

	$sizes['primer-hero']['width']  = 2400;
	$sizes['primer-hero']['height'] = 1300;

	return $sizes;

}
add_filter( 'primer_image_sizes', 'scribbles_image_sizes' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function scribbles_custom_logo_args( $args ) {

	$args['width']  = 325;
	$args['height'] = 80;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'scribbles_custom_logo_args' );

/**
 * Set custom header args.
 *
 * @action primer_custom_header_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function scribbles_custom_header_args( $args ) {

	$args['width']  = 2400;
	$args['height'] = 1300;

	return $args;

}
add_filter( 'primer_custom_header_args', 'scribbles_custom_header_args' );

/**
 * Register sidebar areas.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
 *
 * @return array
 */
function scribbles_sidebars( $sidebars ) {

	$sidebars['footer-4'] = array(
		'name'          => esc_html__( 'Footer 4', 'scribbles' ),
		'description'   => esc_html__( 'This sidebar is the fouth column of the footer widget area.', 'scribbles' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	$sidebars['footer-5'] = array(
		'name'          => esc_html__( 'Footer 5', 'scribbles' ),
		'description'   => esc_html__( 'This sidebar is the fifth column of the footer widget area.', 'scribbles' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	$sidebars['hero'] = array(
		'name'          => esc_html__( 'Hero', 'scribbles' ),
		'description'   => esc_html__( 'Hero widgets appear over the header image on the front page.', 'scribbles' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'scribbles_sidebars' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param array $font_types
 *
 * @return array
 */
function scribbles_font_types( $font_types ) {

	$font_types['header_font']['default']    = 'Architects Daughter';
	$font_types['primary_font']['default']   = 'Raleway';
	$font_types['secondary_font']['default'] = 'Architects Daughter';

	return $font_types;

}
add_filter( 'primer_font_types', 'scribbles_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function scribbles_colors( $colors ) {

	$colors['header_textcolor']['default']        = '#fca903';
	$colors['background_color']['default']        = '#ffffff';
	$colors['header_background_color']['default'] = '#ffffff';
	$colors['menu_background_color']['default']   = '#ffffff';
	$colors['footer_background_color']['default'] = '#3787da';
	$colors['tagline_text_color']['default']      = '#6f6f6f';
	$colors['link_color']['default']              = '#2e80ba';
	$colors['main_text_color']['default']         = '#6f6f6f';
	$colors['secondary_text_color']['default']    = '#78ae3e';

	return $colors;

}
add_filter( 'primer_colors', 'scribbles_colors' );
