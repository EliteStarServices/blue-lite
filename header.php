<?php

/**
 * Blue Lite Theme Header
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php
	/* LOAD DYNAMIC CSS FOR MENU BREAKPOINT */
	require_once get_template_directory() . '/inc/blue-lite-menu.php';
	?>

	<!--wordpress head-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	} else {
		do_action('wp_body_open');
	}


	// CHECK IF PRIMARY MENU ASSIGNED
	$is_assigned = has_nav_menu('primary');

	?>

	<!--[if lt IE 8]>
			<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
		<![endif]-->

	<div class="container page-container">
		<?php do_action('before'); ?>
		<header role="banner">
			<div class="row site-branding">
				<div class="col-md-6 site-title">


					<?php
					// DISPLAY CUSTOM LOGO IF DEFINED
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
					if (has_custom_logo()) {
						echo "<a href='" . esc_url(home_url('/')) . "' title='" . esc_html(get_bloginfo('name', 'display')) . "' rel='home'>";
						echo '<img src="' . esc_url($logo[0]) . '" style="margin-top:5px;" class="logo-margins" alt="' . esc_html(get_bloginfo('name')) . '"></a>';
					} else {
						// DISPLAY NAME AND DESCRIPTION
					?>
						<h2 class="site-title-heading">
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						</h2>
						<div class="site-description">
							<small>
								<?php bloginfo('description'); ?>
							</small>
						</div>
					<?php
					}
					?>


				</div>
				<div class="col-md-6 page-header-top-right">
					<div class="sr-only">
						<a href="#content" title="<?php esc_attr_e('Skip to Content', 'blue-lite'); ?>"><?php esc_html_e('Skip to Content', 'blue-lite'); ?></a>
					</div>
					<?php if (is_active_sidebar('header-right')) { ?>
						<div class="pull-right">
							<?php dynamic_sidebar('header-right'); ?>
						</div>
						<div class="clearfix"></div>
					<?php } // endif; 
					?>
				</div>
			</div><!--.site-branding-->


			<?php
			/* DISPLAY PRIMARY MENU IF DEFINED */
			if ($is_assigned) {
			?>

				<div class="row main-navigation">
					<div class="col-md-12">
						<nav class="navbar-default" role="navigation">

							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<span class="menu-toggle-text">☰</span>
							</button>
							<?php wp_nav_menu(array( 'theme_location' => 'primary', 'container_class' => 'main-nav', 'menu_class' => 'nav-menu' )); ?>

							<?php //dynamic_sidebar('navbar-right'); 
							?>

						</nav>
					</div>
				</div><!--.main-navigation-->

			<?php } ?>

		</header>
		<br>
		<div id="content" class="row row-with-vspace site-content">