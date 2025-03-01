<?php

/* This file was adapted from 'notice.php', originally part of the QuadLayers WP Menu Icons plugin (https://quadlayers.com) */

class BH_Notices
{

	protected static $_instance;

	public function __construct()
	{
		add_action('wp_ajax_wpmi_dismiss_notice', array( $this, 'ajax_dismiss_notice' ));
		add_action('admin_notices', array( $this, 'add_notices' ));
	}

	function ajax_dismiss_notice()
	{
		if (check_admin_referer('wpmi_dismiss_notice', 'nonce') && isset($_REQUEST['notice_id'])) {

			$notice_id = sanitize_key($_REQUEST['notice_id']);

			update_user_meta(get_current_user_id(), $notice_id, true);
			set_transient('wpmi-notice-delay', true, MONTH_IN_SECONDS);

			wp_send_json($notice_id);
		}

		wp_die();
	}

	function add_transient()
	{
		set_transient('wpmi-notice-delay', true, MONTH_IN_SECONDS);
	}

	function add_notices()
	{

		$transient = get_transient('wpmi-notice-delay');

		if ($transient) {
			return;
		}

?>
		<script>
			(function($) {
				$(document).ready(() => {
					$('.wpmi-notice').on('click', '.notice-dismiss', function(e) {
						e.preventDefault();
						var notice_id = $(e.delegateTarget).data('notice_id');
						$.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								notice_id: notice_id,
								action: 'wpmi_dismiss_notice',
								nonce: '<?php echo esc_attr(wp_create_nonce('wpmi_dismiss_notice')); ?>'
							},
							success: function(response) {
								console.log(response);
							},
						});
					});
				})
			})(jQuery);
		</script>



		<div id="wpmi-admin-rating" class="wpmi-notice notice notice-warning is-dismissible" data-notice_id="wpmi-user-rating">
			<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
				<div class="dashicons dashicons-warning" style="font-size:50px;width:70px;margin-top:-30px;"></div>
				<div class="notice-content" style="margin-left: 15px;">

					UPGRADE WARNING AND INSTRUCTIONS HERE

				</div>
			</div>
		</div>


		<?php


		// CHECK IF POST TEMPLATE SELECT PLUGIN ACTIVE AND DEACTIVATE
		// Since 0.9.9.4 - Plugin functionality now provided by theme
		if (is_plugin_active('post-template-select/post-template-select.php')) {
		?>
			<div id="wpmi-admin-rating" class="wpmi-notice notice notice-info is-dismissible" data-notice_id="wpmi-user-rating">
				<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
					<div class="dashicons dashicons-plugins-checked" style="font-size:50px;width:70px;margin-top:-30px;"></div>
					<div class="notice-content" style="margin-left: 15px;">
						<p>
							<b>
								<?php printf(esc_html__('Post Template Select plugin found and active!', 'blue-lite'), 'Blue Haze'); ?>
							</b><br>
							<?php printf(esc_html__('Plugin conflicts with theme functionality and has been deactivated, refreshing in 5 seconds...', 'blue-lite'), 'Blue Haze'); ?>

							<meta http-equiv="refresh" content="5">

							<?php //deactivate_plugins(array(plugin_dir_path( __DIR__ ) . '/post-template-select/post-template-select.php'), '', false, false); 
							?>

							<?php deactivate_plugins('post-template-select/post-template-select.php');  ?>


						</p>
					</div>
				</div>
			</div>
			<?php
			return;
		} else {


			// CHECK IF POST TEMPLATE SELECT PLUGIN INSTALLED AND SUGGEST DELETE
			$bh_pts = WP_PLUGIN_DIR . '/post-template-select';
			if (file_exists($bh_pts)) {
			?>
				<div id="wpmi-admin-rating" class="wpmi-notice notice notice-info is-dismissible" data-notice_id="wpmi-user-rating">
					<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
						<div class="dashicons dashicons-plugins-checked" style="font-size:50px;width:70px;margin-top:-30px;"></div>
						<div class="notice-content" style="margin-left: 15px;">
							<p>
								<?php
								esc_html_e('Post Template Select plugin deactivated but still installed - Plugin duplicates theme functionality and should be removed.', 'blue-lite');
								echo '<hr>';
								if (is_multisite()) {
									switch_to_blog(1);
								?>
									<a href="<?php echo esc_url(site_url() . '/wp-admin/network/plugins.php'); ?>" class="button-primary">
									<?php
									restore_current_blog();
								} else {
									?>
										<a href="<?php echo esc_url(site_url() . '/wp-admin/plugins.php'); ?>" class="button-primary">
						<?php
								}
								esc_html_e('Go to Plugins', 'blue-lite');
								echo '
								</a>
								</p>
								</div>
								</div>
								</div>
								';
							} else { //phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedElse
								// echo "something could go here - but this is plugin not activated or installed";
							}
							return;
						}




						/* THE SECTION BELOW PROMOTED THE ORIGINAL PLUGIN AND HAS BEEN KEPT AS EXAMPLES
		$plugin_slug = WPMI_PREMIUM_SELL_SLUG;

		$user_rating     = ! get_user_meta( get_current_user_id(), 'wpmi-user-rating', true );
		$user_premium    = ! get_user_meta( get_current_user_id(), 'wpmi-user-premium', true ) && ! $this->is_installed( "{$plugin_slug}/{$plugin_slug}.php" );
		$user_cross_sell = ! get_user_meta( get_current_user_id(), 'wpmi-user-cross-sell', true );

		if ( $user_rating ) {
			?>
			<div id="wpmi-admin-rating" class="wpmi-notice notice notice-info is-dismissible" data-notice_id="wpmi-user-rating">
				<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
					<div class="notice-image">
						<img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url( '/assets/backend/img/logo.jpg', WPMI_PLUGIN_FILE ); ?>" alt="<?php echo esc_html( WPMI_PLUGIN_NAME ); ?>>">
					</div>
					<div class="notice-content" style="margin-left: 15px;">
						<p>
							<?php printf( esc_html__( 'Hello! Thank you for choosing the %s plugin!', 'wp-menu-icons' ), WPMI_PLUGIN_NAME ); ?>
							<br/>
							<?php esc_html_e( 'Could you please give it a 5-star rating on WordPress?. Your feedback will boost our motivation and help us promote and continue to improve this product.', 'wp-menu-icons' ); ?>
						</p>
						<a href="<?php echo esc_url( WPMI_REVIEW_URL ); ?>" class="button-primary" target="_blank">
							<?php esc_html_e( 'Yes, of course!', 'wp-menu-icons' ); ?>
						</a>
						<a href="<?php echo esc_url( WPMI_SUPPORT_URL ); ?>" class="button-secondary" target="_blank">
							<?php esc_html_e( 'Report a bug', 'wp-menu-icons' ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php
			return;
		}

		if ( ! $user_rating && $user_premium ) {
			?>
			<div class="wpmi-notice notice notice-info is-dismissible" data-notice_id="wpmi-user-premium">
				<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
					<div class="notice-image">
						<img style="border-radius:50%;max-width: 90px;" src="<?php echo esc_url( plugins_url( '/assets/backend/img/logo.jpg', WPMI_PLUGIN_FILE ) ); ?>" alt="<?php echo esc_html( WPMI_PLUGIN_NAME ); ?>>">
					</div>
					<div class="notice-content" style="margin-left: 15px;">
						<p>
						<?php esc_html_e( 'Hello! We have a special gift!', 'wp-menu-icons' ); ?>
							<br />
						<?php
						printf(
							esc_html__( 'Today we want to make you a special gift. Using this coupon before the next 48 hours you can get a 20 percent discount on the premium version of the %s plugin.', 'wp-menu-icons' ),
							esc_html( WPMI_PREMIUM_SELL_NAME )
						)
						?>
						</p>
						<a href="<?php echo esc_url( WPMI_PREMIUM_SELL_URL ); ?>" class="button-primary" target="_blank">
							<?php esc_html_e( 'More info', 'wp-menu-icons' ); ?>
						</a>
						<input style="width:130px" type="text" value="ADMINPANEL20%"/>
					</div>
				</div>
			</div>
			<?php
			return;
		}

		if ( ! $user_rating && ! $user_premium && $user_cross_sell ) {

			$cross_sell = $this->get_cross_sell();

			if ( empty( $cross_sell ) ) {
				return;
			}

			list($action, $action_link) = $cross_sell;

			?>
			<div class="wpmi-notice notice notice-info is-dismissible" data-notice_id="wpmi-user-cross-sell">
				<div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
					<div class="notice-image">
						<img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url( '/assets/backend/img/logo.jpg', WPMI_PLUGIN_FILE ); ?>" alt="<?php echo esc_html( WPMI_PLUGIN_NAME ); ?>>">
					</div>
					<div class="notice-content" style="margin-left: 15px;">
						<p>
						<?php printf( esc_html__( 'Hello! We want to invite you to try our %s plugin!', 'wp-menu-icons' ), esc_html( WPMI_CROSS_INSTALL_NAME ) ); ?>
							<br/>
						<?php echo esc_html( WPMI_CROSS_INSTALL_DESCRIPTION ); ?>
						</p>
						<a href="<?php echo esc_url( $action_link ); ?>" class="button-primary">
						<?php echo esc_html( $action ); ?>
						</a>
						<a href="<?php echo esc_url( WPMI_CROSS_INSTALL_URL ); ?>" class="button-secondary" target="_blank">
						<?php esc_html_e( 'More info', 'wp-menu-icons' ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php
			return;
		}
*/



						// ADD NOTICES END
					}



					/*
	function get_cross_sell() {

		$screen = get_current_screen();

		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return array();
		}

		$plugin_slug = WPMI_CROSS_INSTALL_SLUG;

		$plugin_file = "{$plugin_slug}/{$plugin_slug}.php";

		if ( is_plugin_active( $plugin_file ) ) {
			return array();
		}

		if ( $this->is_installed( $plugin_file ) ) {

			if ( ! current_user_can( 'activate_plugins' ) ) {
				return array();
			}

			return array(
				esc_html__( 'Activate', 'wp-menu-icons' ),
				wp_nonce_url( "plugins.php?action=activate&amp;plugin={$plugin_file}&amp;plugin_status=all&amp;paged=1", "activate-plugin_{$plugin_file}" ),
			);

		}

		if ( ! current_user_can( 'install_plugins' ) ) {
			return array();
		}

		return array(
			esc_html__( 'Install', 'wp-menu-icons' ),
			wp_nonce_url( self_admin_url( "update.php?action=install-plugin&plugin={$plugin_slug}" ), "install-plugin_{$plugin_slug}" ),
		);

	}
*/



					function is_installed($path)
					{

						$installed_plugins = get_plugins();

						return isset($installed_plugins[$path]);
					}

					public static function instance()
					{
						if (is_null(self::$_instance)) {
							self::$_instance = new self();
						}
						return self::$_instance;
					}
				}


				BH_Notices::instance();
