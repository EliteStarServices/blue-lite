<?php

/**
 * Template for Barebones Post Format
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('no-post-border'); ?>>
	<div class="entry-content">


	<?php
			// Check for Post Thumbnail / Featured Image.
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			}
			?>


		<?php the_content(bootstrapBasicMoreLinkText()); ?>
		<div class="clearfix"></div>

		<header class="entry-header">
			<div <?php post_class('no-post-border entry-meta'); ?> style="background:#f7f7f7;">
				<?php bootstrapBasicPostOn(); ?>
			</div>
		</header>

		<?php
		/**
		 * This wp_link_pages option adapt to use bootstrap pagination style.
		 * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
		 */
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'blue-lite') . ' <ul class="pagination">',
			'after'  => '</ul></div>',
			'separator' => '',
		));
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual 
		?>
			<div class="entry-meta-category-tag">
				<?php
				/* translators: used between list items, there is a space after the comma */
                // $categories_list = get_the_category_list(__(', ', 'blue-lite'));
				if (!empty($categories_list)) {
				?>
					<span class="cat-links">
						<?php echo bootstrapBasicCategoriesList($categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
				<?php } // End if categories 
				?>

				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list('', __(', ', 'blue-lite'));
				if ($tags_list) {
				?>
					<span class="tags-links">
						<?php echo bootstrapBasicTagsList($tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
				<?php } // End if $tags_list 
				?>
			</div><!--.entry-meta-category-tag-->
		<?php } // End if 'post' == get_post_type() 
		?>

		<div class="entry-meta-comment-tools">
			<?php if (! post_password_required() && (comments_open() || '0' != get_comments_number())) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual ?>
				<span class="comments-link"><?php bootstrapBasicCommentsPopupLink(); ?></span>
			<?php } //endif; 
			?>

			<?php bootstrapBasicEditPostLink(); ?>
		</div><!--.entry-meta-comment-tools-->
	</footer><!-- .entry-meta -->
</article><!-- #post -->