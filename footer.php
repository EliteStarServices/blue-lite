<?php

/**
 * Blue Lite Footer
 */

?>
</div><!--.site-content-->
<?php

/* USE DEFAULT OR CUSTOM FOOTER */
if (!dynamic_sidebar('footer-custom')) {

	// CHECK: ClassicPress or WordPress
	global $cp_version;
	if (!$cp_version) {
		$cmsLink = '<a href="https://wordpress.org">WordPress</a>';
	} else {
		$cmsLink = '<a href="https://classicpress.net">ClassicPress</a>';
	}

?>

	<div class="container-fluid">
		<hr class="footer-thin">
		<div class="text-center center-block">

			<p class="txt-railway"><a href="https://elite-star-services.com/">Blue Lite</a> for <?php echo wp_kses_post($cmsLink); ?>
				| © <?php echo esc_html(gmdate("Y")); ?> <a href="https://elite-star-services.com">Elite Star Services</a></p>
		</div>
	</div>

<?php } ?>

</div><!--.container page-container-->

<?php wp_footer(); ?>
</body>

</html>