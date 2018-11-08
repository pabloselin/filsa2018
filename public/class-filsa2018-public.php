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
			if(WP_ENV == 'development') {
				$filsa = 'filsa2017';
			} else {
				$filsa = 'filsa2018';
			}
		// Use cmb2_get_option as it passes through some key filters.
			return cmb2_get_option( $filsa . '_options', $key, $default );
		}

	// Fallback to get_option if CMB2 is not loaded yet.
		$opts = get_option( $filsa . '_options', $default );

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

	public function rest_filsa2018params() {
		register_rest_route( 'filsa2018/v1/', '/params/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018params')
		));
	}

	public function rest_filsa2018events() {
		register_rest_route( 'filsa2018/v1/', '/events/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018_events_transients')
		));
	}

	public function rest_filsa2018visitas() {
		register_rest_route( 'filsa2018/v1/', '/visitas-guiadas/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018_visitas_transients')
		));
	}

	public function rest_filsa2018firmas() {
		register_rest_route( 'filsa2018/v1/', '/firma-de-autores/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018_firmas_transients')
		));
	}

	public function rest_filsa2018jornadas() {
		register_rest_route( 'filsa2018/v1/', '/jornadas/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018_jornadas')
		));
	}


	public function rest_filsa2018eventslug() {
		register_rest_route( 'filsa2018/v1/', '/events/(?P<slug>[a-zA-Z0-9-]+)', array(
			'methods' 	=> 'GET',
			'callback' 	=> array( $this, 'filsa2018_prepare_event_rest'),
			'args' => array(
				'slug' => array(
					'validate_callback' => function( $param, $request, $key) {
						return sanitize_text_field( $param );
					}
				)
			)
		));
	}

	public function rest_filsa2018expositores() {
		register_rest_route( 'filsa2018/v1/', '/expositores/', array(
			'methods' => 'GET',
			'callback' => array( $this, 'filsa2018_expositores')
		) );
	}

	public function filsa2018params( ) {
		$cached_params = get_transient('filsa2018params');

		if( false !== $cached_params) {
			return $cached_params;
		}

		$params = [
			'filsa2018_cabecera_escritorio',
			'filsa2018_cabecera_movil',
			'filsa2018_cabecera_webm',
			'filsa2018_cabecera_mp4',
			'filsa2018_placeholder',
			'filsa2018_map',
			'filsa2018_menu',
			'filsa2018_menu_dos',
			'filsa2018_menunoticias',
			'filsa2018_menueventos',
			'filsa2018_fastlinks',
			'filsa2018_taxfilsa',
			'filsa2018_inicio',
			'filsa2018_fin',
			'filsa2018_twitter',
			'filsa2018_instagram',
			'filsa2018_facebook',
			'filsa2018_youtube',
			'filsa2018_ytmain',
			'filsa2018_ytextra',
			'filsa2018_flickr',
			'filsa2018_flickralbum',
			'filsa2018_intro',
			'filsa2018_title',
			'filsa2018_titleinside',
			'filsa2018_taxfilsavisitas',
			'filsa2018_taxfilsafirmas',
			'filsa2018_facebookid',
			'filsa2018_instagrampost',
			'filsa2018_aviso',
			'filsa2018_showaviso',
			'filsa2018_colabpage',
			'filsa2018_orgs',
			'filsa2018_orgcamara',
			'filsa2018_aviso',
			'filsa2018_showaviso'
		];

		$params_content = array();

		foreach($params as $key=>$param) {
			$fieldcontent = $this->get_cmb2_option($param);
			if($fieldcontent) {
				if($param == 'filsa2018_menunoticias' || $param == 'filsa2018_menueventos') {
					$params_content[$param] =wp_get_nav_menu_items( $fieldcontent );
				} elseif($param == 'filsa2018_menu' || $param == 'filsa2018_menu_dos' || $param == 'filsa2018_fastlinks') {
					$params_content[$param] = $this->buildTree(wp_get_nav_menu_items( $fieldcontent ), 0);
				} elseif($param == 'filsa2018_intro' || $param == 'filsa2018_aviso') {
					$params_content[$param]= apply_filters( 'the_content', $fieldcontent );
				} else {
					$params_content[$param] = $fieldcontent;
				}			
			}
		}

		//Almacenar contenidos FILSA-2018
		$params_content['filsa2018_contents'] = $this->get_filsa2018_contents();
		$params_content['filsa2018_noticias'] = $this->get_filsa2018_news();
		$today = new DateTime( 'today' );
		$yesterday = new DateTime( 'yesterday' );
		$tomorrow = new DateTime('tomorrow');
		$ptomorrow = new DateTime('tomorrow + 1day');

		$todaystr = $today->format('Y-m-j');
		$yesterdaystr = $yesterday->format('Y-m-j');
		$tomorrowstr = $tomorrow->format('Y-m-j');
		$ptomorrowstr = $ptomorrow->format('Y-m-j');
		$params_content['filsa2018_eventosrapidos'] = array(
			$todaystr => $this->get_dayevents($todaystr), $yesterdaystr => $this->get_dayevents($yesterdaystr), $tomorrowstr => $this->get_dayevents($tomorrowstr), $ptomorrowstr => $this->get_dayevents($ptomorrowstr)
		);


		$params_transient = set_transient('filsa2018params', $params_content, 3600);

		if( false == $params_transient) {
			return false;
		}


		return get_transient('filsa2018params');
	}

	public function get_dayevents($day) {
		$args = array(
		'posts_per_page' => -1,
		'post_type' => 'tribe_events',
		'orderby' => 'meta_value',
		'meta_key' => '_EventStartDate',
		'meta_type' => 'DATETIME',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_EventStartDate',
				'type' => 'DATE',
				'value' => $day
				)
			),

		'tax_query' => array(
			array(
				'taxonomy' => 'ferias',
				'field' => 'slug',
				'terms' => 'filsa-2018'
				),
			array(
				'taxonomy' => 'cchl_tipoevento',
				'terms' => 'visitas-guiadas',
				'field' => 'slug',
				'operator' => 'NOT IN'
				)
			)
		);

		$events = get_posts($args);
		$prepared_events = array();
		foreach($events as $event) {
			$prepared_events[] = $this->prepare_eventinfo($event);
		}

		return $prepared_events;
	}

	public function output_parameters() {
		$params = $this->filsa2018params();
		?>
		<script>
			window.params = <?php echo json_encode($params);?>
		</script>
		<?php
	}

	public function filsa2018_events_transients( WP_REST_Request $request ) {
		$cached_events = get_transient('filsa2018eventos');

		if( false !== $cached_events) {
			return $cached_events;
		}

		$events_content = [];

		//Almacenar lista de dias activos

		$filsa = 'filsa2018';
		

		$inicio = $this->get_cmb2_option($filsa .'_inicio');
		$fin = $this->get_cmb2_option($filsa .'_fin');


		if(isset($inicio) && isset($fin)) {
			$iniciofilsa = new DateTime( $inicio );
			$finfilsa = new DateTime( $fin );
			$finfilsa = $finfilsa->modify('+1 day');
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

			foreach($period as $day) {
				$ndia = date_i18n('j' , $day->format('U'));
				$mes = date_i18n('F' , $day->format('U'));
				$eventos = ($this->get_cmb2_option($filsa .'diaev_' . $ndia . '-' . $mes) == true) ? 'active' : 'disabled'; 
				$visitas = ($this->get_cmb2_option($filsa .'diavg_' . $ndia . '-' . $mes) == true) ? 'active' : 'disabled';
				
				$events_content['diaseventos'][$mes][] = [$this->formatDay($day), $eventos];
				$events_content['diasvisitasguiadas'][$mes][] = [$this->formatDay($day), $visitas];
				
			}

		}

		//Almacenar lista de cursos
		$events_content['cursos'] = get_terms( array('taxonomy' => 'cursos') );
		//Almacenar tipos de eventos
		$events_content['tipoevento'] = $this->filsa2018_transientterms($filsa . '_taxfilsa', 'ferias');

		//Almacentar url formulario
		$events_content['formurl'] = $this->get_cmb2_option($filsa . '_formurl');
		//Almacenar eventos
		$events_content['eventos'] = $this->get_events(false);

		$events_transient = set_transient('filsa2018eventos', $events_content, 3600);

		return $events_content;
	}

	public function filsa2018_visitas_transients( WP_REST_Request $request ) {
		$cached_events = get_transient('filsa2018visitasguiadas');

		if( false !== $cached_events) {
			return $cached_events;
		}

		$events_content = [];

		//Almacenar lista de dias activos

		if(WP_ENV == 'development') {
			$filsa = 'filsa2017';
		} else {
			$filsa = 'filsa2018';
		}

		$inicio = $this->get_cmb2_option($filsa .'_inicio');
		$fin = $this->get_cmb2_option($filsa .'_fin');


		if(isset($inicio) && isset($fin)) {
			$iniciofilsa = new DateTime( $inicio );
			$finfilsa = new DateTime( $fin );
			$finfilsa = $finfilsa->modify('+1 day');
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

			foreach($period as $day) {
				$ndia = date_i18n('j' , $day->format('U'));
				$mes = date_i18n('F' , $day->format('U'));
				$visitas = ($this->get_cmb2_option($filsa .'diavg_' . $ndia . '-' . $mes) == true) ? 'active' : 'disabled';
				
				$events_content['diasvisitasguiadas'][$mes][] = [$this->formatDay($day), $visitas];
				
			}

		}

		//Almacenar lista de cursos
		$events_content['cursos'] = get_terms( array('taxonomy' => 'cursos') );
		//Almacenar tipos de eventos
		$events_content['tipoevento'] = $this->filsa2018_transientterms($filsa . '_taxfilsavisitas', 'cchl_tipoevento');

		//Almacentar url formulario
		$events_content['formurl'] = $this->get_cmb2_option($filsa . '_formurl');
		//Almacenar eventos
		$events_content['eventos'] = $this->get_events(true);

		$events_transient = set_transient('filsa2018visitasguiadas', $events_content, 3600);

		return $events_content;
	}

	public function filsa2018_firmas_transients( WP_REST_Request $request ) {
		$cached_events = get_transient('filsa2018firmas');

		if( false !== $cached_events) {
			return $cached_events;
		}

		$events_content = [];

		//Almacenar lista de dias activos

		
		$filsa = 'filsa2018';

		$inicio = $this->get_cmb2_option($filsa .'_inicio');
		$fin = $this->get_cmb2_option($filsa .'_fin');


		if(isset($inicio) && isset($fin)) {
			$iniciofilsa = new DateTime( $inicio );
			$finfilsa = new DateTime( $fin );
			$finfilsa = $finfilsa->modify('+1 day');
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

			foreach($period as $day) {
				$ndia = date_i18n('j' , $day->format('U'));
				$mes = date_i18n('F' , $day->format('U'));
				$visitas = ($this->get_cmb2_option($filsa .'diafirma_' . $ndia . '-' . $mes) == true) ? 'active' : 'disabled';
				
				$events_content['diasfirmas'][$mes][] = [$this->formatDay($day), $visitas];
				
			}

		}

		//Almacenar eventos
		$events_content['eventos'] = $this->get_events(false, 'firma-de-autores');

		$events_transient = set_transient('filsa2018firmas', $events_content, 3600);

		return $events_content;
	}

	public function filsa2018_jornadas( WP_REST_Request $request ) {
		return array(
			'edicion' => $this->filsa2018_event_term_transient('jornada-de-edicion'),
			'fomento' => $this->filsa2018_event_term_transient('jornada-de-fomento-lector-y-educacion'),
			'ilustracion' => $this->filsa2018_event_term_transient('jornada-de-ilustracion')
		);
	}

	public function filsa2018_event_term_transient($term) {
		$cached_events = get_transient('filsa2018' . $term);

		if( false !== $cached_events) {
			return $cached_events;
		}

		$events_content = [];

		//Almacenar lista de dias activos

		$filsa = 'filsa2018';
		

		$inicio = $this->get_cmb2_option($filsa .'_inicio');
		$fin = $this->get_cmb2_option($filsa .'_fin');


		if(isset($inicio) && isset($fin)) {
			$iniciofilsa = new DateTime( $inicio );
			$finfilsa = new DateTime( $fin );
			$finfilsa = $finfilsa->modify('+1 day');
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($iniciofilsa, $interval, $finfilsa);

			foreach($period as $day) {
				$ndia = date_i18n('j' , $day->format('U'));
				$mes = date_i18n('F' , $day->format('U'));
				$visitas = 'active';
				
				$events_content['diasjornadas'][$mes][] = [$this->formatDay($day), $visitas];
				
			}

		}

		//Almacenar eventos
		$events_content['eventos'] = $this->get_events(false, $term);

		$events_transient = set_transient('filsa2018' . $term, $events_content, 3600);

		return $events_content;
	}

	public function formatDay( $day ) {
		$dia = strtotime($day->format('Y-m-d'));
		setlocale(LC_ALL, 'es_ES');
		$formatted = array(
			'dia' => strftime('%e', $dia),
			'mes' => strftime('%B', $dia),
			'diasemana' => strftime('%A', $dia),
			'full' => $day->format('Y-m-d')
		);

		return $formatted;
	}

	public function buildTree( array &$elements, $parentId = 0 ) {
		$branch = array();

		foreach ( $elements as &$element ) {
			if ( $element->menu_item_parent == $parentId )
			{
				$children = $this->buildTree( $elements, $element->ID );
				if ( $children )
					$element->wpse_children = $children;

				$branch[$element->menu_order] = $element;
				unset( $element );
			}
		}
		return $branch;
	}

	public function get_events( $visitas = false, $customevents = false ) {
		
		$term = 'filsa-2018';

		$args = array(
			'post_type' => 'tribe_events',
			'numberposts' => -1,
			'post_status' => 'publish',
			'orderby' => 'meta_value',
			'meta_key' => '_EventStartDate',
			'meta_type' => 'DATETIME',
			'order' => 'ASC'
		);

		if($visitas == true ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'ferias',
					'terms' => $term,
					'field' => 'slug'
				),
				array(
					'taxonomy' => 'cchl_tipoevento',
					'terms' => 'visitas-guiadas',
					'field' => 'slug'
				),
			);
		} elseif($customevents != false) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'ferias',
					'terms' => $term,
					'field' => 'slug'
				),
				array(
					'taxonomy' => 'cchl_tipoevento',
					'terms' => $customevents,
					'field' => 'slug'
					)
			);
		} else {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'ferias',
					'terms' => $term,
					'field' => 'slug'
				),
				array(
					'taxonomy' => 'cchl_tipoevento',
					'terms' => array('visitas-guiadas', 'firma-de-autores'),
					'field' => 'slug',
					'operator' => 'NOT IN'
					)
			);
		}

		$events = get_posts($args);
		$events_prepared = [];
		
		foreach($events as $event) {
			$events_prepared[] = $this->prepare_eventinfo($event);
		}

		return $events_prepared;
	}

	public function get_filsa2018_contents() {
		$args = array(
			'post_type' => 'filsa-2018',
			'numberposts' => -1,
			'post_status' => 'publish'
		);

		$posts = get_posts($args);
		$posts_prepared = [];
		foreach($posts as $post) {
			$posts_prepared[] = $this->preparefilsa2018_content($post);
		}

		return $posts_prepared;
	}

	public function get_filsa2018_news() {
		$args = array(
			'post_type' => 'post',
			'numberposts' => -1,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'ferias',
					'field' => 'slug',
					'terms' => 'filsa-2018'
				)
			)
		);

		$posts = get_posts($args);
		$posts_prepared = [];
		foreach($posts as $post) {
			$posts_prepared[] = $this->preparefilsa2018_content($post);
		}

		return $posts_prepared;
	}


	public function preparefilsa2018_content( $post ) {
		$excerpt = (strlen($post->post_excerpt) > 1)? $post->post_excerpt : $this->preparexcerpt($post->post_content, 200);
		$post_prepared = array(
			'id' => $post->ID,
			'date' => $post->post_date,
			'content' => apply_filters( 'the_content', $post->post_content ),
			'title' => $post->post_title,
			'excerpt' => $excerpt,
			'slug' => $post->post_name,
			'parent' => $post->post_parent,
			'media' => $this->getallimageurls( $post->ID ),
			'seotitle' => $post->post_title . ' - FILSA 2018'
		);
		if( $post->post_type == 'filsa-2018' ) {
			$post_prepared['component'] = get_post_meta($post->ID, 'filsa2018_componente', true);
		}

		//Custom fields para algunos componentes
		if(get_post_meta($post->ID, 'filsa2018_componente', true) == 'invitados') {
			$invitados = get_post_meta($post->ID, 'filsa2018_invitado', true);
			$invsdata = array();
			foreach($invitados as $invitado) {
				$imginv_mini = wp_get_attachment_image_src( $invitado['foto_id'], 'invitado_mini' );
				$imginv_std = wp_get_attachment_image_src( $invitado['foto_id'], 'invitado' );
				$imginv_medium = wp_get_attachment_image_src( $invitado['foto_id'], 'medium' );
				$imginv_large = wp_get_attachment_image_src( $invitado['foto_id'], 'large' );
				$invdata = array();
				$invdata['bio'] = $invitado['bio'];
				$invdata['nombre'] = $invitado['nombre'];
				$invdata['foto_mini'] = $imginv_mini;
				$invdata['foto'] = $imginv_std;
				$invdata['foto_medium'] = $imginv;
				$invdata['foto_grande'] = $imginv_large;
				$invsdata[] = $invdata;
			}

			$post_prepared['extrafields'] = $invsdata;
		}

		if(get_post_meta($post->ID, 'filsa2018_componente', true) == 'colaboradores') {
			$tipo_funcion = array(
			'organiza' 	=> 'Organiza',
			'participa'	=> 'Participa',
			'apoya'		=> 'Apoya',
			'patrocina'	=> 'Patrocina',
			'auspicia'	=> 'Auspicia',
			'medios'	=> 'Medios Asociados',
			'colaboran' => 'Colaboran'
			);
			$colabsdata = array();
			foreach($tipo_funcion as $key=>$tipo) {
				$colabfields = get_post_meta($post->ID, $key . '_colaborador', true);
				foreach($colabfields as $colabfield) {
					$imgcolab = wp_get_attachment_image_src( $colabfield['logo_id'], 'medium');
					$colabdata['logo'] = $imgcolab;
					$colabdata['nombre'] = $colabfield['nombre'];
					$colabdata['url'] = $colabfield['web'];
					$colabsdata[$key][] = $colabdata;
				}
			}

			$post_prepared['extrafields'] = $colabsdata;
		}

		if(get_post_meta($post->ID, 'filsa2018_componente', true) == 'galeria') {
			$galerias = get_post_meta($post->ID, 'galeria_grupo', true);
			$galdata = array();
			foreach($galerias as $key=>$galeria) {
				$galdata[$key]['nombre'] = $galeria['galname'];
				foreach((array) $galeria['imagenes'] as $imagen_id => $imagen_url) {
					$galsrc_lg = wp_get_attachment_image_src( $imagen_id, 'galeria' );
					$galsrc_th = wp_get_attachment_image_src( $imagen_id, 'thumbnail' );
					$galsrc_md = wp_get_attachment_image_src( $imagen_id, 'medium' );
					$galdata[$key]['imagenes'][$imagen_id]['large'] = $galsrc_lg;
					$galdata[$key]['imagenes'][$imagen_id]['thumbnail'] = $galsrc_th;
					$galdata[$key]['imagenes'][$imagen_id]['medium'] = $galsrc_md;
					$galdata[$key]['imagenes'][$imagen_id]['title'] = get_the_title($imagen_id);
				}
			}
			$post_prepared['extrafields'] = $galdata;
		}

		if(get_post_meta($post->ID, 'filsa2018_componente', true) == 'expositores') {
			$args = array(
				'post_type' => 'attachment',
				'post_parent' => $post->ID,
				'numberposts' => -1
			);
			$logosimgs = array();
			$logos = get_children( $args );
			foreach($logos as $logo) {
				$logosimgs[] = wp_get_attachment_image_src( $logo->ID, 'full' );
			}
			$post_prepared['extrafields'] = $logosimgs;	
		}

		return $post_prepared;
	}

	public function preparexcerpt( $postcontent, $length) {
		return $this->tokenTruncate(strip_tags($postcontent), $length);
	}

	public function tokenTruncate($string, $your_desired_width) {
	  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
	  $parts_count = count($parts);

	  $length = 0;
	  $last_part = 0;
	  for (; $last_part < $parts_count; ++$last_part) {
	    $length += strlen($parts[$last_part]);
	    if ($length > $your_desired_width) { break; }
	  }

	  return implode(array_slice($parts, 0, $last_part));
	}

	public function getallimageurls( $postid ) {
		$sizes = get_intermediate_image_sizes();
		$images = array();
		foreach($sizes as $size) {
			$thid = get_post_thumbnail_id( $postid );
			$imgurl = wp_get_attachment_image_src( $thid, $size );
			$images[$size] = $imgurl[0];
		}

		return $images;
	}

	public function prepare_eventinfo($event) {

		$orgcamara = explode(',', $this->get_cmb2_option('filsa2018_orgcamara'));
		$orgdestacado = explode(',', $this->get_cmb2_option('filsa2018_orgs'));
		$orgsinvs = explode(',', $this->get_cmb2_option('filsa2018_orgsinvs'));

		$organizers = tribe_get_organizer_ids($event->ID);

		$organizacamara = false;
		$organizaperu = false;
		$cineenfilsa = false;
		$makeinv = false;
		
		foreach($organizers as $organizer) {
			if(in_array($organizer, $orgcamara)) {
				$organizacamara = true;
			}
			if(in_array($organizer, $orgdestacado)) {
				$organizaperu = true;
			}
			if(in_array($organizer, $orgsinvs)) {
				$makeinv = true;
			}
		}

		if(is_object_in_term( $event->ID, 'cchl_tipoevento', 'cine' ))
		{
			$cineenfilsa = true;
		}

		$event_prepared = array(
			'id'				=> $event->ID,
			'slug'				=> $event->post_name,
			'daykey'			=> tribe_get_start_date( $event->ID, false, 'Y-m-d'),
			'startday' 			=> tribe_get_start_date( $event->ID, false, 'l j F'),
			'startdate' 		=> tribe_event_is_all_day( $event->ID) ? 'Todo el día' : tribe_get_start_date($event->ID, false, 'G:i'),
			'enddate' 			=> tribe_get_end_date($event->ID, false, 'G:i'),
			'tipo_eventos' 		=> $this->termnames(get_the_terms($event->ID, 'cchl_tipoevento')),
			'tema_eventos'		=> $this->termnames(get_the_terms($event->ID, 'cchl_temaevento')),
			'cursos'			=> $this->termnames(get_the_terms($event->ID, 'cursos')),
			'organizadores' 	=> cchl_organizer_names( $event->ID ),
			'evento_caduco'		=> tribe_is_past_event( $event->ID ) ? 'past' : 'available',
			'content'			=> apply_filters( 'the_content', $event->post_content),
			'description'		=> strip_tags($event->post_content),
			'lugar'				=> tribe_get_venue( $event->ID),
			'title'				=> $event->post_title,
			'cupos'				=> get_post_meta($event->ID, '_cmb_cupos', true),
			'cerrado'			=> get_post_meta($event->ID, '_cmb_cerrado', true),
			'organizacamara'	=> $organizacamara,
			'organizaperu'		=> $organizaperu
		);

		if($organizacamara || $organizaperu || $cineenfilsa || $makeinv) {
			if(function_exists('cchl_frontinv')) {
				$inicio = tribe_get_start_date($event->ID, false, 'G:i');
				$fin = tribe_get_end_date($event->ID, false, 'G:i');
				$hora = ($inicio !== $fin) ? $inicio . ' - ' . $fin : $inicio;

				$data = array(
					'id'			=> $event->ID,
					'title' 		=> get_the_title( $event->ID ),
					'dia' 			=> tribe_get_start_date( $event->ID, false ),
					'hora' 			=> $hora,
					'lugar'			=> tribe_get_venue( $event->ID ),
					'organizador'	=> cchl_organizer_names( $event->ID),
					'descripcion'   => limitar_palabras( strip_tags($event->post_content), 50)
					);

				$invurl = cchl_frontinv($data);
				$event_prepared['invitacion'] = $invurl;
			}
		}

		return $event_prepared;
	}

	public function filsa2018_prepare_event_rest( WP_REST_Request $request ) {
		$postname = $request->get_param('slug');
		$args = array(
			'name' => $postname,
			'post_type' => 'tribe_events',
			'numberposts' => 1
		);
		$event = get_posts($args);

		if($event) {
			return $this->prepare_eventinfo( $event[0] );
		} else {
			return false;
		}
		
	}

	public function termnames( $terms ) {
		$names = [];
		if($terms) {
			foreach($terms as $term) {
				$names[] = $term->name;
			}
		};
		return $names;
	}


	public function filsa2018_transientterms($option, $taxonomy = 'cchl_tipoevento') {
			$vg = $this->get_cmb2_option($option);
			$vgtermids = array();
			$unique_ids = array();
			$visitasargs = array(
				'post_type' => 'tribe_events',
				'numberposts' => -1,
				'post_status' => 'any',
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'terms' => $vg,
						'field' => 'slug'
					)
				)
			);
			$vgitems = get_posts($visitasargs);
			foreach($vgitems as $vgitem) {
				$typeterms = get_the_terms( $vgitem->ID,  'cchl_tipoevento' );	

				foreach($typeterms as $typeterm) {
					if($typeterm->slug != $vg && $typeterm->slug != 'visitas-guiadas' && $typeterm->slug != 'firma-de-autores')
						$vgtermids[$typeterm->term_id] = $typeterm->name;
				}
			}
			$unique_ids = array_unique($vgtermids);
			return $unique_ids;
	}

	public function filsa2018_expositores( WP_REST_Request $request ) {
		if( false === ($expterms = get_transient('filsa2018_expositores')) ) {
			$args = array(
				'post_type' => 'tribe_organizer',
				'numberposts' => -1,
				'orderby' => 'post_title',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'ferias',
						'field' => 'slug',
						'terms' => $this->get_cmb2_option('filsa2018_taxfilsa')
					)
				)
			);
			$expositores = get_posts($args);
			$expositores_info = array();
			foreach($expositores as $expitem) {
				//var_dump(get_post_meta($expitem->ID));
				$expitem_info['title'] = $expitem->post_title;
				$expitem_info['location'] = $this->filsa2018_sortstandlocationjson($expitem->ID);
				$expitem_info['web'] = get_post_meta($expitem->ID, '_OrganizerWebsite', true);
				$expitem_info['distribuidor'] = get_post_meta($expitem->ID, 'filsa2018distribuidor', true);
				$expitem_info['sellos'] = get_post_meta($expitem->ID, 'filsa2018_sellos', true);
				$expitem_info['materias'] = get_the_terms($expitem->ID, 'materia');

				$expositores_info[] = $expitem_info;
			}

			set_transient( 'filsa2018_expositores', $expositores_info, 12 * HOUR_IN_SECONDS );
			return $expositores_info;
		} else {
			$expositores_info = get_transient( 'filsa2018_expositores' );
			return $expositores_info;
		}
	}

	public function filsa2018_sortstandlocationjson( $postid ) {
	    $ubicaciones = get_post_meta($postid, 'filsa2018ubicacion', true);
	    if($ubicaciones):
	        return $ubicaciones;
	    endif;
	}

	/* Fin de ajuste*/


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

	public function ogimage_filsa() {
		if(is_post_type_archive( 'filsa-2018' )) {
			$image = $this->get_cmb2_option('filsa2018_placeholder');?>
			<meta property="og:image" content="<?php echo $image;?>"/>
			<?php
		}
	}

	public function pagetitle() {
		$title = $this->get_cmb2_option('filsa2018_title');
		?>
		<title><?php echo $title;?></title>
		<?php
	}

	public function yoast_tags() {
		if(!is_404()) {
			do_action('wpseo_head');
		} else {
			$contents = $this->replace_og_tags_in_404();
			if($contents) {
				$thumbnail_id = get_post_thumbnail_id( $contents->ID );
				$image = wp_get_attachment_image_src( $thumbnail_id, 'imagen_single');
				if(get_post_type( $contents->ID) == 'post') {
					$ogurl = get_bloginfo('url') . '/ferias/filsa/filsa-2018/noticias/' . $contents->post_name . '/';
				} elseif(get_post_type( $contents->ID) == 'tribe_events') {
					$ogurl = get_bloginfo('url') . '/ferias/filsa/filsa-2018/eventos/' . $contents->post_name . '/';
				} else {
					$ogurl = get_permalink($contents->ID);
				}
				?>
				<meta property="og:title" content="<?php echo $contents->post_title;?> - FILSA 2018" />
				<meta property="og:description" content="<?php echo $contents->post_excerpt;?>" />
				<meta property="og:image" content="<?php echo $image[0];?>" />
				<meta property="og:url"	content="<?php echo $ogurl;?>" />
				<meta property="og:type" content="article" />
				<meta property="fb:app_id" content="<?php echo FB_APPID;?>" />
			<?php }
		}
	}

	public function env_var() {
		?>
		<script>window.env = "<?php echo WP_JSENV;?>";</script>
		<?php
	}

	public function loggedin_var() {
		?>
		<script>window.loggedin = <?php echo (is_user_logged_in()) ? 'true' : 'false' ;?>;</script>
		<?php
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
			$cleanurl = get_bloginfo( 'url' ) .'/ferias/filsa/filsa-2018/noticias/' . $slug . '/';
			wp_redirect( $cleanurl );
			exit;
		} elseif(is_object_in_term( $post->ID, 'ferias', 'filsa-2018' ) && is_singular('tribe_events')) {
			$url = add_query_arg('slug', $slug, get_bloginfo( 'url' ) .'/ferias/filsa/filsa-2018/eventos');
			$cleanurl = get_bloginfo( 'url' ) .'/ferias/filsa/filsa-2018/eventos/' . $slug . '/';
			wp_redirect( $cleanurl );
		}
	}

	public function redirect_404_if_filsa( $single_template ) {
		global $wp_query;
		if($wp_query->query['name'] != 'service-workerjs') {
			if($this->detect_404_in_filsa()) {
			header("HTTP/1.0 200 OK");
			$single_template = plugin_dir_path( __FILE__ ) . 'partials/filsa2018-public-display.php';
			} else {
				return $single_template;
			}
		} else {
			header("HTTP/1.0 200 OK");
			header('Content-Type: application/javascript');
			$single_template = plugin_dir_path( __FILE__) .  'partials/service-worker.js';
		}
		
		return $single_template;
	}


	public function detect_404_in_filsa() {
		if(is_404()) {
			$url = $_SERVER['REQUEST_URI'];
			if(strpos($url, '/ferias/filsa/filsa-2018/') !== false) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function replace_og_tags_in_404() {
		if($this->detect_404_in_filsa()) {
			$url = $_SERVER['REQUEST_URI']; 
			$slug = explode('/', $url);
			$refinedslug = $slug[count($slug) -2];
			$args = array(
				'name' => $refinedslug,
				'post_type' => 'any',
				'post_status' => 'publish',
				'numberposts' => 1
			);
			$post = get_posts($args);
			if($post) {
				return $post[0];
			}
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
		wp_localize_script( $this->plugin_name, 'filsa2018', array( 'scriptsurl' => plugin_dir_url(__FILE__) ) );

	}

	public function enqueue_manifest() {
		echo '<link rel="manifest" href="' . plugin_dir_url( __FILE__ ) . 'manifest.json' . '">';
	}

	public function register_shortcodes() {
		add_shortcode('boton_filsa2018', array($this, 'filsa2018_button'));
	}

	public function serviceworker_path() {
		add_rewrite_endpoint( 'service-workerjs', EP_PAGES | EP_PERMALINK | EP_ALL_ARCHIVES );
	}

	public function serviceworker_endpoint($template) {
		global $wp_query;
		if(isset($wp_query->query_vars['service-workerjs'])) {
			$serviceworker = file_get_contents( plugin_dir_url(__FILE__) . 'partials/service-worker.js');
			$template = $serviceworker;	
		}

		return $template;
	}


	public function filsa2018_button($atts) {
	  /**
	   * Devuelve un botón con iconito link y texto
	   * PARAMETROS: [boton url="https://ejemplo.com" text="Clic Aquí" color="blue" icon="fa-angle-double-right" target="_blank"]
	   * Los Iconos toman la clase de FontAwesome correspondiente
	   * https://fontawesome.io/icons/
	   */
	  $button = shortcode_atts( 
	  	array(
	  		'url' => '#',
	  		'text' => 'Clic aquí',
	  		'target' => '_blank',
	  		'color' => 'rojo'
	  	), $atts );

	  return '<a style="background-color:#CC1011;font-family:Biblioteca, serif;font-weight: bold;color:white;border-radius:4px;padding:12px 16px;text-transform:uppercase;box-shadow:0 1px 2px #333;margin:10px 0;display:inline-block;" target="' .$button['target']. '" title="' . $button['text'] . '" href="' . $button['url'] . '" class="filsa2018_button ' . $button['color'] . '"> <img class="icon" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNy4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHdpZHRoPSIyNS43NTlweCIgaGVpZ2h0PSIyNS45NjdweCIgdmlld0JveD0iMCAwIDI1Ljc1OSAyNS45NjciIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI1Ljc1OSAyNS45NjciIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIzLjEwMSwxNi40MzdsLTEwLjIyMiw2Ljc0OEwyLjY1NywxNi40MzdWMy41NTNsOS41MzQsNS45MzVjMC4yLDAuMTIzLDAuNDI3LDAuMTg4LDAuNjY0LDAuMTg4DQoJYzAsMCwwLjAxNywwLDAuMDI0LTAuMDAyYzAuMDA4LDAuMDAyLDAuMDE3LDAuMDAyLDAuMDE3LDAuMDAyYzAuMjQ1LDAsMC40NzItMC4wNjUsMC42NzItMC4xODhsOS41MzMtNS45MzVWMTYuNDM3eiBNMjMuNzc3LDAuMTk4DQoJTDEyLjkxMSw2LjkzMWwtMC4wMzIsMC4wMTZsLTAuMDMxLTAuMDE2TDEuOTgyLDAuMTk4QzAuODQ5LTAuNDE5LDAsMC41NCwwLDEuMjc2djE1Ljg0NmMwLDAuNDI1LDAuMjQ2LDAuODIzLDAuNjAzLDEuMDU5DQoJbDExLjU3OCw3LjU3OGMwLjE4OSwwLjEyOCwwLjQzOSwwLjIxMywwLjY5OCwwLjIwOGMwLjI2MS0wLjAwNSwwLjUxLTAuMDgsMC42OTgtMC4yMDhsMTEuNTc5LTcuNTc4DQoJYzAuMzU3LTAuMjM2LDAuNjAzLTAuNjM0LDAuNjAzLTEuMDU5VjEuMjc2QzI1Ljc1OSwwLjU0LDI0LjkxMS0wLjQxOSwyMy43NzcsMC4xOTgiLz4NCjwvc3ZnPg0K" alt="Flecha Filsa">' . $button['text'] . '</a><style>.filsa2018_button img {vertical-align:middle; margin-right: 8px; max-width: 20px;margin-top:-5px;}</style>';
	}

}
