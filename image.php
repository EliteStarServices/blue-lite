<?php

/**
 * For Displaying Image Attachments.
 */

get_header();

?>
<div class="col-md-12 content-area image-attachment" id="main-column">
	<main id="main" class="site-main" role="main">
		<?php
		while (have_posts()) {
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

					<div class="entry-meta">
						<?php
						$metadata = wp_get_attachment_metadata();
						/* translators: %1$s: Date/time in datetime attribute, %2$s: Readable date/time, %3$s: URL, %4$s: Attachment width, %5$s: Attachment height, %6$s: Link to post parent, %7$s: Post parent title in the title attribute, %8$s: Post parent title. */
						printf(
							// phpcs:disable
							__('Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'blue-lite'),
							esc_attr(get_the_date('c')),
							esc_html(get_the_date()),
							esc_url(wp_get_attachment_url()),
							$metadata['width'],
							$metadata['height'],
							esc_url(get_permalink($post->post_parent)),
							esc_attr(strip_tags(get_the_title($post->post_parent))),
							get_the_title($post->post_parent)
							// phpcs:enable
						);

						echo ' ';
						bootstrapBasicEditPostLink();
						// edit_post_link(__('Edit', 'blue-lite'), '<span class="edit-link">', '</span>');
						?>
					</div><!-- .entry-meta -->

					<ul role="navigation" id="image-navigation" class="image-navigation pager">
						<li class="nav-previous previous"><?php previous_image_link(false, __('<span class="meta-nav">&larr;</span> Previous', 'blue-lite')); ?></li>
						<li class="nav-next next"><?php next_image_link(false, __('Next <span class="meta-nav">&rarr;</span>', 'blue-lite')); ?></li>
					</ul><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php bootstrapBasicTheAttachedImage(); ?>
						</div><!-- .attachment -->

						<?php if (has_excerpt()) { ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
						<?php } //endif; 
						?>
					</div><!-- .entry-attachment -->

					<?php the_content(); ?>

				</div><!-- .entry-content -->

				<?php bootstrapBasicEditPostLink(); ?>
			</article><!-- #post-## -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if (comments_open() || '0' != get_comments_number()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
				comments_template();
			}
			?>

		<?php
		} //endwhile; // end of the loop. 
		?>
	</main>
</div>
<?php get_footer();
