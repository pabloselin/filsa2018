<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://apie.cl
 * @since      1.0.0
 *
 * @package    Filsa2018
 * @subpackage Filsa2018/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Filsa2018
 * @subpackage Filsa2018/includes
 * @author     Pablo Selín Carrasco Armijo - A Pie <pablo@apie.cl>
 */
class Filsa2018 {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Filsa2018_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'filsa2018';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->filsa2018_head();
		
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Filsa2018_Loader. Orchestrates the hooks of the plugin.
	 * - Filsa2018_i18n. Defines internationalization functionality.
	 * - Filsa2018_Admin. Defines all hooks for the admin area.
	 * - Filsa2018_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-filsa2018-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-filsa2018-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-filsa2018-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-filsa2018-public.php';

		$this->loader = new Filsa2018_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Filsa2018_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Filsa2018_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Filsa2018_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// Custom content
		$this->loader->add_action( 'init', $plugin_admin, 'custom_content' );
		$this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'options_metaboxes');
		$this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'content_metaboxes');

		/* Añadir Menus */
		$this->loader->add_action( 'init', $plugin_admin, 'menu_positions');


	}

	private function filsa2018_head() {
		do_action('filsa2018_head');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		global $post;

		$plugin_public = new Filsa2018_Public( $this->get_plugin_name(), $this->get_version() );
		$isfilsa = new Filsa2018_Public( $this->get_plugin_name(), $this->get_version() );

		if( $isfilsa == true ) {

			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

			/* Retirar los estilos y scripts de cámara */

			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'dequeue_styles', 100 );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'dequeue_scripts', 100 );

			/*SEO*/
			$this->loader->add_action( 'filsa2018_head', $plugin_public, 'ogimage_filsa');
			
			$this->loader->add_action( 'filsa2018_head', $plugin_public, 'yoast_tags');
			
			$this->loader->add_action( 'filsa2018_head', $plugin_public, 'pagetitle');
			//$this->loader->add_action( 'filsa2018_head', $plugin_public, 'replace_og_tags_in_404');
			$this->loader->add_action( 'filsa2018_head', $plugin_public, 'loggedin_var');
			$this->loader->add_action( 'filsa2018_head', $plugin_public, 'output_parameters');
			//Shortcodes
			 $this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );
			
			/* Reemplazar los templates */

			$this->loader->add_action( 'template_include', $plugin_public, 'replace_single_template' );
			$this->loader->add_action( 'template_redirect', $plugin_public, 'redirect_noticia_filsa' );
			$this->loader->add_action( 'template_include', $plugin_public, 'redirect_404_if_filsa' );
			$this->loader->add_action( 'template_include', $plugin_public, 'serviceworker_endpoint' );
			$this->loader->add_action( 'init', $plugin_public, 'serviceworker_path');

			/* Añadir Manifest para la PWA */

			//$this->loader->add_action( 'wp_head', $plugin_public, 'enqueue_manifest' );

			/* Añadir Custom REST Endpoints */
			$this->loader->add_action( 'rest_api_init', $plugin_public, 'rest_cmb2_option');
			$this->loader->add_action( 'rest_api_init', $plugin_public, 'rest_filsa2018params');
			$this->loader->add_action( 'rest_api_init', $plugin_public, 'rest_filsa2018events');
			$this->loader->add_action( 'rest_api_init', $plugin_public, 'rest_filsa2018eventslug');

		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Filsa2018_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
