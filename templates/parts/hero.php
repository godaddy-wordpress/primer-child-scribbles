<?php
/**
 * The template for displaying the hero.
 *
 * @package Scribbles
 * @since 1.0.0
 */
?>
<?php if ( ! empty( scribbles_get_custom_header() ) ) : ?>

<div class="hero" style="background:url('<?php echo scribbles_get_custom_header( ); ?>') no-repeat top center; background-size: cover;">

<?php else : ?>

<div class="hero">

<?php endif; ?>

	<div class="hero-wrapper">

		<div class="hero-inner">

			<?php do_action( 'scribbles_hero' ); ?>

			<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

				<div class="hero-widget-area">

					<?php dynamic_sidebar( 'hero' ); ?>

				</div>

			<?php endif; ?>

		</div>

	</div>

</div>
