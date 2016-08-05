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
		add_action( 'scribbles_hero', 'primer_add_page_builder_template_title' );
		add_action( 'scribbles_hero', 'primer_add_blog_title' );
		add_action( 'scribbles_hero', 'primer_add_archive_title' );
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

	if ( is_404() ) {
		return;
	}

	add_action( 'primer_after_header', 'primer_add_hero', 100 );

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
				'.site-info-wrapper:before' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
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
			'name'    => 'menu_link_color',
			'label'   => esc_html__( 'Menu Link Color', 'primer' ),
			'default' => '#2e80ba',
			'css'     => array(
				'.main-navigation-container a, .main-navigation-container a:visited' => array(
					'color' => '%1$s',
				),
				'.menu-toggle div' => array(
					'background-color' => '%1$s',
				),
				'.main-navigation .sub-menu li.menu-item-has-children > a:after' => array(
					'border-left-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation-container a:hover, .main-navigation-container a:visited:hover,
				.main-navigation .current-menu-item > a, .main-navigation a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),


		array(
			'name'    => 'hero_background_color',
			'label'   => esc_html__( 'Hero Background Color', 'primer' ),
			'default' => '#2e80ba',
			'css'     => array(
				'.hero' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array( // TODO: More tags here...
			'name'    => 'hero_text_color',
			'label'   => esc_html__( 'Hero Background Color', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.hero,
				.hero a,
				.hero p,
				.hero h1,
				.hero h2,
				.hero h3,
				.hero h4,
				.hero h5,
				.hero h6,
				.hero .textwidget .button,
				.hero .widget-title,
				.hero cite,
				.hero abbr,
				.hero acronym
				' => array(
					'color' => '%1$s',
				),
				'.hero .textwidget .button,
				.hero blockquote' => array(
					'border-color'  => '%1$s',
				),
				'.hero .textwidget .button:hover' => array(
					'border-color'  => '%1$s',
					'background-color'  => '%1$s',
				),
				'.hero pre, .hero code' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.hero table, .hero th, .hero td, .hero tr' => array(
					'border-color' => 'rgba(%1$s, 0.1)',
				),
				'.hero pre, .hero code' => array(
					'background-color' => 'rgba(%1$s, 0.05)',
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
		array( // TODO: More tags here...
			'name'    => 'footer_text_color',
			'label'   => esc_html__( 'Footer Text Color', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.site-footer a,
				.site-footer a abbr, .site-footer a acronym,
				.footer-widget-area .footer-widget .widget,
				.footer-widget-area .footer-widget .widget-title' => array(
					'color' => '%1$s',
				),
				'.footer-widget-area .footer-widget .widget-title' => array(
					'border-color'  => '%1$s',
				),
				'' => array(
					'border-color'  => '%1$s',
					'background-color'  => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.site-footer a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),


		array(
			'name'    => 'site_info_background_color',
			'label'   => esc_html__( 'Site Info Background Color', 'primer' ),
			'default' => '#78ae3e',
			'css'     => array(
				'.site-info-wrapper, .main-navigation-container:before, .main-navigation-container:after' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array( // TODO: More tags here...
			'name'    => 'site_info_text_color',
			'label'   => esc_html__( 'Site Info Text Color', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.site-info, .site-info a, .site-info .social-menu a' => array(
					'color' => '%1$s',
				),
				'.site-info .social-menu a ' => array(
					'border-color'  => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.site-info a:hover, .site-info .social-menu a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.site-info .social-menu a:hover' => array(
					'border-color'  => 'rgba(%1$s, 0.8)',
				),
			),
		),


		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#2e80ba',
			'css' => array(
				'#content a, #content a abbr' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'#content a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#6f6f6f',
			'css' => array(
				'#content, #content abbr, #content acronym' => array(
					'color' => '%1$s',
				),
				'#content pre, #content code' => array(
					'color' => '%1$s',
				),
				'#content '
			),
			'rgba_css'     => array(
				'#content pre, #content code' => array(
					'background-color' => 'rgba(%1$s, 0.05)',
				),
				'#content table, #content th, #content td, #content tr, .logged-in-as' => array(
					'border-color' => 'rgba(%1$s, 0.1)',
				),
				'#content blockquote, #content blockquote p, #content cite' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
				'#content blockquote' => array(
					'border-left-color' => 'rgba(%1$s, 0.25)',
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
