<?php

/**
 * Archive Page (category, tag, archives post, author's post)
 */

get_header();

/* Determine Main Column Size from Actived Sidebar(s) */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>
<div class="col-md-<?php echo esc_attr($main_column_size); ?> content-area" id="main-column">
	<main id="main" class="site-main" role="main">
		<?php if (have_posts()) { ?>

			<header class="panel panel-default">
				<h3 class="panel-body neg-margins">
					<?php
					if (is_category()) :
						single_cat_title();

					elseif (is_tag()) :
						single_tag_title();

					elseif (is_author()) :
						/* 
						 * Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 */
						the_post();
						// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
						/* translators: %s Author name. */
						printf(__('Author: %s', 'blue-lite'), '<span class="vcard">' . get_the_author() . '</span>');
						/* 
						 * Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif (is_day()) :
						/* translators: %s Date value. */
						printf(__('Day: %s', 'blue-lite'), '<span>' . get_the_date() . '</span>');

					elseif (is_month()) :
						/* translators: %s Month value. */
						printf(__('Month: %s', 'blue-lite'), '<span>' . get_the_date('F Y') . '</span>');

					elseif (is_year()) :
						/* translators: %s Year value. */
						printf(__('Year: %s', 'blue-lite'), '<span>' . get_the_date('Y') . '</span>');
					// phpcs:enable

					elseif (is_tax('post_format', 'post-format-image')) :
						esc_html_e('Images', 'blue-lite');

					elseif (is_tax('post_format', 'post-format-video')) :
						esc_html_e('Videos', 'blue-lite');

					elseif (is_tax('post_format', 'post-format-quote')) :
						esc_html_e('Quotes', 'blue-lite');

					elseif (is_tax('post_format', 'post-format-link')) :
						esc_html_e('Links', 'blue-lite');

					else :
						esc_html_e('Archives', 'blue-lite');

					endif;
					?>
				</h3>

				<?php

				/* Show the Optional Term Description */
				$term_description = term_description();
				if (!empty($term_description)) {
					/* translators: %s Description. */
					printf('<div class="taxonomy-description" style="margin-left:15px;">%s</div>', $term_description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} //endif;
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while (have_posts()) {
				the_post();

				/* 
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

				get_template_part('content', get_post_format());
				/* POST SEPARATION */
				echo "<hr>";
			} //endwhile; 
			?>
			<div style="margin-top:-26px;"></div><!-- Hides last HR -->
			<?php bootstrapBasicPagination(); ?>

		<?php } else { ?>

			<?php get_template_part('no-results', 'archive'); ?>

		<?php } //endif; 
		?>
	</main>
</div>
<?php
get_sidebar('right');
get_footer();
?>