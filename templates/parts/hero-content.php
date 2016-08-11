<div class="hero-wrapper">

	<div class="hero-inner">

		<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php else : ?>

			<?php get_template_part( 'templates/parts/page-title' ); ?>

		<?php endif; ?>

	</div>

</div>
