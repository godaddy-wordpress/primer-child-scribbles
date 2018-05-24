<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.2' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function scribbles_move_elements() {

	remove_action( 'primer_header',                'primer_add_hero',               7 );
	remove_action( 'primer_after_header',          'primer_add_page_title',         12 );
	remove_action( 'primer_after_header',          'primer_add_primary_navigation', 11 );
	remove_action( 'primer_before_header_wrapper', 'primer_video_header',           5 );

	add_action( 'primer_after_header', 'primer_add_hero', 10 );

	add_action( 'primer_before_site_navigation', 'scribbles_nav_wrapper_open',    0 );
	add_action( 'primer_after_site_navigation',  'scribbles_nav_wrapper_close',   400 );
	add_action( 'primer_after_header',           'primer_add_primary_navigation', 5 );
	add_action( 'primer_hero',                   'primer_video_header',           3 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

	}

	add_action( 'primer_before_site_navigation', 'primer_add_social_navigation', 12 );

}
add_action( 'template_redirect', 'scribbles_move_elements' );

/**
 * Open main navigation wrapper div.
 *
 * @since  1.0.0
 */
function scribbles_nav_wrapper_open() {

	get_template_part( 'templates/parts/nav-border' );

	echo '<div class="main-navigation-wrapper">';

}

/**
 * Close main navigation wrapper div.
 *
 * @since  1.0.0
 */
function scribbles_nav_wrapper_close() {

	echo '</div><!-- .main-navigation-wrapper -->';

	get_template_part( 'templates/parts/nav-border' );

}

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
		'hero_text_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.hero .widget input[type="search"]' => array(
					'color'        => '%1$s',
					'border-color' => '%1$s',
				),
			),
		),
		'menu_text_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation ul li a, .main-navigation ul li a:visited, .main-navigation ul li a:hover, .main-navigation ul li a:visited:hover,.main-navigation-container .social-menu a,.main-navigation ul li.menu-item-has-children .sub-menu li a' => array(
					'color' => '%1$s',
				),
				'.main-navigation-container .st0' => array(
					'fill' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation ul li a:hover,.main-navigation-container .social-menu a:hover,.main-navigation ul li.menu-item-has-children .sub-menu li a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'heading_text_color' => array(
			'default' => '#353535',
			'css'     => array(
				'.footer-widget .widget-title' => array(
					'color'        => '%1$s',
					'border-color' => '%1$s',
				),
			),
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#3f3244',
			'css'     => array(
				'.footer-widget .widget-title,
				.footer-widget .widget .search-field' => array(
					'border-color' => '%1$s',
				),
			),
		),
		'footer_widget_text_color' => array(
			'default' => '#252525',
		),
		'footer_menu_text_color' => array(
			'default' => '#686868',
		),
		'footer_text_color' => array(
			'default' => '#686868',
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
		'button_text_color' => array(
			'default'  => '#ffffff',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#686868',
		),
		'menu_background_color' => array(
			'default' => '#b5345f',
			'css'     => array(
				'.main-navigation-container, .main-navigation.open, .main-navigation ul ul, .main-navigation .sub-menu, .main-navigation-container:before, .main-navigation-container:after' => array(
					'background-color' => '%1$s',
				),
			),
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
				'header_textcolor'                 => $color_schemes['blush']['base'],
				'footer_widget_heading_text_color' => $color_schemes['blush']['base'],
				'link_color'                       => $color_schemes['blush']['base'],
				'button_color'                     => $color_schemes['blush']['base'],
				'menu_background_color'            => $color_schemes['blush']['base'],
				'footer_widget_background_color'   => $color_schemes['blush']['base'],
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['bronze']['base'],
				'footer_widget_heading_text_color' => $color_schemes['bronze']['base'],
				'link_color'                       => $color_schemes['bronze']['base'],
				'button_color'                     => $color_schemes['bronze']['base'],
				'menu_background_color'            => $color_schemes['bronze']['base'],
				'footer_widget_background_color'   => $color_schemes['bronze']['base'],
			),
		),
		'canary' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['canary']['base'],
				'footer_widget_heading_text_color' => $color_schemes['canary']['base'],
				'link_color'                       => $color_schemes['canary']['base'],
				'button_color'                     => $color_schemes['canary']['base'],
				'menu_background_color'            => $color_schemes['canary']['base'],
				'footer_widget_background_color'   => $color_schemes['canary']['base'],
			),
		),
		'cool' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['cool']['base'],
				'footer_widget_heading_text_color' => $color_schemes['cool']['base'],
				'link_color'                       => $color_schemes['cool']['base'],
				'button_color'                     => $color_schemes['cool']['base'],
				'menu_background_color'            => $color_schemes['cool']['base'],
				'footer_widget_background_color'   => $color_schemes['cool']['base'],
			),
		),
		'dark' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#ffffff',
				'tagline_text_color'               => '#999999',
				'heading_text_color'               => '#ffffff',
				'primary_text_color'               => '#e5e5e5',
				'secondary_text_color'             => '#c1c1c1',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				// Links & Buttons
				'button_color' => '#54ccbe',
				// Backgrounds
				'background_color'                       => '#222222',
				'hero_background_color'                  => '#282828',
				'menu_background_color'                  => '#333333',
				'footer_widget_content_background_color' => '#333333',
				'footer_widget_background_color'         => '#282828',
				'footer_background_color'                => '#222222',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['iguana']['base'],
				'footer_widget_heading_text_color' => $color_schemes['iguana']['base'],
				'link_color'                       => $color_schemes['iguana']['base'],
				'button_color'                     => $color_schemes['iguana']['base'],
				'menu_background_color'            => $color_schemes['iguana']['base'],
				'footer_widget_background_color'   => $color_schemes['iguana']['base'],
			),
		),
		'muted' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#5a6175',
				'tagline_text_color'               => '#5a6175',
				'heading_text_color'               => '#4f5875',
				'primary_text_color'               => '#4f5875',
				'secondary_text_color'             => '#888c99',
				'footer_widget_heading_text_color' => '#5a6175',
				'footer_menu_text_color'           => $color_schemes['muted']['base'],
				'footer_text_color'                => '#4f5875',
				// Links & Buttons
				'link_color'   => $color_schemes['muted']['base'],
				'button_color' => $color_schemes['muted']['base'],
				// Backgrounds
				'background_color'               => '#ffffff',
				'hero_background_color'          => '#5a6175',
				'menu_background_color'          => '#5a6175',
				'footer_widget_background_color' => '#b6b9c5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['plum']['base'],
				'footer_widget_heading_text_color' => $color_schemes['plum']['base'],
				'link_color'                       => $color_schemes['plum']['base'],
				'button_color'                     => $color_schemes['plum']['base'],
				'menu_background_color'            => $color_schemes['plum']['base'],
				'footer_widget_background_color'   => $color_schemes['plum']['base'],
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['rose']['base'],
				'footer_widget_heading_text_color' => $color_schemes['rose']['base'],
				'link_color'                       => $color_schemes['rose']['base'],
				'button_color'                     => $color_schemes['rose']['base'],
				'menu_background_color'            => $color_schemes['rose']['base'],
				'footer_widget_background_color'   => $color_schemes['rose']['base'],
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['tangerine']['base'],
				'footer_widget_heading_text_color' => $color_schemes['tangerine']['base'],
				'link_color'                       => $color_schemes['tangerine']['base'],
				'button_color'                     => $color_schemes['tangerine']['base'],
				'menu_background_color'            => $color_schemes['tangerine']['base'],
				'footer_widget_background_color'   => $color_schemes['tangerine']['base'],
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor'                 => $color_schemes['turquoise']['base'],
				'footer_widget_heading_text_color' => $color_schemes['turquoise']['base'],
				'link_color'                       => $color_schemes['turquoise']['base'],
				'button_color'                     => $color_schemes['turquoise']['base'],
				'menu_background_color'            => $color_schemes['turquoise']['base'],
				'footer_widget_background_color'   => $color_schemes['turquoise']['base'],
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'scribbles_color_schemes' );
