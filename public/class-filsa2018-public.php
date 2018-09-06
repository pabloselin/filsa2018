<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://apie.cl
 * @since      1.0.0
 *
 * @package    Filsa2018
 * @subpackage Filsa2018/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Filsa2018
 * @subpackage Filsa2018/public
 * @author     Pablo Selín Carrasco Armijo - A Pie <pablo@apie.cl>
 */
class Filsa2018_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function get_cmb2_option( $key = '', $default = false ) {
		if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
			return cmb2_get_option( 'filsa2018_options', $key, $default );
		}

	// Fallback to get_option if CMB2 is not loaded yet.
		$opts = get_option( 'filsa2018_options', $default );

		$val = $default;

		if ( 'all' == $key ) {
			$val = $opts;
		} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$val = $opts[ $key ];
		}

		return $val;
	}

	public function rest_cmb2_option( ) {
		register_rest_route( 'filsa2018/v1/', '/options/(?P<option>\w+)', array(
			'methods' => 'GET',
			'callback' => array($this, 'rest_get_cmb2_option'),
			'args' => array(
				'option' => array(
					'validate_callback' => function( $param, $request, $key) {
						return sanitize_text_field( $param );
					}
				)
			)
		) );
	}

	public function  rest_get_cmb2_option( WP_REST_Request $request ) {
		return $this->get_cmb2_option( $request->get_param('option') );
	}

	public function rest_menu( ) {
		register_rest_route( 'filsa2018/v1/', '/menus/(?P<menus>\w+)', array(
			'methods' => 'GET',
			'callback' => array($this, 'rest_get_menus'),
			'args' => array(
				'menus' => array(
					'validate_callback' => function( $param, $request, $key) {
						return sanitize_text_field( $param );
					}
				)
			)
		));
	}

	public function rest_get_menus( WP_REST_Request $request ) {
		return wp_get_nav_menu_items( $request->get_param('menus') );
	}

	public function rest_filsa2018params() {
		register_rest_route( 'filsa2018/v1/', '/params/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018params')
		));
	}

	public function filsa2018params( WP_REST_Request $request ) {
		$cached_params = get_transient('filsa2018params');

		if( false !== $cached_params) {
			return $cached_params;
		}

		$params = ['filsa2018_cabecera_escritorio', 'filsa2018_cabecera_movil', 'filsa2018_placeholder', 'filsa2018_map', 'filsa2018_menu', 'filsa2018_menunoticias', 'filsa2018_menueventos', 'filsa2018_taxfilsa', 'filsa2018_inicio', 'filsa2018_fin', 'filsa2018_twitter', 'filsa2018_instagram', 'filsa2018_facebook', 'filsa2018_flickr', 'filsa2018_intro', 'filsa2018_title', 'filsa2018_titleinside', 'filsa2018_formurl', 'filsa2018_taxfilsavisitas', 'filsa2018_taxfilsafirmas'];

		$params_content = array();

		foreach($params as $key=>$param) {
			$fieldcontent = $this->get_cmb2_option($param);
			if($fieldcontent) {
				if($param == 'filsa2018_menu' || $param == 'filsa2018_menunoticias' || $param == 'filsa2018_menueventos') {
					$params_content[$param] = wp_get_nav_menu_items( $fieldcontent );
				} else {
					$params_content[$param] = $fieldcontent;
				}			
			}
		}

		$params_transient = set_transient('filsa2018params', $params_content, 3600);

		if( false === $params_transient) {
			return false;
		}


		return get_transient('filsa2018params');
	}


	public function condition() {
		global $post;
		
		$filsa2018 = $this->get_cmb2_option( 'filsa2018_taxfilsa' );

		if(
			is_post_type_archive( 'filsa-2018' ) ||
			is_singular( 'filsa-2018' ) ||
			is_singular( 'post' ) && has_term( $filsa2018, 'ferias', $post->ID ) ||
			is_tax( 'ferias', 'filsa-2018' ) ||
			is_singular( 'tribe_events' ) && has_term( $filsa2018, 'ferias', $post->ID) 
		):
			return true;
		endif;
	}

	public function replace_single_template( $single_template ) {
		/* Reemplaza todos los singles relacionados con FILSA 2018 */
		$isfilsa = $this->condition();

		if( $isfilsa == true ) {
			$single_template = plugin_dir_path( __FILE__ ) . 'partials/filsa2018-public-display.php';
		}

		return $single_template;
	}

	public function redirect_noticia_filsa( ) {
		global $post;
		$slug = $post->post_name;

		if(is_object_in_term( $post->ID, 'ferias', 'filsa-2018' ) && is_singular('post') ) {
			//var_dump($post);
			$url = add_query_arg('slug', $slug, get_bloginfo( 'url' ) .'/ferias/filsa/filsa-2018/noticias');
			$cleanurl = get_bloginfo( 'url' ) .'/ferias/filsa/filsa-2018/?noticia=' . $slug;
		 	wp_redirect( $cleanurl );
		 	exit;
		 }
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Filsa2018_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Filsa2018_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/filsa2018-public.css', array(), $this->version, 'all' );

	}

	public function dequeue_styles() {
		$isfilsa = $this->condition();

		if( $isfilsa == true ) {
			wp_dequeue_style( 'camara' );
			wp_dequeue_style( 'legacy' );
			wp_dequeue_style( 'fontawesome' );
			wp_dequeue_style( 'mailchimp' );
		}
	}

	public function dequeue_scripts() {
		$isfilsa = $this->condition();

		if( $isfilsa == true ) {
			wp_dequeue_script( 'camara' );
		}
	}

	public function replace_template() {
		/**
		Reemplaza las plantillas por defecto de WordPress para todo lo que sea FILSA 2018
		*/
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Filsa2018_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Filsa2018_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/filsa2018-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'filsa2018', array( 'scriptsurl' => plugin_dir_url(__FILE__) ) );

	}

	public function enqueue_manifest() {
		echo '<link rel="manifest" href="' . plugin_dir_url( __FILE__ ) . 'manifest.json' . '">';
	}

}
