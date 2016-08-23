<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function scribbles_move_elements() {

	remove_action( 'primer_header',       'primer_add_hero' );
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_after_header', 'primer_add_hero' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

	add_action( 'primer_before_site_navigation', 'primer_add_social_navigation', 12 );

}
add_action( 'template_redirect', 'scribbles_move_elements' );

/**
 * Set hero image target element.
 *
 * @filter primer_hero_image_selector
 * @since  1.0.0
 *
 * @return string
 */
function scribbles_hero_image_selector() {

	return '.hero';

}
add_filter( 'primer_hero_image_selector', 'scribbles_hero_image_selector' );

/**
 * Set the default hero image description.
 *
 * @filter primer_default_hero_images
 * @since  1.0.0
 *
 * @param  array $defaults
 *
 * @return array
 */
function scribbles_default_hero_images( $defaults ) {

	$defaults['default']['description'] = esc_html__( 'Kids playing with sidewalk chalk', 'scribbles' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'scribbles_default_hero_images' );

/**
 * Display a search form in the header.
 *
 * @action primer_header
 * @since  1.0.0
 */
function scribbles_add_search_form() {

	get_template_part( 'templates/parts/search' );

}
add_action( 'primer_header', 'scribbles_add_search_form', 20 );

/**
 * Display author avatar over the post thumbnail.
 *
 * @action primer_after_post_thumbnail
 * @since  1.0.0
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
 * Set sidebars.
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

	return $sidebars;

}
add_filter( 'primer_sidebars', 'scribbles_sidebars' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function scribbles_fonts( $fonts ) {

	$fonts[] = 'Architects Daughter';
	$fonts[] = 'Raleway';

	return $fonts;

}
add_filter( 'primer_fonts', 'scribbles_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function scribbles_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Architects Daughter',
		),
		'navigation_font' => array(
			'default' => 'Raleway',
		),
		'heading_font' => array(
			'default' => 'Architects Daughter',
		),
		'primary_font' => array(
			'default' => 'Raleway',
		),
		'secondary_font' => array(
			'default' => 'Raleway',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

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

	unset( $colors['content_background_color'] );

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default' => '#fca903',
		),
		'tagline_text_color' => array(
			'default'  => '#686868',
			'rgba_css' => array(
				'.site-search-wrapper .widget .search-field' => array(
					'border-color' => 'rgba(%1$s, 0.25)',
				),
			),
		),
		'menu_text_color' => array(
			'css' => array(
				'.main-navigation-container:before, .main-navigation-container:after' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'heading_text_color' => array(
			'css' => array(
				'.footer-widget .widget-title' => array(
					'color'        => '%1$s',
					'border-color' => '%1$s',
				),
			),
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#3f3244',
			'css'     => array(
				'.footer-widget .widget-title,
				.footer-widget .widget .search-field' => array(
					'border-color' => '%1$s',
				),
			),
		),'footer_menu_text_color' => array(
			'default' => '#b5345f',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#54ccbe',
		),
		'button_color' => array(
			'default'  => '#b5345f',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation ul li.menu-item-has-children .sub-menu li a' => array(
					'color' => '%1$s',
				),
			),
		),
		'hero_background_color' => array(
			'default' => '#3f3244',
		),
		'menu_background_color' => array(
			'default' => '#b5345f',
		),
		'footer_widget_background_color' => array(
			'default' => '#3f3244',
		),
		'footer_widget_content_background_color' => array(
			'default' => '#ffffff',
		),
		'footer_background_color' => array(
			'default' => '#ffffff',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'scribbles_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function scribbles_color_schemes( $color_schemes ) {

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'header_textcolor'                 => '#b84247',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#b84247',
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor'                 => '#a0917d',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#a0917d',
			),
		),
		'canary' => array(
			'colors' => array(
				'header_textcolor'                 => '#d2b160',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#d2b160',
			),
		),
		'dark' => array(
			'colors' => array(
				'hero_background_color' => '#333333',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor'                 => '#58ac70',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#58ac70',
			),
		),
		'muted' => array(
			'colors' => array(
				'header_textcolor'                 => '#5a6175',
				'tagline_text_color'               => '#5a6175',
				'footer_widget_heading_text_color' => '#5a6175',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor'                 => '#54496d',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#54496d',
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor'                 => '#dc8582',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#dc8582',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor'                 => '#e38f47',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#e38f47',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor'                 => '#41cfaf',
				'tagline_text_color'               => '#686868',
				'footer_widget_heading_text_color' => '#41cfaf',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'scribbles_color_schemes' );
