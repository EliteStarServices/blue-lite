<?php

/* Template Name: No Branding Post */
/* Template Post Type: post */

get_header('notitle');

/* Determine Main Column Size from Actived Sidebar(s) */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>
<div class="col-md-<?php echo esc_attr($main_column_size); ?> content-area" id="main-column">
	<main id="main" class="site-main" role="main">
		<?php
		while (have_posts()) {

			the_post();

			get_template_part('content', get_post_format());

			echo "\n\n";

			bootstrapBasicPagination();

			echo "\n\n";

			// If comments are open or we have at least one comment, load up the comment template
			if (comments_open() || '0' != get_comments_number()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
				comments_template();
			}

			echo "\n\n";
		} //endwhile;
		?>
	</main>
</div>
<?php
get_sidebar('right');
get_footer();
?>