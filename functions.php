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

	// Page titles
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

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

	$defaults['default']['description'] = esc_html__( 'Kids Sidewalk Chalk', 'scribbles' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'scribbles_default_hero_images' );

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

	$overrides = array(
		'header_font' => array(
			'default' => 'Architects Daughter',
			'css'     => array(
				'h1,
				h2,
				h3,
				h4,
				h5,
				h6,
				label,
				legend,
				table th,
				dl dt,
				.site-title,
				.entry-title,
				.widget-title,
				button,
				a.button,
				a.fl-button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.main-navigation ul li a' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'primary_font' => array(
			'default' => 'Raleway',
			'css'     => array(
				'body,
				p,
				ol li,
				ul li,
				dl dd,
				.fl-callout-text' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'secondary_font' => array(
			'default' => 'Raleway',
			'css'     => array(
				'blockquote,
				.entry-meta,
				.entry-footer,
				.comment-list li .comment-meta .says,
				.comment-list li .comment-metadata,
				.comment-reply-link,
				#respond .logged-in-as' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'scribbles_font_types' );

/**
 * Register colors.
 *
 * @action primer_colors
 * @since  1.0.0
 *
 * @return array
 */
function scribbles_colors() {

	return array(
		'background_color' => array(
			'label'   => esc_html__( 'Background Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'header_background_color' => array(
			'label'   => esc_html__( 'Header Background Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'header_text_color' => array(
			'label'   => esc_html__( 'Header Text Color', 'scribbles' ),
			'default' => '#222222',
			'css'     => array(
				'.site-title-wrapper .site-title a,.main-navigation ul a' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.site-description' => array(
					'color' => 'rgba(%1$s, 0.6)',
				),
			),
		),
		'menu_background_color' => array(
			'label'   => esc_html__( 'Menu Background Color', 'scribbles' ),
			'default' => '#b5345f',
			'css'     => array(
				'.main-navigation-container,.main-navigation ul ul' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'menu_text_color' => array(
			'label'   => esc_html__( 'Menu Text Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation ul a, .main-navigation-container .social-menu a' => array(
					'color' => '%1$s',
				),
				'.main-navigation .sub-menu .menu-item-has-children > a::after' => array(
					'border-left-color' => '%1$s',
				)
			),
			'rgba_css'     => array(
				'.main-navigation ul a, .main-navigation-container .social-menu a' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.main-navigation .sub-menu .menu-item-has-children > a::after' => array(
					'border-left-color' => 'rgba(%1$s, 0.8)',
				)
			),
		),
		'button_color' => array(
			'label'   => esc_html__( 'Button Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'button_bg_color' => array(
			'label'   => esc_html__( 'Button Background Color', 'scribbles' ),
			'default' => '#b5345f',
			'css'     => array(
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'footer_social_color' => array(
			'label'   => esc_html__( 'Footer Social Icon Color', 'scribbles' ),
			'default' => '#b5345f',
			'css'     => array(
				'.site-info-wrapper a, .site-info .social-menu a, .social-menu a' => array(
					'color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => esc_html__( 'Footer Background Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'scribbles' ),
			'default' => '#54ccbe',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget a, .main-navigation-container .menu li.current-menu-item > a:hover' => array(
					'color' => '%1$s',
				),
			),
		),
		'w_background_color' => array(
			'label'   => esc_html__( 'Footer Widget Background Color', 'scribbles' ),
			'default' => '#3f3244',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'w_text_color' => array(
			'label'   => esc_html__( 'Footer Widget Text Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-footer-inner' => array(
					'color' => '%1$s',
				),
			),
		),
	);

}
add_action( 'primer_colors', 'scribbles_colors' );

/**
 * Register color schemes.
 *
 * @action primer_color_schemes
 * @since  1.0.0
 *
 * @return array
 */
function scribbles_color_schemes() {

	return array(
		'bronze' => array(
			'label'  => esc_html__( 'Bronze', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#b1a18b',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#b1a18b',
				'footer_social_color'     => '#b1a18b',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#b1a18b',
				'w_background_color'      => '#b1a18b',
				'w_text_color'            => '#ffffff',
			),
		),
		'red' => array(
			'label'  => esc_html__( 'Red', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#cc494f',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#cc494f',
				'footer_social_color'     => '#cc494f',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#cc494f',
				'w_background_color'      => '#cc494f',
				'w_text_color'            => '#ffffff',
			),
		),
		'blue' => array(
			'label'  => esc_html__( 'Blue', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#499ccc',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#499ccc',
				'footer_social_color'     => '#499ccc',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#499ccc',
				'w_background_color'      => '#d6ebf9',
				'w_text_color'            => '#636363',
			),
		),
		'green' => array(
			'label'  => esc_html__( 'Green', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#62bf7c',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#62bf7c',
				'footer_social_color'     => '#62bf7c',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#62bf7c',
				'w_background_color'      => '#f2f2f2',
				'w_text_color'            => '#888888',
			),
		),
		'orange' => array(
			'label'  => esc_html__( 'Orange', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#ffffff',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#df6135',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#ffffff',
				'button_bg_color'         => '#df6135',
				'footer_social_color'     => '#df6135',
				'footer_background_color' => '#ffffff',
				'link_color'              => '#df6135',
				'w_background_color'      => '#222222',
				'w_text_color'            => '#ffffff',
			),
		),
		'yellow' => array(
			'label'  => esc_html__( 'Yellow', 'scribbles' ),
			'colors' => array(
				'background_color'        => '#e9e73d',
				'header_background_color' => '#e9e73d',
				'header_text_color'       => '#222222',
				'menu_background_color'   => '#222222',
				'menu_text_color'         => '#ffffff',
				'button_color'            => '#222222',
				'button_bg_color'         => '#e9e73d',
				'footer_social_color'     => '#222222',
				'footer_background_color' => '#e9e73d',
				'link_color'              => '#777777',
				'w_background_color'      => '#e9e73d',
				'w_text_color'            => '#3a3a3a',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'scribbles_color_schemes' );
