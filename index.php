<?php

/**
 * The Main Template
 */

get_header();

/* Determine Main Column Size from Actived Sidebar(s) */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>
<div class="col-md-<?php echo esc_attr($main_column_size); ?> content-area" id="main-column">
	<main id="main" class="site-main" role="main">
		<?php if (have_posts()) { ?>
			<?php
			// start the loop
			while (have_posts()) {
				the_post();

				/* 
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part('content', get_post_format());
			} // end while

			bootstrapBasicPagination();
			?>
		<?php } else { ?>
			<?php get_template_part('no-results', 'index'); ?>
		<?php } // endif; 
		?>
	</main>
</div>
<?php
get_sidebar('right');
get_footer();
?>