<?php

/* 404 Template */

get_header();

?>

<div class="col-md-12 content-area" id="main-column">
	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found">
			<header class="_page-header">
				<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'blue-lite'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e('Nothing was found at this location. If something was here, it is gone now | Please try a Search.', 'blue-lite'); ?></p>

				<?php
				echo bootstrapBasicFullPageSearchForm(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
				?>

			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>