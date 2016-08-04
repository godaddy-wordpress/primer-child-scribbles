<?php

/**
 * Move titles above menu templates.
 *
 * @since 1.0.0
 */
function scribbles_remove_titles(){

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

	if( ! is_front_page() ):
		add_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
		add_action( 'primer_after_header', 'primer_add_blog_title', 100 );
		add_action( 'primer_after_header', 'primer_add_archive_title', 100 );
	endif;

}
add_action( 'init', 'scribbles_remove_titles' );

/**
 * Check to see if we should add the hero to the page.
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function scribbles_check_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );

	if ( is_404() || is_page_template( 'templates/page-builder-no-header.php' ) ) {
		return;
	}

	add_action( 'primer_after_header', 'scribbles_add_hero', 10 );

}
add_action( 'template_redirect', 'scribbles_check_hero' );

/**
 * Display site search in the header.
 *
 * @action primer_header
 * @since 1.0.0
 */
function scribbles_add_search() {

	get_template_part( 'templates/parts/search' );

}
add_action( 'primer_header', 'scribbles_add_search', 10 );


/**
 * Add hero after header if we are on a post or front page.
 *
 * @action primer_after_header
 * @since 1.0.0
 */
function scribbles_add_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );
	add_action( 'primer_after_header', 'primer_add_hero', 20 );

}
add_action( 'after_setup_theme', 'scribbles_add_hero' );

/**
 * Add additional sidebars
 *
 * @action primer_register_sidebars
 * @since 1.0.0
 * @param $sidebars
 * @return array
 */
function scribbles_add_sidebars( $sidebars ) {

	$new_sidebars = array(
		array(
			'name'          => esc_html__( 'Footer 4', 'scribbles' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'This sidebar is the fouth column of the footer widget area.', 'scribbles' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
		array(
			'name'          => esc_html__( 'Footer 5', 'scribbles' ),
			'id'            => 'footer-5',
			'description'   => esc_html__( 'This sidebar is the fifth column of the footer widget area.', 'scribbles' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
		array(
			'name'          => esc_html__( 'Hero', 'scribbles' ),
			'id'            => 'hero',
			'description'   => esc_html__( 'This sidebar is for the hero area.', 'scribbles' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
	);

	return array_merge( $sidebars, $new_sidebars );

}

add_filter( 'primer_register_sidebars', 'scribbles_add_sidebars' );


/**
 * Add a footer menu.
 *
 * @action primer_nav_menus
 * @since 1.0.0
 * @param $nav_menus
 * @return array
 */
function scribbles_update_nav_menus( $nav_menus ) {

	$new_nav_menus = array(
		'footer' => esc_html__( 'Footer Menu', 'scribbles' ),
	);

	return array_merge( $nav_menus, $new_nav_menus );

}
add_filter( 'primer_nav_menus', 'scribbles_update_nav_menus' );


/**
 * Return the custom header
 *
 * @since 1.0.0
 * @return false|string
 */
function scribbles_get_custom_header() {
	$post_id = get_queried_object_id();

	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';

	$custom_header = get_custom_header();
	if ( ! empty( $custom_header->attachment_id ) ) {
		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );

		if ( getimagesize( $image ) ) {
			return $image;
		}
	}

	$header_image = get_header_image();
	return $header_image;
}


/**
 * Add additional image sizes
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function scribbles_add_image_sizes() {
	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );
}
add_action( 'after_setup_theme', 'scribbles_add_image_sizes' );


/**
 * Update font types specific to scribbles.
 *
 * @since 1.0.0
 * @return array
 */
function scribbles_update_font_types() {
	return array(
		array(
			'name'    => 'primary_font',
			'label'   => __( 'Primary Font', 'primer' ),
			'default' => 'Raleway',
			'css'     => array(
				'body,
				h6,
				.main-navigation,
				.widget, .widget p, .widget ul, .widget ol,
				.site-description,
				.site-info
				' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'secondary_font',
			'label'   => __( 'Secondary Font', 'primer' ),
			'default' => 'Architects Daughter',
			'css'     => array(
				'h1, h2, h3, h4, h5,
				blockquote,
				button,
				a.button,
				input,
				select,
				textarea,
				button,
				a.button,
				a.button:visited,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				label,
				legend,
				.widget-title,
				.widget_recent_entries .post-date,
				.entry-footer,
				.entry-meta,
				.event-meta,
				.sermon-meta,
				.location-meta,
				.person-meta,
				.post-format,
				.more-link,
				.comment-author,
				.comment-metadata,
				#respond,
				.site-title,
				.featured-content .entry-header .entry-title,
				.featured-content .entry-header .entry-title
				' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);
}
add_action( 'primer_font_types', 'scribbles_update_font_types' );

/**
 * Update colors specific to Scribbles.
 *
 * @since 1.0.0
 * @return array
 */
function scribbles_update_colors() {
	return array(
		array(
			'name'    => 'header_textcolor',
			'default' => '#fca903',
			'css'     => array(
				'.site-title a, .site-title a:visited' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'menu_background_color',
			'label'   => esc_html__( 'Menu Background Color', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.main-navigation-container, .main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_background_color',
			'label'   => esc_html__( 'Footer Background Color', 'primer' ),
			'default' => '#3787da',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'site_info_background_color',
			'label'   => esc_html__( 'Site Info Background Color', 'primer' ),
			'default' => '#78ae3e',
			'css'     => array(
				'.site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#6f6f6f',
			'css'     => array(
				'.site-description' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#3787da',
			'css'     => array(
				'a, a:visited, .entry-title a:hover, .entry-title a:visited:hover, .main-navigation a, abbr, .site-footer a, .site-footer a:visited, .site-info a, .site-info a:visited' => array(
					'color' => '%1$s',
				),
				'button, a.button, input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'background-color' => '%1$s',
				),
				'.main-navigation .sub-menu li.menu-item-has-children > a:after' => array(
					'border-left-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover, a:visited:hover, a:focus, a:visited:focus, a:active, a:visited:active,
				.main-navigation .current-menu-item > a, .main-navigation a:hover, .site-footer a:hover, .site-info a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'button:hover, button:active, button:focus, a.button:hover, a.button:active, a.button:focus, input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus, input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
				'button, button:hover, button:active, button:focus, a.button, a.button:hover, a.button:active, a.button:focus, a.button:visited, a.button:visited:hover, a.button:visited:active, a.button:visited:focus, input[type="button"], input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus, input[type="reset"], input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="submit"], input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus' => array(
					'color' => '#ffffff',
				),
				'.comment-list li.bypostauthor' => array(
					'border-color' => 'rgba(%1$s, 0.2)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#6f6f6f',
			'css'     => array(
				'body, input, select, textarea, h1, h2, h3, h4, h5, h6, .entry-title a, .entry-title a:visited, .entry-title a:before, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'hr' => array(
					'background-color' => 'rgba(%1$s, 0.1)',
				),
				'input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea' => array(
					'color'        => 'rgba(%1$s, 0.5)',
					'border-color' => 'rgba(%1$s, 0.1)',
				),
				'select, fieldset, blockquote, pre, code, abbr, acronym, .hentry table th, .hentry table td' => array(
					'border-color' => 'rgba(%1$s, 0.1)',
				),
				'.hentry table tr:hover td' => array(
					'background-color' => 'rgba(%1$s, 0.075)',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => esc_html__( 'Secondary Text Color', 'primer' ),
			'default' => '#78ae3e',
			'css'     => array(
				'blockquote, .entry-meta, .entry-footer, .comment-meta .says, .logged-in-as, .fl-callout-text' => array(
					'color' => '%1$s',
				),
			),
		),
	);
}
add_action( 'primer_colors', 'scribbles_update_colors' );


/**
 * Change color schemes
 *
 * @action primer_color_schemes
 * @since 1.0.0
 * @return array
 */
function scribbles_color_schemes() {

	return array(
		'scribbles-2' => array(
			'label'  => esc_html__( 'Scribbles 2', 'ascension' ),
			'colors' => array(
				'header_textcolor'              => '#f46b06',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'menu_background_color'         => '#FFFFFF',
				'footer_background_color'       => '#3787da',
				'site_info_background_color'    => '#f46b06',
				'tagline_text_color'            => '#6f6f6f',
				'link_color'                    => '#3787da',
				'main_text_color'               => '#6f6f6f',
				'secondary_text_color'          => '#f46b06',
			),
		),
		'scribbles-3' => array(
			'label'  => esc_html__( 'Scribbles 3', 'ascension' ),
			'colors' => array(
				'header_textcolor'              => '#f3755c',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'menu_background_color'         => '#FFFFFF',
				'footer_background_color'       => '#FFFFFF',
				'site_info_background_color'    => '#f3755c',
				'tagline_text_color'            => '#eda125',
				'link_color'                    => '#c2442b',
				'main_text_color'               => '#6f6f6f',
				'secondary_text_color'          => '#6f6f6f',
			),
		),
		'scribbles-4' => array(
			'label'  => esc_html__( 'Scribbles 4', 'ascension' ),
			'colors' => array(
				'header_textcolor'              => '#FFFFFF',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#44b5da',
				'menu_background_color'         => '#FFFFFF',
				'footer_background_color'       => '#44b5da',
				'site_info_background_color'    => '#ab3490',
				'tagline_text_color'            => '#eda125',
				'link_color'                    => '#82c32e',
				'main_text_color'               => '#6f6f6f',
				'secondary_text_color'          => '#6f6f6f',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'scribbles_color_schemes' );
