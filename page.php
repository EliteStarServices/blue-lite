<?php

/**
 * Template for Displaying Pages
 */

get_header();

/* Determine Main Column Size from Actived Sidebar(s) */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>

<?php get_sidebar('left'); ?>
<?php /* Remove _ from Main Column to Activate Container (Border) */ ?>
<div class="col-md-<?php echo esc_attr($main_column_size); ?> content-area" id="_main-column">
	<main id="main" class="site-main" role="main">
		<?php
		while (have_posts()) {
			the_post();

			get_template_part('content', 'page');

			// If comments are open or we have at least one comment, load up the comment template
			if (comments_open() || '0' != get_comments_number()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
				comments_template();
			}
		} //endwhile;
		?>
	</main>
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>