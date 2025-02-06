<?php

/* Template Name: Clean Slate (Content Only) */
/* Template Post Type: page */

get_header('clean');

		// set full width - no sidebars
		//$main_column_size = bootstrapBasicGetMainColumnSize();
		$main_column_size = 12;

		//get_sidebar('left'); 
		?>
		<div class="col-md-<?php echo esc_attr($main_column_size); ?> content-area">
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
		<?php
		//get_sidebar('right'); 
		get_footer();
		?>