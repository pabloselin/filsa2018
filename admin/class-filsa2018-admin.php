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

	public function image_sizes() {
		add_image_size( 'invitado', 360 );
		add_image_size( 'invitado_mini', 36);
		add_image_size( 'galeria', 1024, 700);
	}

	public function menu_positions() {
		register_nav_menus( array(
			'main_menu_filsa2018' 		=> 'Navegación principal FILSA 2018',
			'main_menu_dos_filsa2018' 	=> 'Navegación principal FILSA 2018 (segunda línea)',
			'featured_news_filsa2018' 	=> 'Noticias destacadas FILSA 2018',
			'featured_events_filsa2018' => 'Eventos destacados FILSA 2018',
			'fastlinks_filsa2018'		=> 'Accesos rápidos FILSA 2018'
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

	public function selectpagefilsa( $field) {
		$args = array(
			'post_type' => 'filsa-2018',
			'numberposts' => -1,
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
				'normal' 			=> __('Normal', 'filsa2018'),
				'programa' 			=> __( 'Programa', 'filsa2018' ),
				'buscalibros' 		=> __( 'Buscador de libros', 'filsa2018' ),
				'invitados' 		=> __( 'Invitados', 'filsa2018' ),
				'visitas-guiadas' 	=> __( 'Visitas guiadas', 'filsa2018' ),
				'archivonoticias' 	=> __( 'Archivo de Noticias', 'filsa2018' ),
				'expositores'		=> __( 'Expositores', 'filsa2018' ),
				'colaboradores'		=> __( 'Colaboradores', 'filsa2018' ),
				'galeria'			=> __( 'Galería de Imágenes', 'filsa2018'),
				'redes'				=> __( 'Redes Sociales', 'filsa2018'),
				'jornadas'			=> __( 'Jornadas Profesionales', 'filsa2018'),
				'firmas'			=> __( 'Firma de autores', 'filsa2018'),
			),
		) );

		$invitados = new_cmb2_box(array(
			'id'			=> $prefix . 'invitados',
			'title'			=> 'Invitados',
			'object_types' 	=> array( 'filsa-2018' ),
			'show_on'		=> array( 
				'meta_key' =>  $prefix . '_componente',
				'meta_value' => 'invitados'
			),
			'context' 		=> 'normal',
			'priority' 		=> 'high'
		));

		$fields_invitados = $invitados->add_field( array(
			'id' 			=> $prefix . '_invitado',
			'type'			=> 'group',
			'description'	=> 'Información invitado/a',
			'repeatable'	=> true,
			'options'		=> array(
				'sortable'		=> true
			)
		));

		$invitados->add_group_field( $fields_invitados, array(
			'name' 	=> 'Nombre invitado/a',
			'id'	=> 'nombre',
			'type'	=> 'text'
		));

		$invitados->add_group_field( $fields_invitados, array(
			'name' 	=> 'Biografía o descripción invitado/a',
			'id'	=> 'bio',
			'type'	=> 'wysiwyg'
		));

		$invitados->add_group_field( $fields_invitados, array(
			'name' 	=> 'Foto invitado/a',
			'id'	=> 'foto',
			'type'	=> 'file'
		));

		$info_expo = new_cmb2_box( array(
			'id' => $prefix . 'expdatos',
			'title' => 'Datos adicionales expositor',
			'object_types' => array('tribe_organizer'),
			'show_on' => array(
				'key' => 'taxonomy',
				'value' => array(
					'ferias' => 'filsa-2018'
				)
			),
			'context' => 'normal',
			'priority' => 'high'
		));

		$info_expo->add_field( array(
			'name' => 'Distribuidor',
			'id' => $prefix . 'distribuidor',
			'type' => 'text',
			'desc' => 'Actividad principal'
		));

		$info_expo->add_field( array(
			'name' => 'Sellos representados',
			'id' => $prefix . 'sellos',
			'type' => 'text'
		));

		$expositor_info = new_cmb2_box( array(
			'id'           => $prefix . 'stands',
			'title'        => __( 'Stands', 'filsa2018' ),
			'object_types' => array( 'tribe_organizer', 'tribe_events' ),
			'show_on' => array(
				'key' => 'taxonomy',
				'value' => array(
					'ferias' => 'filsa-2018'
				)
			),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$grupo_ubicacion = $expositor_info->add_field( array(
			'name' => __( 'Ubicación', 'cchl' ),
			'id' => $prefix . 'ubicacion',
			'type' => 'group',
			'desc' => __( 'Ubicación del expositor / evento', 'cchl' ),
		) );

		$expositor_info->add_group_field( $grupo_ubicacion, array(
			'name' => 'Sector',
			'id'   => $prefix . 'sector',
			'type' => 'select',
			'desc' => 'Sector en que se ubica el expositor',
			'options' => array(
				'a' => 'A',
				'b' => 'B',
				'c' => 'C',
				'd' => 'D',
				'e' => 'E'
			)
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );

		$expositor_info->add_group_field( $grupo_ubicacion, array(
			'name' => 'Stands',
			'id' => $prefix . 'stands',
			'type' => 'text',
			'desc' => 'Stand en que se ubica el expositor (dentro del sector asignado más arriba)',
			'repeatable' => true
		) );
	}

	public function expositores_metaboxes() {
		$prefix = 'filsa2018';
		$expologos = new_cmb2_box(array(
				'id'			=> $key . 'colaboradores',
				'title'			=> $tipo,
				'object_types' 	=> array( 'filsa-2018' ),
				'show_on'		=> array( 
					'meta_key' =>  $prefix . '_componente',
					'meta_value' => 'expositores'
				),
				'context' 		=> 'normal',
				'priority' 		=> 'high'
			));
		$expologos->add_field( array(
			'name' => 'Expositores Logos',
			'id' => $prefix . '_logosexpositores',
			'description' => 'Sube aquí los logos de los expositores con el mismo nombre que el que tiene en el sistema de búsqueda. (en formato .png)',
			'type' => 'file'
		));
	}

	public function colaboradores_metaboxes() {
		$prefix = 'filsa2018';

		$tipo_funcion = array(
			'organiza' 	=> 'Organiza',
			'participa'	=> 'Participa',
			'apoya'		=> 'Apoya',
			'patrocina'	=> 'Patrocina',
			'auspicia'	=> 'Auspicia',
			'medios'	=> 'Medios Asociados',
			'colaboran' => 'Colaboran'
		);

		foreach($tipo_funcion as $key=>$tipo) {

			$curcolabox = 'colabox_' . $key;

			$curcolabox = new_cmb2_box(array(
				'id'			=> $key . 'colaboradores',
				'title'			=> $tipo,
				'object_types' 	=> array( 'filsa-2018' ),
				'show_on'		=> array( 
					'meta_key' =>  $prefix . '_componente',
					'meta_value' => 'colaboradores'
				),
				'context' 		=> 'normal',
				'priority' 		=> 'high'
			));

			$colagroup = $curcolabox->add_field( array(
				'id' 			=> $key . '_colaborador',
				'type'			=> 'group',
				'description'	=> $tipo,
				'repeatable'	=> true,
				'options'		=> array(
					'sortable'		=> true
				)
			));

			$curcolabox->add_group_field( $colagroup, array(
				'name' 	=> 'Nombre',
				'id'	=> 'nombre',
				'type'	=> 'text',
				'desc'	=> 'Nombre colaborador'
			));

			$curcolabox->add_group_field( $colagroup, array(
				'name' 	=> 'Logotipo',
				'id'	=> 'logo',
				'type'	=> 'file',
				'desc'	=> 'Logotipo colaborador (jpg o png)'
			));

			$curcolabox->add_group_field( $colagroup, array(
				'name'	=> 'Sitio web',
				'id'	=> 'web',
				'type'	=> 'text_url',
				'desc'	=> 'Web colaborador'
			));

		}


	}

	public function galeria_metaboxes() {
		$prefix = 'filsa2018';

		$galbox = new_cmb2_box(array(
			'id' => $prefix . 'galeria',
			'title' => 'Galería de imágenes',
			'object_types' => array('filsa-2018'),
			'show_on' => array(
				'meta_key' => $prefix . '_componente',
				'meta_value' => 'galeria'
			),
			'context' => 'normal',
			'priority' => 'high'
		));

		$galgroup = $galbox->add_field(array(
			'id' => 'galeria_grupo',
			'type' => 'group',
			'description' => 'Contenido de la galería',
			'repeatable' => true,
			'sortable' => true
		));

		$galbox->add_group_field( $galgroup, array(
			'name' => 'Nombre de la galería',
			'id'	=> 'galname',
			'type'	=> 'text',
			'desc'	=> 'Título de la galería'
		));

		$galbox->add_group_field( $galgroup, array(
			'name' => 'Imágenes',
			'id'	=> 'imagenes',
			'type'	=> 'file_list',
			'desc'	=> 'Imagenes de la galería',
			'text' => array(
				'add_upload_files_text' => 'Añadir imágenes', // default: "Add or Upload Files"
				'remove_image_text' => 'Eliminar imagen', // default: "Remove Image"
				'file_text' => 'Archivo', // default: "File:"
				'file_download_text' => 'Descargar archivo', // default: "Download"
				'remove_text' => 'Quitar', // default: "Remove"
			),
		));
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
		'name' => __( 'Cabecera video .mp4', 'filsa_2018' ),
		'id' => 'filsa2018_cabecera_mp4',
		'type' => 'file',
		'desc' => __( 'Video mp4 para web', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Cabecera video webm', 'filsa_2018' ),
		'id' => 'filsa2018_cabecera_webm',
		'type' => 'file',
		'desc' => __( 'Video webm para web', 'filsa_2018' ),
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
		'name' => __( 'Posición de Menú para navegación general (segunda línea)', 'filsa_2018' ),
		'id' => 'filsa2018_menu_dos',
		'type' => 'select',
		'show_option_none' => true,
		'desc' => __( 'Posición del menú a utilizar', 'filsa_2018' ),
		'options_cb' => array($this, 'return_idmenuofpositions')
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Posición de Menú para enlaces rápidos', 'filsa_2018' ),
		'id' => 'filsa2018_fastlinks',
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
		'type' => 'text',
		'desc' => __( 'Nombre de perfil de Twitter para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Facebook', 'filsa_2018' ),
		'id' => 'filsa2018_facebook',
		'type' => 'text',
		'desc' => __( 'Nombre de página de Facebook para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Youtube', 'filsa_2018' ),
		'id' => 'filsa2018_youtube',
		'type' => 'text',
		'desc' => __( 'URL de canal de Youtube para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Facebook APPID', 'filsa_2018' ),
		'id' => 'filsa2018_facebookid',
		'type' => 'text',
		'desc' => __( 'APP ID de Facebook', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Instagram', 'filsa_2018' ),
		'id' => 'filsa2018_instagram',
		'type' => 'text',
		'desc' => __( 'Nombre de perfil de Instagram para FILSA 2018', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Post de Instagram', 'filsa_2018' ),
		'id' => 'filsa2018_instagrampost',
		'type' => 'text_url',
		'desc' => __( 'URL del último post de Instagram para FILSA 2018', 'filsa_2018' ),
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
		'name' => __( 'Aviso', 'filsa_2018' ),
		'id' => 'filsa2018_aviso',
		'type' => 'wysiwyg',
		'desc' => __( 'Texto de aviso para página de inicio', 'filsa_2018' ),
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Mostrar aviso', 'filsa_2018' ),
		'id' => 'filsa2018_showaviso',
		'type' => 'checkbox',
		'desc' => __( 'Activar aviso en página de inicio', 'filsa_2018' ),
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

	$cmb_options->add_field( array(
		'name' => __( 'Página donde se subirán los logos de los colaboradores', 'filsa_2018' ),
		'id' => 'filsa2018_colabpage',
		'type' => 'select',
		'show_option_none' => true,
		'options_cb' => array( $this, 'selectpagefilsa'),
		'desc' => __( 'Escoja una página de FILSA 2019', 'filsa_2018' ),
		
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

	if($iniciooption && $finoption) {

		$cmb_options->add_field( array(
			'name' => 'Seleccionar días para Firma de autores',
			'desc' => '',
			'type' => 'title',
			'id' => 'fadays_title'
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
				'id' => 'filsa2018diafirma_' . $ndia . '-' . $mes,
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

public function cmb_show_on_meta_value( $display, $meta_box ) {
	if ( ! isset( $meta_box['show_on']['meta_key'] ) ) {
		return $display;
	}

	$post_id = 0;

		// If we're showing it based on ID, get the current ID
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}

	if ( ! $post_id ) {
		return $display;
	}

	$value = get_post_meta( $post_id, $meta_box['show_on']['meta_key'], true );

	if ( empty( $meta_box['show_on']['meta_value'] ) ) {
		return (bool) $value;
	}

	return $value == $meta_box['show_on']['meta_value'];
}

}
