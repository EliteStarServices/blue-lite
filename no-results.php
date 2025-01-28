<?php

/**
 * The template part for displaying message that posts cannot be found.
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e('Nothing Found', 'blue-lite'); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content row-with-vspace">
		<?php if (is_home() && current_user_can('publish_posts')) { ?>
			<p><?php
				/* translators: %1$s: Link to add new post. */
				printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'blue-lite'), esc_url(admin_url('post-new.php'))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?></p>
		<?php } elseif (is_search()) { ?>
			<p><?php esc_html_e('Nothing matched your search terms. Please try again with different keywords.', 'blue-lite'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php } else { ?>
			<p><?php esc_html_e('We can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'blue-lite'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php } //endif; 
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->