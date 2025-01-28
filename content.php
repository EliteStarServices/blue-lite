<?php

/**
 * Template for Standard Post Format
 */

?>
<article id="post-<?php the_ID(); ?>"
	<?php
	// Check if Sticky Post.
	if (! is_sticky()) {
		post_class('no-post-border');
	} else {
		post_class('no-post-border, sticky');
	}
	?>>

	<header class="entry-header panel panel-default panel-body" style="margin-top:5px;">
		<h3 class="entry-title" style="margin-top:-5px;"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

		<?php if ('post' == get_post_type()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual 
		?>
			<div class="entry-meta">
				<?php bootstrapBasicPostOn(); ?>
			</div><!-- .entry-meta -->
		<?php } //endif; 
		?>
	</header><!-- .entry-header -->


	<?php if (is_search()) { // Only display Excerpts for Search 
	?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<div class="clearfix"></div>
		</div><!-- .entry-summary -->
	<?php } else { ?>
		<div class="entry-content">

			<?php
			// Check for Post Thumbnail / Featured Image.
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			}
			?>

			<?php the_content(bootstrapBasicMoreLinkText()); ?>
			<div class="clearfix"></div>
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
	<?php } //endif; 
	?>


	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual 
		?>
			<div class="entry-meta-category-tag">

				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list('', __(', ', 'blue-lite'));
				if ($tags_list) {
				?>
					<span class="tags-links">
						<?php echo bootstrapBasicTagsList($tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					</span>
				<?php } // End if $tags_list 
				?>
			</div><!--.entry-meta-category-tag-->
		<?php } // End if 'post' == get_post_type() 
		?>

		<div class="entry-meta-comment-tools">
			<?php if (! post_password_required() && (comments_open() || '0' != get_comments_number())) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual 
			?>
				<span class="comments-link"><?php bootstrapBasicCommentsPopupLink(); ?></span>
			<?php } //endif; 
			?>

			<?php bootstrapBasicEditPostLink(); ?>

			<?php $categories_list = get_the_category_list(__(', ', 'blue-lite')); ?>
			<?php if (!empty($categories_list)) { ?>
				<?php echo bootstrapBasicCategoriesList($categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
				?>
			<?php } ?>

		</div><!--.entry-meta-comment-tools-->
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->