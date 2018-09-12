<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://apie.cl
 * @since      1.0.0
 *
 * @package    Filsa2018
 * @subpackage Filsa2018/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Filsa2018
 * @subpackage Filsa2018/admin
 * @author     Pablo Selín Carrasco Armijo - A Pie <pablo@apie.cl>
 */
class Filsa2018_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/filsa2018-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/filsa2018-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function menu_positions() {
		register_nav_menus( array(
			'main_menu_filsa2018' => 'Navegación principal FILSA 2018',
			'featured_news_filsa2018' => 'Noticias destacadas FILSA 2018',
			'featured_events_filsa2018' => 'Eventos destacados FILSA 2018'
		));
	}

	public function custom_content() {

	$labels = array(
		'name'                  => _x( 'FILSA 2018', 'Post Type General Name', 'filsa' ),
		'singular_name'         => _x( 'Contenido FILSA 2018', 'Post Type Singular Name', 'filsa' ),
		'menu_name'             => __( 'Contenidos FILSA 2018', 'filsa' ),
		'name_admin_bar'        => __( 'FILSA 2018', 'filsa' ),
		'archives'              => __( 'Archivo de Contenidos FILSA 2018', 'filsa' ),
		'attributes'            => __( 'Atributos del Item', 'filsa' ),
		'parent_item_colon'     => __( 'Contenido superior:', 'filsa' ),
		'all_items'             => __( 'Todos los contenidos FILSA 2018', 'filsa' ),
		'add_new_item'          => __( 'Añadir nuevo contenido FILSA 2018', 'filsa' ),
		'add_new'               => __( 'Añadir nuevo', 'filsa' ),
		'new_item'              => __( 'Nuevo Contenido FILSA 2018', 'filsa' ),
		'edit_item'             => __( 'Editar contenido FILSA 2018', 'filsa' ),
		'update_item'           => __( 'Actualizar contenido', 'filsa' ),
		'view_item'             => __( 'Ver contenido', 'filsa' ),
		'view_items'            => __( 'Ver contenidos FILSA 2018', 'filsa' ),
		'search_items'          => __( 'Buscar contenidos FILSA 2018', 'filsa' ),
		'not_found'             => __( 'No encontrado', 'filsa' ),
		'not_found_in_trash'    => __( 'No encontrado en Papelera', 'filsa' ),
		'featured_image'        => __( 'Imagen destacada', 'filsa' ),
		'set_featured_image'    => __( 'Asignar imagen destacada', 'filsa' ),
		'remove_featured_image' => __( 'Quitar imagen destacada', 'filsa' ),
		'use_featured_image'    => __( 'Usar como imagen destacada', 'filsa' ),
		'insert_into_item'      => __( 'Insertar en el contenido', 'filsa' ),
		'uploaded_to_this_item' => __( 'Subido a este contenido', 'filsa' ),
		'items_list'            => __( 'Lista de contenidos FILSA 2018', 'filsa' ),
		'items_list_navigation' => __( 'Navegación de lista de contenidos FILSA 2018', 'filsa' ),
		'filter_items_list'     => __( 'Filtrar lista de contenidos FILSA 2018', 'filsa' ),
	);
	$rewrite = array(
		'slug'                  => 'ferias/filsa/filsa-2018',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Contenido FILSA 2018', 'filsa' ),
		'description'           => __( 'Contenidos estáticos para FILSA 2018', 'filsa' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => null,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	
	if(!post_type_exists( 'filsa-2018' )) {
		register_post_type( 'filsa-2018', $args );
	}
}


public function selectpage( $field) {
	$selected_template = $field['file'];
	$args = array(
		'post_type' => 'filsa-2018',
		'numberposts' => -1,
		'meta_key' => '_wp_page_template',
		'meta_value' => $selected_template
		);

	$items = get_posts($args);
	$values = array();
	foreach($items as $item) {
		$values[$item->ID] = $item->post_title;
	}
	return $values;
}

public function return_idmenuofpositions() {
	$positions = get_nav_menu_locations();
	$options = array();
	if($positions) {
		foreach($positions as $location => $position) {
			$menu = wp_get_nav_menu_object( $position );
			$options[$menu->term_id] = $menu->name;
		}
	}
	return $options;
}

public function content_metaboxes() {
	$prefix = 'filsa2018';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'filsa2018_template',
		'title'        => __( 'Seleccionar componente', 'filsa2018' ),
		'object_types' => array( 'filsa-2018' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'id' => $prefix . '_componente',
		'type' => 'select',
		'options' => array(
			'normal' => __('Normal', 'filsa2018'),
			'programa' => __( 'Programa', 'filsa2018' ),
			'buscalibros' => __( 'Buscador de libros', 'filsa2018' ),
			'invitados' => __( 'Invitados', 'filsa2018' ),
			'visitas-guiadas' => __( 'Visitas guiadas', 'filsa2018' ),	
		),
	) );
}

public function options_metaboxes() {
	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'filsa2018_option_metabox',
		'title'        => esc_html__( 'Parámetros FILSA 2018', 'filsa2018' ),
		'object_types' => array( 'options-page' ),
		'show_in_rest' => WP_REST_Server::READABLE,
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'filsa2018_options', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'filsa2018' ), // Falls back to 'title' (above).
		'parent_slug'     => 'edit.php?post_type=filsa-2018', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'filsa2018' ), // The text for the options-page save button. Defaults to 'Save'.
	) );

	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */

	$cmb_options->add_field( array(
		'name' => __( 'Cabecera escritorio', 'filsa_2018' ),
		'id' => 'filsa2018_cabecera_escritorio',
		'type' => 'file',
		'desc' => __( 'Imagen de 1200x320 píxeles jpg o png', 'filsa_2018' )
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Cabecera móvil', 'filsa_2018' ),
		'id' => 'filsa2018_cabecera_movil',
		'type' => 'file',
		'desc' => __( 'Imagen de 750x144 píxeles jpg o png', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Imagen por defecto para redes sociales', 'filsa_2018' ),
		'id' => 'filsa2018_placeholder',
		'type' => 'file',
		'desc' => __( 'Imagen de 750x144 píxeles jpg o png', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Mapa de la FILSA en alta resolución', 'filsa_2018' ),
		'id' => 'filsa2018_map',
		'type' => 'file',
		'desc' => __( 'Imagen en png del mapa de la Feria', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Posición de Menú para navegación general', 'filsa_2018' ),
		'id' => 'filsa2018_menu',
        'type' => 'select',
        'show_option_none' => true,
		'desc' => __( 'Posición del menú a utilizar', 'filsa_2018' ),
		'options_cb' => array($this, 'return_idmenuofpositions')
    ) );
    
    $cmb_options->add_field( array(
		'name' => __( 'Posición de Menú para Noticias Destacadas', 'filsa_2018' ),
		'id' => 'filsa2018_menunoticias',
        'type' => 'select',
        'show_option_none' => true,
		'desc' => __( 'Posición del menú a utilizar', 'filsa_2018' ),
		'options_cb' => array($this, 'return_idmenuofpositions')
    ) );
    
    $cmb_options->add_field( array(
		'name' => __( 'Posición de Menú para Eventos Destacadas', 'filsa_2018' ),
		'id' => 'filsa2018_menueventos',
        'type' => 'select',
        'show_option_none' => true,
		'desc' => __( 'Posición del menú a utilizar', 'filsa_2018' ),
		'options_cb' => array($this, 'return_idmenuofpositions')
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Término de taxonomía para FILSA 2018', 'filsa_2018' ),
		'id' => 'filsa2018_taxfilsa',
        'type' => 'taxonomy_select',
        'show_option_none' => true,
		'desc' => __( 'Escoja un término de la taxonomía "Ferias"', 'filsa_2018' ),
		'taxonomy' => 'ferias'
	) );

	$cmb_options->add_field( array(
			'name' => 'Fechas FILSA',
			'desc' => '',
			'type' => 'title',
			'id' => 'filsafechas_title'
		));

	$cmb_options->add_field( array(
		'name' => __( 'Fecha de Inicio FILSA 2018', 'filsa_2018' ),
		'id' => 'filsa2018_inicio',
		'type' => 'text_date',
		'desc' => __( 'Fecha de Inicio FILSA 2018', 'filsa_2018' ),
	) );
	$cmb_options->add_field( array(
		'name' => __( 'Fecha finalización FILSA 2018', 'filsa_2018' ),
		'id' => 'filsa2018_fin',
		'type' => 'text_date',
		'desc' => __( 'Fecha finalización FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
			'name' => 'Redes sociales',
			'desc' => '',
			'type' => 'title',
			'id' => 'filsa2018_titleredes'
		));

	$cmb_options->add_field( array(
		'name' => __( 'Twitter', 'filsa_2018' ),
		'id' => 'filsa2018_twitter',
		'type' => 'text_url',
		'desc' => __( 'URL de perfil de Twitter para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Facebook', 'filsa_2018' ),
		'id' => 'filsa2018_facebook',
		'type' => 'text_url',
		'desc' => __( 'URL de página de Facebook para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Instagram', 'filsa_2018' ),
		'id' => 'filsa2018_instagram',
		'type' => 'text_url',
		'desc' => __( 'URL de perfil de Instagram para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Flickr', 'filsa_2018' ),
		'id' => 'filsa2018_flickr',
		'type' => 'text_url',
		'desc' => __( 'URL de página de Flickr para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
			'name' => 'Textos páginas FILSA',
			'desc' => '',
			'type' => 'title',
			'id' => 'filsa2018_txtpag'
		));

	$cmb_options->add_field( array(
		'name' => __( 'Introducción', 'filsa_2018' ),
		'id' => 'filsa2018_intro',
		'type' => 'wysiwyg',
		'desc' => __( 'Texto de Introducción para página principal FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Título en Página Principal', 'filsa_2018' ),
		'id' => 'filsa2018_title',
		'type' => 'text',
		'desc' => __( 'Título en página principal FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Título en Páginas interiores', 'filsa_2018' ),
		'id' => 'filsa2018_titleinside',
		'type' => 'text',
		'desc' => __( 'Título en páginas interiores FILSA 2018 (después del título del contenido)', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
			'name' => 'Visitas guiadas',
			'desc' => '',
			'type' => 'title',
			'id' => 'vgdayssection_title'
		));

	$cmb_options->add_field( array(
		'name' => __( 'Enlace de inscripción para visitas guiadas', 'filsa_2018' ),
		'id' => 'filsa2018_formurl',
		'type' => 'text_url',
		'desc' => __( 'URL para el enlace común de inscripción para las visitas guiadas a colegios', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Término de eventos para Visitas Guiadas', 'filsa_2018' ),
		'id' => 'filsa2018_taxfilsavisitas',
        'type' => 'taxonomy_select',
        'show_option_none' => true,
		'desc' => __( 'Escoja un término de la taxonomía "Tipos de Evento"', 'filsa_2018' ),
		'taxonomy' => 'cchl_tipoevento',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Término de eventos para Firma de Autores', 'filsa_2018' ),
		'id' => 'filsa2018_taxfilsafirmas',
        'type' => 'taxonomy_select',
        'show_option_none' => true,
		'desc' => __( 'Escoja un término de la taxonomía "Tipos de Evento"', 'filsa_2018' ),
		'taxonomy' => 'cchl_tipoevento',
	) );

	
	$cmb2loader = new Filsa2018_Public();
	$iniciooption = $cmb2loader->get_cmb2_option('filsa2018_inicio');
	$finoption = $cmb2loader->get_cmb2_option('filsa2018_fin');
	
	if($iniciooption && $finoption) {

		$cmb_options->add_field( array(
			'name' => 'Seleccionar días para visitas guiadas',
			'desc' => '',
			'type' => 'title',
			'id' => 'vgdays_title'
		));

		$iniciofilsa = new DateTime( $iniciooption );
		$finfilsa = new DateTime( $finoption );
		$finfilsa = $finfilsa->modify('+1 day');
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

		foreach($period as $day) {

			$dia = date_i18n('l' , $day->format('U'));
			$ndia = date_i18n('j' , $day->format('U'));
			$mes = date_i18n('F' , $day->format('U'));

			$cmb_options->add_field( array(
				'name' => 'Activar '  . $dia . ' ' . $ndia . ' ' . $mes,
				'id' => 'filsa2018diavg_' . $ndia . '-' . $mes,
				'type' => 'checkbox',
				'desc' => ''
			) );
		}


	}

	$cmb_options->add_field( array(
			'name' => 'Programa cultural y visitas guiadas',
			'desc' => '',
			'type' => 'title',
			'id' => 'pgprog_title'
		));

	$cmb_options->add_field( array(
		'name' => __( 'Organizadores destacados', 'filsa_2018' ),
		'id' => 'filsa2018_orgs',
		'type' => 'text',
		'desc' => __( 'IDs de organizadores destacados (separados por coma)', 'filsa_2018' )
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Organizador Cámara', 'filsa_2018' ),
		'id' => 'filsa2018_orgcamara',
		'type' => 'text',
		'desc' => __( 'IDs de organizadores cámara', 'filsa_2018' )
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Ícono organizadores destacados', 'filsa_2018' ),
		'id' => 'filsa2018_orgicon',
		'type' => 'file',
		'desc' => __( 'Archivo de imagen para organizador destacado', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' 	=> 'Eventos',
		'id'	=> 'title_eventos',
		'type' 	=> 'title'
	) );
	
	if($iniciooption && $finoption) {

		$cmb_options->add_field( array(
			'name' => 'Seleccionar días para eventos',
			'desc' => '',
			'type' => 'title',
			'id' => 'evdays_title'
		));

		$iniciofilsa = new DateTime( $iniciooption );
		$finfilsa = new DateTime( $finoption );
		$finfilsa = $finfilsa->modify('+1 day');
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

		foreach($period as $day) {

			$dia = date_i18n('l' , $day->format('U'));
			$ndia = date_i18n('j' , $day->format('U'));
			$mes = date_i18n('F' , $day->format('U'));

			$cmb_options->add_field( array(
				'name' => 'Activar '  . $dia . ' ' . $ndia . ' ' . $mes,
				'id' => 'filsa2018diaev_' . $ndia . '-' . $mes,
				'type' => 'checkbox',
				'desc' => ''
			) );
		}


	}

	$cmb_options->add_field( array(
			'name' => 'Link a invitaciones externas',
			'desc' => 'URL con link a invitaciones externas (ej. en ticketplus)',
			'type' => 'text',
			'id' => 'filsa2018_ticketurl'
		));


}

}
