<?php

/**
 * Blue Lite No Title Header
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


		<?php
		/* DISPLAY PRIMARY MENU IF DEFINED */
		if ($is_assigned) {
		?>

			<div class="row main-navigation">
				<div class="col-md-12">
					<nav class="navbar-default" role="navigation">
						<div class="_collapse _navbar-collapse _navbar-primary-collapse">

							<?php wp_nav_menu(array( 'theme_location' => 'primary', 'container_class' => 'main-nav', 'menu_class' => 'nav-menu' )); ?>

							<?php //dynamic_sidebar('navbar-right'); 
							?>
						</div><!--.navbar-collapse-->
					</nav>
				</div>
			</div><!--.main-navigation-->

		<?php } ?>

		</header>
		<br>
		<div id="content" class="row row-with-vspace site-content">