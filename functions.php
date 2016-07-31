<?php

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
function scribbles_add_site_header() {

	remove_action( 'primer_header', 'primer_add_site_header', 10 );
	add_action( 'primer_after_header', 'primer_add_site_header', 20 );

}
add_action( 'after_setup_theme', 'scribbles_add_site_header' );

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
			'default' => '#222222',
			'css'     => array(

			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#f9f9f9',
		),
		array(
			'name'    => 'menu_background_color',
			'label'   => __( 'Menu Background Color', 'primer' ),
			'default' => '#222222',
			'css'     => array(

			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => __( 'Tagline Text Color', 'primer' ),
			'default' => '#7c7c7c',
			'css'     => array(

			),
		),
		array(
			'name'    => 'link_color',
			'label'   => __( 'Link Color', 'primer' ),
			'default' => '#1585cf',
			'css'     => array(

			),
			'rgba_css' => array(

			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => __( 'Main Text Color', 'primer' ),
			'default' => '#1a1a1a',
			'css'     => array(

			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => __( 'Secondary Text Color', 'primer' ),
			'default' => '#686868',
			'css'     => array(

			),
		),
	);
}
add_action( 'primer_colors', 'scribbles_update_colors' );
