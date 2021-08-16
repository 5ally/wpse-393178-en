<?php
class WPSE_393178_EN_Admin {
	private $page_title, $menu_title, $menu_slug = 'wpse-393178-en';

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_management_page' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'wp_ajax_wpse-393178-en', [ $this, 'ajax_wpse_393178' ] );

		$this->page_title = __( 'WPSE 393178 EN', 'wpse-393178-en' );
		$this->menu_title = __( 'WPSE 393178 EN', 'wpse-393178-en' );
	}

	public function add_management_page() {
		add_management_page( $this->page_title, $this->menu_title, 'manage_options',
			$this->menu_slug, [ $this, 'the_management_page' ] );
	}

	public function admin_enqueue_scripts( $hook_suffix ) {
		if ( $hook_suffix === get_plugin_page_hook( $this->menu_slug, '' ) ) {
			wp_enqueue_script( 'wpse-393178-en-admin-script',
				plugins_url( 'admin-script.js', __FILE__ ), [ 'jquery', 'wp-i18n' ] );

			// Load translations retrieved using the wp.i18n API, e.g. wp.i18n.__().
			wp_set_script_translations( 'wpse-393178-en-admin-script', 'wpse-393178-en',
				plugin_dir_path( __FILE__ ) . 'languages' );
		}
	}

	public function the_management_page() {
		include __DIR__ . '/admin-page.php';
	}

	private function var_dump_output() {
		?>
			<p>
				<?php _e( 'Output of', 'wpse-393178-en' ); ?>
				<code>var_dump( get_locale(), get_user_locale(), determine_locale() )</code>:
			</p>

			<pre><?php var_dump( get_locale(), get_user_locale(), determine_locale() ); ?></pre>
		<?php
	}

	public function ajax_wpse_393178() {
		printf(
			/* translators: %1$d: A random number. %2$s: Locale like en_US */
			__( 'AJAX text loaded - <i>Random number: %1$d.</i> Current locale is <b>%2$s</b>.', 'wpse-393178-en' ),
			mt_rand(), determine_locale()
		);

		wp_die();
	}
}
