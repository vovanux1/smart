<?php
/**
 * smartsystem.fr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package smartsystem.fr
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'smartsystem_fr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function smartsystem_fr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on smartsystem.fr, use a find and replace
		 * to change 'smartsystem-fr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'smartsystem-fr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'smartsystem-fr' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'smartsystem_fr_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'smartsystem_fr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function smartsystem_fr_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'smartsystem_fr_content_width', 640 );
}
add_action( 'after_setup_theme', 'smartsystem_fr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function smartsystem_fr_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'smartsystem-fr' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'smartsystem-fr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'smartsystem_fr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function smartsystem_fr_scripts() {
	wp_enqueue_style( 'smartsystem-fr-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'smartsystem-fr-style', 'rtl', 'replace' );

	wp_enqueue_script( 'smartsystem-fr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'smartsystem_fr_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Add WP_Editor to Category Description
 * 
 * @param type $tag
 */
function dvt_cat_description( $tag ) { ?>

<tr class="form-field">
  <th scope="row" valign="top">
    <label for="description"><?php _e('Description'); ?></label>
  </th>
  <td><?php
				$settings = array(
					'wpautop' => true,
					'media_buttons' => false,
					'quicktags' => true,
					'tinymce' => true,
					'textarea_rows' => '10',
					'textarea_name' => 'description',
					'drag_drop_upload' => false
				);
				wp_editor( htmlspecialchars_decode( $tag->description ), 'cat_description', $settings ); ?>
    <br />
    <span
      class="description"><?php _e( 'The description is not prominent by default; however, some themes may show it.' ); ?></span>
  </td>
</tr>
<?php
}

add_filter( 'edit_category_form_fields', 'dvt_cat_description' );

/**
 * Функция возращает параметры указанной или текущей записи
**/
function dvt_get_post_settings($post = null) {
    if (!$post) {
        global $post;
    }          
    
    global $page_settings;    
    
    if ($page_settings) {
        return $page_settings;
    }      
    
    $post_category = get_the_category($post->ID);
    
    if (isset($post_category[0]->term_id)) {
        $default_settings = get_fields($post_category[0]);
    }    
        
  if(!in_category(2)){  $page_settings = array_filter(get_fields($post), function($element) {
        return !empty($element);
    });    }
    
    // параметры по умолчанию
    $page_settings = wp_parse_args($page_settings, [
        'head_image' => get_post_thumbnail_id($post->ID),
        'head_title' => get_the_title($post->ID),
        'head_text'  => '',
        'head_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta|btn-alvexo', 
        'footer_title' => 'Pour commencer à trader les actifs en ligne, rejoignez sans attendre un courtier de qualité',
        'footer_text'  => '',
        'footer_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta|btn-alvexo',
        'chart_button_1' => 'Trader avec les CFDs|https://www.smartsystem.fr/alvexocta|btn-alvexo',
        'chart_button_2' => 'Acheter/Vendre l\'action|https://www.smartsystem.fr/alvexocta|btn-alvexo',
        'disclamer_risk' => '79% des comptes des investisseurs particuliers perdent de l’argent en tradant les CFD avec ce fournisseur.',
    ]);
    
    if (!$page_settings['head_text']) {
        $content = wp_trim_words(strip_tags($post->post_content), 300);
        
        if ($content) {
            $dot_position = stripos($content, '.', stripos($content, '.') + 1);
                                                
            if (false !== $dot_position) {
                $content = substr($content, 0, $dot_position + 1);
            }             
            
            $page_settings['head_text'] = $content;
            $page_settings['cont_head_text'] = true;            
        }                                                                                        
    }      
    
    
    // параметры по умолчанию в зависимости от терма
    $default_key = ['head_button', 'footer_title', 'footer_text', 'footer_button'];
    
    if (isset($default_settings)) {
        foreach ($default_key AS $key) {
            if (!$page_settings[$key]) {
                $page_settings[$key] = $default_settings[$key];            
            }         
        }        
    }
    
    return $page_settings;
}

/**
 * Функция возращает параметры текущего терма 
**/
function dvt_get_term_settings($term = null) {
    if (!$term) {
        return;
    }
    
 /**   $term_settings = array_filter(get_fields($term), function($element) {
   *     return !empty($element);
 *   });               
    **/
    // параметры по умолчанию
    $term_settings = wp_parse_args($term_settings, [
        'head_title' => $term->cat_name,
        'head_text'  => '',
        'head_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta', 
        'footer_title' => 'Pour commencer à trader les actifs en ligne, rejoignez sans attendre un courtier de qualité',
        'footer_text'  => 'Is it regulated? Does my transaction go through a brokerage firm?',
        'footer_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta',
        'disclamer_risk' => '79% des comptes des investisseurs particuliers perdent de l’argent en tradant les CFD avec ce fournisseur.',
    ]);             
    
    return $term_settings;
}

/**
 * Функция возращает параметры по умолчанию 
**/
function dvt_get_default_settings($term = null) {
    
    if (is_404()) {
        $title = 'Nothing Found';
    } elseif (is_search()) {
        $title = 'Search Result';
    } else {
        $title = get_the_archive_title();
    }
    
    $settings = [
        'head_title' => $title,
        'head_text'  => '',
        'head_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta', 
        'footer_title' => 'Pour commencer à trader les actifs en ligne, rejoignez sans attendre un courtier de qualité',
        'footer_text'  => 'Is it regulated? Does my transaction go through a brokerage firm?',
        'footer_button'  => 'Tradez Maintenant !|https://www.smartsystem.fr/alvexocta',
        'disclamer_risk' => '79% des comptes des investisseurs particuliers perdent de l’argent en tradant les CFD avec ce fournisseur.',
    ];        
    
    return $settings;
}

/**
 * Функция возращает параметры указанного объекта
**/
function dvt_get_object_settings($object = []) {
    if (!$object) {
        $object = get_queried_object();
    }
    
    if (isset($object->term_id)) {
        $fields = dvt_get_term_settings($object);    
    } elseif (isset($object->ID)) {
        $fields = dvt_get_post_settings($object);
    } else {
        $fields = dvt_get_default_settings();
    }
    
    return $fields;
}

/**
 * Функция формирует шапку страницы по $page_settings (dvt_get_object_settings())
 * если $page_settings пуст, формируется шапка текущего страницы
**/
function dvt_the_page_block($position = 'head', $page_settings = array()) { 
    if (!$page_settings) {                
        $page_settings = dvt_get_object_settings();
    }
    
    $title = '';
    
    if (isset($page_settings[$position . '_title']) && $page_settings[$position . '_title']) {
        $tag_title = 'head' == $position ? 'h1' : 'div';
        $title = $page_settings[$position . '_title'];
        
        $title_size = mb_strlen($title);
        
        if ($title_size < 20) {
            $title_size = 'big';
        } elseif ($title_size < 60) {
            $title_size = 'middle';
        } else {
            $title_size = 'small';
        }
    }                        
?>
<div class="page-block page-<?= $position ?>">
  <div class="container">
    <?php if (isset($page_settings[$position . '_image']) && $id = $page_settings[$position . '_image']) : ?>
    <figure class="page-block-image">
      <?php 
                        echo wp_get_attachment_image($id, 'thumb-317x291', '', [
                            'alt' => $title,
                        ]);
                    ?>
    </figure>
    <?php endif; ?>

    <?php if ($title) : ?>
    <<?= $tag_title ?> class="page-block-title <?= $title_size ?>"><?= $title ?></<?= $tag_title ?>>
    <?php endif; ?>

    <?= 'footer' == $position ? '<div>' : '' ?>

    <?php if (isset($page_settings[$position . '_text']) && $page_settings[$position . '_text']) : ?>
    <div class="page-block-content">
      <?= apply_filters('the_content', $page_settings[$position . '_text']); ?>
    </div>
    <?php endif; ?>

    <?php if (isset($page_settings[$position . '_button']) && $page_settings[$position . '_button']) : ?>
    <div class="page-block-button">
      <?php if (is_single($post='eToro : Avis complet')) {?>
      <a rel="nofollow" href="https://www.smartsystem.fr/etoro" class="button " target="_blank" id="btn-etoro">Tradez
        Maintenant !</a>

      <?php } else if (is_single($post=13905)) {?>
      <a rel="nofollow" href="https://www.xtb.com/fr" class="button " target="_blank" id="btn-xtb">Tradez Maintenant
        !</a>

      <?php } else { ?>
      <?= dvt_get_button_by_tmp($page_settings[$position . '_button']); ?>
    </div>
    <?php }  ?> <?php endif; ?>

    <?php 
               /* if ('head' == $position) {
                    dvt_the_post_rating();
                }*/
            ?>

    <?php if (isset($page_settings[$position . '_title'], $page_settings['disclamer_risk']) && $page_settings['disclamer_risk']) : ?>
    <div class="page-block-risk" style="max-width: 800px !important">
      <?= $page_settings['disclamer_risk'] ?>
    </div>
    <?php endif; ?>

    <?= 'footer' == $position ? '</div>' : '' ?>
  </div>
</div>
<?    
}


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5dc7c2f88af07',
	'title' => 'brend',
	'fields' => array(
		array(
			'key' => 'field_5dc7c33c64726',
			'label' => 'Brend name',
			'name' => 'c-brend',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dc7c33c64727',
			'label' => 'Brend id',
			'name' => 'id-brend',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c4e8333b7af3',
	'title' => 'Redirect',
	'fields' => array(
		array(
			'key' => 'field_57fff88b73c22',
			'label' => 'Text before logo',
			'name' => 'text_before_logo',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'VOUS ALLEZ êTRE REDIRIGÉ VERS:<br /><span>SYSTEM</span>',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
		array(
			'key' => 'field_57fff85a73c20',
			'label' => 'logo',
			'name' => 'logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'preview_size' => 'thumb_103x68',
			'library' => 'all',
			'return_format' => 'url',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => '',
		),
		array(
			'key' => 'field_57fff87973c21',
			'label' => 'Link',
			'name' => 'link',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
		array(
			'key' => 'field_57fffc3c5bb4c',
			'label' => 'Text after logo',
			'name' => 'text_after_logo',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'AVEC<span>UN BONUS</span> ET<br> <span>UNE FORMATION PRIVÉE</span> NÉGOCIÉS<br>POUR LES LECTEURS D’OPTIONMAG',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'redirect.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
		4 => 'revisions',
		5 => 'slug',
		6 => 'author',
		7 => 'format',
		8 => 'featured_image',
		9 => 'categories',
		10 => 'tags',
		11 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c47cb3619cca',
	'title' => 'Параметры главной',
	'fields' => array(
		array(
			'key' => 'field_5c47cb8a90ec6',
			'label' => 'Преимущества',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47d97acb79e',
			'label' => '#1',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47cbc490ec7',
			'label' => '',
			'name' => 'advantage_1',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5c47cbd990ec8',
					'label' => 'Заголовок',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c47cc0990ec9',
					'label' => 'Описание',
					'name' => 'description',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => 3,
					'new_lines' => 'br',
				),
				array(
					'key' => 'field_5c47cc1a90eca',
					'label' => 'Изображение',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'full',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
		array(
			'key' => 'field_5c47d98ecb79f',
			'label' => '#2',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47cc4390ecb',
			'label' => '',
			'name' => 'advantage_2',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5c47cc4390ecc',
					'label' => 'Заголовок',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c47cc4390ecd',
					'label' => 'Описание',
					'name' => 'description',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => 3,
					'new_lines' => 'br',
				),
				array(
					'key' => 'field_5c47cc4390ece',
					'label' => 'Изображение',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'full',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
		array(
			'key' => 'field_5c47d993cb7a0',
			'label' => '#3',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47cdd3655cb',
			'label' => '',
			'name' => 'advantage_3',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5c47cdd3655cc',
					'label' => 'Заголовок',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c47cdd3655cd',
					'label' => 'Описание',
					'name' => 'description',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => 3,
					'new_lines' => 'br',
				),
				array(
					'key' => 'field_5c47cdd3655ce',
					'label' => 'Изображение',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'full',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
		array(
			'key' => 'field_5c47d8f3d452d',
			'label' => 'Статьи',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47d915d452f',
			'label' => '',
			'name' => 'articles',
			'type' => 'relationship',
			'instructions' => 'Выберите записи для их вывода в блоке "Articles".',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'post',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'post_type',
				2 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_template',
				'operator' => '==',
				'value' => 'templates/template-home.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c4e8333cf3fd',
	'title' => 'Параметры записи',
	'fields' => array(
		array(
			'key' => 'field_5b9287832b5f4',
			'label' => 'Дискламер риска',
			'name' => 'disclamer_risk',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b90f3a6a02cb',
			'label' => 'Верхний блок',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5b90f3c9a02cc',
			'label' => 'Заголовок',
			'name' => 'head_title',
			'type' => 'text',
			'instructions' => 'Введите заголовок верхнего блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b90f3e1a02cd',
			'label' => 'Текст',
			'name' => 'head_text',
			'type' => 'wysiwyg',
			'instructions' => 'Введите текст верхнего блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'toolbar' => 'full',
			'media_upload' => 1,
			'tabs' => 'all',
			'delay' => 0,
		),
		array(
			'key' => 'field_5b91327733baa',
			'label' => 'Кнопка',
			'name' => 'head_button',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b910709a9b90',
			'label' => 'Изображение',
			'name' => 'head_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'preview_size' => 'full',
			'library' => 'all',
			'return_format' => 'url',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b90f3fba02ce',
			'label' => 'Нижний блок',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5b90f408a02cf',
			'label' => 'Заголовок',
			'name' => 'footer_title',
			'type' => 'text',
			'instructions' => 'Введите заголовок ниженго блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b90f41ba02d0',
			'label' => 'Текст',
			'name' => 'footer_text',
			'type' => 'wysiwyg',
			'instructions' => 'Введите текст нижнего блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'toolbar' => 'full',
			'media_upload' => 1,
			'tabs' => 'all',
			'delay' => 0,
		),
		array(
			'key' => 'field_5b9132a933bac',
			'label' => 'Кнопка',
			'name' => 'footer_button',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b9152ee26aa6',
			'label' => 'Фоновое изображение',
			'name' => 'footer_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'preview_size' => 'full',
			'library' => 'all',
			'return_format' => 'url',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b9126f713d55',
			'label' => 'График и бегущая строка',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5b91269ac633e',
			'label' => 'Код графика',
			'name' => 'chart',
			'type' => 'textarea',
			'instructions' => 'Вставьте код графика в это полей.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5b912b254a88c',
			'label' => 'Код бегущей строки',
			'name' => 'signle_ticket',
			'type' => 'textarea',
			'instructions' => 'Вставьте код бегущей строки в это полей.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5b91643728d17',
			'label' => 'Ссылка бегущей строки',
			'name' => 'signle_ticket_link',
			'type' => 'text',
			'instructions' => 'Введенная ссылка налаживается на блок с бегущей строкой и перекрывает ссылку виджета.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b9130ecbdeaf',
			'label' => 'Кнопка №1',
			'name' => 'chart_button_1',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b913105bdeb0',
			'label' => 'Кнопка №2',
			'name' => 'chart_button_2',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'formatting' => 'none',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5c4e87724be7e',
			'label' => 'Баннера',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c4e877e4be7f',
			'label' => 'Баннер под шапкой',
			'name' => 'banner_header',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5c4e87874be80',
			'label' => 'Баннер в сайдбаре',
			'name' => 'banner_sidebar',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c4715612b872',
	'title' => 'Параметры терма',
	'fields' => array(
		array(
			'key' => 'field_5c471597e4e28',
			'label' => 'Шапка',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c47156de4e27',
			'label' => 'Изображение',
			'name' => 'head_image',
			'type' => 'image',
			'instructions' => 'Выберите изображение для категории. Если изображение не выбрано, по умолчанию выводится <a target="_blank" href="https://optionmag.fr/wp-content/uploads/2018/10/trading-2.jpg">это изображение</a>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5c4715abe4e29',
			'label' => 'Заголовок',
			'name' => 'head_title',
			'type' => 'text',
			'instructions' => 'Введите заголовок для шапки категории. По умолчанию, если поле пусто, выводится заголовок категории.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5c4715c6e4e2a',
			'label' => 'Описание',
			'name' => 'head_text',
			'type' => 'textarea',
			'instructions' => 'Введите описание для шапки категории.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5c4715d6e4e2b',
			'label' => 'Кнопка',
			'name' => 'head_button',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>. Кнопка выводится в шапке категории. По умолчанию, если поле пусто, выводится значение "Верхняя кнопка" из <a target="_blank" href="https://optionmag.fr/wp-admin/admin.php?page=defaults">этих настроек.</a>',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5c4916b94c7dd',
			'label' => 'Подвал',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c4916de4c7de',
			'label' => 'Заголовок',
			'name' => 'footer_title',
			'type' => 'text',
			'instructions' => 'Введите заголовок нижнего блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5c4916ed4c7df',
			'label' => 'Текст',
			'name' => 'footer_text',
			'type' => 'wysiwyg',
			'instructions' => 'Введите текст нижнего блока.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_5c49170b4c7e0',
			'label' => 'Кнопка',
			'name' => 'footer_button',
			'type' => 'text',
			'instructions' => 'Введите текст и ссылку кнопки в формате: <code>Текст|ссылка|id</code>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5c471611e4e2d',
			'label' => 'Баннера',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c4715f3e4e2c',
			'label' => 'Баннер под шапкой',
			'name' => 'banner_header',
			'type' => 'textarea',
			'instructions' => 'Введенный баннер будет выведен в шапке записей рубрики. Если поле пусто, выводится <a target="_blank" href="/wp-admin/admin.php?page=banner_manager">баннер по умолчанию</a>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5c4abe8a480aa',
			'label' => 'Баннер в сайдбаре',
			'name' => 'banner_sidebar',
			'type' => 'textarea',
			'instructions' => 'Введенный баннер будет выведен в сайдбаре записей рубрики. Если поле пусто, выводится <a target="_blank" href="/wp-admin/admin.php?page=banner_manager">баннер по умолчанию</a>.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'category',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c470c286ea7d',
	'title' => 'Рейтинг',
	'fields' => array(
		array(
			'key' => 'field_5c4712b9069e5',
			'label' => 'Рейтинг',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5c4712c4069e6',
			'label' => 'Отображение рейтинга',
			'name' => 'hide_rating',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Скрыть рейтинг?',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5c4712e1069e7',
			'label' => 'Рейтинг страницы',
			'name' => 'rating_active',
			'type' => 'number',
			'instructions' => 'Введите количество активных звезд. Если оставить поле пустым, значение автоматически будет сгенерировано',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5c4712fe069e8',
			'label' => 'Количество проголосовавших',
			'name' => 'rating_voted',
			'type' => 'number',
			'instructions' => 'Если оставить поле пустым, значение автоматически будет сгенерировано',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'category',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;



/**
 * Функция генерирования кнопки по шаблону
**/
function dvt_get_button_by_tmp($template = '', $atts = []) {
    $template = explode('|', $template);
    
    if (!isset($template[0]) || !isset($template[1])) {
        return;
    }
    
    $atts = array_merge($atts, [
        'caption' => $template[0],
        'link'    => $template[1],
    ]);
	
	// Добавил для формирования id у кнопки 
	if (isset($template[2])) {
		$atts = array_merge($atts, [
			'id' => $template[2],
		]);
	}
    
    $button = dvt_shortcode_button($atts);
    
    return $button;
}

/**
 * Функция очистки $string от ненужного кода
**/
function dvt_remove_link($string = '') {
    //$string = strip_tags($string, '<script><div>');
    $string = preg_replace("!<div class=\"tradingview-widget-copyright\">(.*?)</div>!si", "", $string);
    
    return $string;
}

/**
 * Функция возвращает график текущей страницы
**/
function dvt_the_chart() {
    global $page_settings;
        
    if (!$page_settings) {
        $page_settings = dvt_get_page_settings();
    }        
?>
<div class="wrapper-page-charts">
  <?php if (isset($page_settings['chart'])) : ?>
  <div class="page-block-chart">
    <?= dvt_remove_link($page_settings['chart']); ?>
  </div>
  <?php endif; ?>

  <?php if (isset($page_settings['signle_ticket'])) :  ?>
  <div class="inner-left">
    <div class="page-block-single_ticket">
      <?= dvt_remove_link($page_settings['signle_ticket']) ?>
      <?php if (isset($page_settings['signle_ticket_link'])) : ?>
      <a href="<?= $page_settings['signle_ticket_link'] ?>" rel="nofollow" class="single_ticket-link"
        target="_blank"></a>
      <?php endif; ?>
    </div>

    <?php if (isset($page_settings['chart_button_1']) || isset($page_settings['chart_button_1'])) : ?>
    <div class="page-block-buttons">
      <?php




                            if (isset($page_settings['chart_button_1'])) {
                                echo dvt_get_button_by_tmp($page_settings['chart_button_1'], [
                                    'class' => 'button-blue',
                                ]);
                            }
                                                
                            if (isset($page_settings['chart_button_2'])) {
                                echo dvt_get_button_by_tmp($page_settings['chart_button_2'], [
                                    'class' => 'button-light',
                                ]);
                            }                                            
                        ?>
    </div>
    <?php endif; ?>

    <?php dvt_the_post_rating() ?>
  </div>
  <?php endif; ?>
</div>
<?
    
}

/**
 * Содержание (оглавление) для больших постов.
 *
 * @author:  Kama
 * @info:    http://wp-kama.ru/?p=1513
 * @version: 3.17
 *
 * @changelog: https://github.com/doiftrue/Kama_Contents/blob/master/CHANGELOG.md
 */
class Kama_Contents {

	public $opt = [
		// Отступ слева у подразделов в px.
		'margin'     => 40,
		// Теги по умолчанию по котором будет строиться оглавление. Порядок имеет значение.
		// Кроме тегов, можно указать атрибут classа: array('h2','.class_name'). Можно указать строкой: 'h2 h3 .class_name'
		'selectors'  => [ 'h2','h3','h4' ],
		// Ссылка на возврат к оглавлению. '' - убрать ссылку
		'to_menu'    => '',
		// Заголовок. '' - убрать заголовок
		// Css стили. '' - убрать стили
		'css'        => '',
		// JS код (добавляется после HTML кода)
		'js'  => '',
		// Минимальное количество найденных тегов, чтобы оглавление выводилось.
		'min_found'  => 2,
		// Минимальная длина (символов) текста, чтобы оглавление выводилось.
		'min_length' => 500,
		// Ссылка на страницу для которой собирается оглавление. Если оглавление выводиться на другой странице...
		'page_url'   => '',
		// Название шоткода
		'shortcode'  => 'contents',
		// Оставлять символы в анкорах
		'spec'       => '\'.+$*~=',
		// Какой тип анкора использовать: 'a' - <a name="anchor"></a> или 'id' -
		'anchor_type' => 'id',
		// Название атрибута тега из значения которого будет браться анкор (если этот атрибут есть у тега). Ставим '', чтобы отключить такую проверку...
		'anchor_attr_name' => 'id',
		// Включить микроразметку?
		'markup'      => true,
		// Добавить 'знак' перед подзаголовком статьи со ссылкой на текущий анкор заголовка. Укажите '#', '&' или что вам нравится :)
		'anchor_link' => '',
		// минимальное количество символов между заголовками содержания, для которых нужно выводить ссылку "к содержанию".
		// Не имеет смысла, если параметр 'to_menu' отключен. С целью производительности, кириллица считается без учета кодировки.
		// Поэтому 800 символов кириллицы - это примерно 1600 символов в этом параметре. 800 - расчет для сайтов на кириллице...
		'tomenu_simcount' => 800,
	];

	public $contents; // collect html (contents)

	private $temp;

	static $inst;

	function __construct( $args = array() ){
		$this->set_opt( $args );
		return $this;
	}

	/**
	 * Create instance.
	 *
	 * @param  array $args Options
	 * @return object Instance
	 */
	static function init( $args = array() ){
		is_null( self::$inst ) && self::$inst = new self( $args );
		if( $args ) self::$inst->set_opt( $args );
		return self::$inst;
	}

	function set_opt( $args = array() ){
		$this->opt = (object) array_merge( (array) $this->opt, (array) $args );
	}

	/**
	 * Processes the text, turns the shortcode in it into a table of contents.
	 *
	 * @param string $content      The text, which has a shortcode.
	 * @param string $contents_cb  Сallback function that will process the contents list.
	 *
	 * @return string Processed text with a table of contents, if it has a shotcode.
	 */
	function shortcode( $content, $contents_cb = '' ){
		return $content;//null
        
        if( false === strpos( $content, '['. $this->opt->shortcode ) )
			return $content;

		// get contents data
		if( ! preg_match('~^(.*)\['. $this->opt->shortcode .'([^\]]*)\](.*)$~s', $content, $m ) )
			return $content;

		$contents = $this->make_contents( $m[3], $m[2] );

		if( $contents && $contents_cb && is_callable($contents_cb) )
			$contents = $contents_cb( $contents );

		return $m[1] . $contents . $m[3];
	}

	/**
	 * Replaces the headings in the passed text (by ref), creates and returns a table of contents.
	 *
	 * @param string        $content The text from which you want to create a table of contents.
	 * @param array|string  $tags    Array of HTML tags to look for in the passed text.
	 *                               You can specify: tag names "h2 h3" or names of CSS classes ".foo .foo2".
	 *                               You can add "embed" mark here to get <ul> tag only (without header and wrapper block).
	 *                               It can be useful for use contents inside the text as a list.
	 *
	 * @return string HTML code of contents.
	 */
	function make_contents( & $content, $tags = '' ){
    	return $content;//null
		// return if text is too short
		if( mb_strlen( strip_tags($content) ) < $this->opt->min_length )
			return '';

		$this->temp     = $this->opt;
		$this->contents = array();

		if( ! $tags )
			$tags = $this->opt->selectors;

		if( is_string($tags) ){
			$extra_tags = array();
			if( preg_match( '/(as_table)="([^"]+)"/', $tags, $mm ) ){
				$extra_tags[ $mm[1] ] = explode( '|', $mm[2] );
				$tags = str_replace( " {$mm[0]}", '', $tags ); // cut
			}
			$tags  = array_map( 'trim', preg_split('/[ ,]+/', $tags ) );
			$tags += $extra_tags;
		}

		$tags = array_filter( $tags ); // del empty

		// check tags
		foreach( $tags as $key => $tag ){

			// extra tags
			if( in_array( $key, array('as_table'), true ) ){
				$this->temp->as_table = $tag;

				unset( $tags[ $key ] );
				continue;
			}

			// remove special marker tags and set $args
			if( in_array( $tag, array('embed','no_to_menu') ) ){
				if( $tag == 'embed' )      $this->temp->embed = true;
				if( $tag == 'no_to_menu' ) $this->opt->to_menu = false;

				unset( $tags[ $key ] );
				continue;
			}

			// remove tag if it's not exists in content
			$patt = ( ($tag[0] == '.') ? 'class=[\'"][^\'"]*'. substr($tag, 1) : "<$tag" );
			if( ! preg_match("/$patt/i", $content ) ){
				unset( $tags[ $key ] );
				continue;
			}
		}

		if( ! $tags )
			return '';

		// set patterns from given $tags
		// separate classes & tags & set
		$class_patt = $tag_patt = $level_tags = array();
		foreach( $tags as $tag ){
			// class
			if( $tag{0} == '.' ){
				$tag  = substr( $tag, 1 );
				$link = & $class_patt;
			}
			// html tag
			else
				$link = & $tag_patt;

			$link[] = $tag;
			$level_tags[] = $tag;
		}

		$this->temp->level_tags = array_flip( $level_tags );

		// replace all titles & collect contents to $this->contents
		$patt_in = array();
		if( $tag_patt )   $patt_in[] = '(?:<('. implode('|', $tag_patt) .')([^>]*)>(.*?)<\/\1>)';
		if( $class_patt ) $patt_in[] = '(?:<([^ >]+) ([^>]*class=["\'][^>]*('. implode('|', $class_patt) .')[^>]*["\'][^>]*)>(.*?)<\/'. ($patt_in?'\4':'\1') .'>)';

		$patt_in = implode('|', $patt_in );

		$this->temp->content = $content;

		// collect and replace
		$_content = preg_replace_callback("/$patt_in/is", array( $this, '_make_contents_callback'), $content, -1, $count );

		if( ! $count || $count < $this->opt->min_found ){
			unset($this->temp); // clear cache
			return '';
		}

		$this->temp->content = $content = $_content; // $_content was for check reasone

		// html
		static $css, $js;
		$embed   = isset($this->temp->embed);
		$_tit    = & $this->opt->title;
		$_is_tit = ! $embed && $_tit;

		// markup
		$ItemList = $this->opt->markup ? ' itemscope itemtype="http://schema.org/ItemList"' : '';

		if( isset($this->temp->as_table) ){
			$contents = '
			<table class="contents" id="kcmenu"'. ($ItemList ?: '') .'>
				<thead>
					<tr>
						<th>'. esc_html( $this->temp->as_table[0] ) .'</th>
						<th>'. esc_html( $this->temp->as_table[1] ) .'</th>
					</tr>
				</thead>
				<tbody>
					'. implode('', $this->contents ) .'
				</tbody>
			</table>';
		}
		else {
			$contents =
				( $_is_tit ? '<div class="kc__wrap"'. $ItemList .' >' : '' ) .
				( $_is_tit ? '<span style="display:block;" class="kc-title kc__title" id="kcmenu"'. ($ItemList?' itemprop="name"':'') .'>'. $_tit .'</span>'. "\n" : '' ) .
				'<ul class="tableofcontent"'. ( (! $_tit || $embed) ? ' id="kcmenu"' : '' ) . ( ($ItemList && ! $_is_tit ) ? $ItemList : '' ) .'>'. "\n".
				implode('', $this->contents ) .
				'</ul>'."\n" .
				( $_is_tit ? '</div>' : '' );
		}

		$contents =
			( ( ! $css && $this->opt->css ) ? '<style>'. preg_replace('/[\n\t ]+/', ' ', $this->opt->css ) .'</style>' : '' ) .
			$contents .
			( ( ! $js && $this->opt->js ) ? '<script>'. preg_replace('/[\n\t ]+/', ' ', $this->opt->js ) .'</script>' : '' ) ;

		unset( $this->temp ); // clear cache

		return $this->contents = $contents;
	}

	## callback function to replace and collect contents
	private function _make_contents_callback( $match ){
		$temp = & $this->temp;

		// it's only class selector in pattern
		if( count($match) == 5 ){
			$tag   = $match[1];
			$attrs = $match[2];
			$tag_txt = $match[4];

			$level_tag = $match[3]; // class_name
		}
		// it's found tag selector
		elseif( count($match) == 4 ){
			$tag   = $match[1];
			$attrs = $match[2];
			$tag_txt = $match[3];

			$level_tag = $tag;
		}
		// it's found class selector
		else{
			$tag   = $match[4];
			$attrs = $match[5];
			$tag_txt = $match[7];

			$level_tag = $match[6]; // class_name
		}

		if( isset($this->temp->as_table) ){
			$tag_desc = '';
			//if( preg_match( '/'. preg_quote($match[0], '/') .'\s*<p>((?:.(?!<\/p>))+)./', $this->temp->content, $mm ) ){
			if( preg_match( '/'. preg_quote($match[0], '/') .'\s*<p>(.+?)<\/p>/', $this->temp->content, $mm ) ){
				$tag_desc = $mm[1];
			}
		}

		$opt = $this->opt; // short love

		// if tag contains id attribute it become anchor
		if( $opt->anchor_attr_name && preg_match('/ *('. preg_quote($opt->anchor_attr_name) .')=([\'"])(.+?)\2 */i', $attrs, $id_match) ){
			if( in_array($id_match[1], array('id','name')) )
				$attrs = str_replace( $id_match[0], '', $attrs ); // delete 'id' or 'name' attr from attrs
			$anchor = $this->_sanitaze_anchor( $id_match[3] );
		}
		else
			$anchor = $this->_sanitaze_anchor( $tag_txt );

		$level = @ $temp->level_tags[ $level_tag ];
		if( $level > 0 )
			$sub = ' class="sub sub_'. $level .'"';
		else
			$sub = ' class="top"';

		// collect contents
		// markup
		$_is_mark = $opt->markup;

		$temp->counter = empty($temp->counter) ? 1 : $temp->counter+1;

		// $tag_txt не может содержать A, IMG теги - удалим если надо...
		$cont_elem_txt = $tag_txt;
		if( false !== strpos($cont_elem_txt, '</a>') ) $cont_elem_txt = preg_replace('~<a[^>]+>|</a>~', '', $cont_elem_txt );
		if( false !== strpos($cont_elem_txt, '<img') ) $cont_elem_txt = preg_replace('~<img[^>]+>~', '', $cont_elem_txt );

		if( isset($this->temp->as_table) ){
			$this->contents[] = "\t".'
				<tr>
					<td '. ($_is_mark?' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"':'') .'>
						<a rel="nofollow"'. ($_is_mark?' itemprop="url"':'') .' href="'. $opt->page_url .'#'. $anchor .'">
							'.( $_is_mark ? '<span itemprop="name">'. $cont_elem_txt .'</span>' : $cont_elem_txt ).'
						</a>
						'.( $_is_mark ? ' <meta itemprop="position" content="'. $temp->counter .'" />':'' ).'
					</td>
					<td>'. $tag_desc .'</td>
				</tr>'. "\n";
		}
		else {
			$this->contents[] = "\t".'
				<li'. $sub . ($_is_mark?' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"':'') .'>
					<a rel="nofollow"'. ($_is_mark?' itemprop="url"':'') .' href="'. $opt->page_url .'#'. $anchor .'">
						'.( $_is_mark ? '<span itemprop="name">'. $cont_elem_txt .'</span>' : $cont_elem_txt ).'
					</a>
					'.( $_is_mark ? ' <meta itemprop="position" content="'. $temp->counter .'" />':'' ).'
				</li>'. "\n";
		}

		if( $opt->anchor_link )
			$tag_txt = '<a rel="nofollow" class="kc__anchlink" href="#'. $anchor .'">'. $opt->anchor_link .'</a> ' . $tag_txt;

		// anchor type: 'a' or 'id'
		if( $opt->anchor_type === 'a' )
			$new_el = '<a class="kc__anchor" name="'. $anchor .'"></a>'."\n<$tag $attrs>$tag_txt</$tag>";
		else
			$new_el = "\n<$tag id=\"$anchor\" $attrs>$tag_txt</$tag>";

		$to_menu = '';
		if( $opt->to_menu ){
			// go to contents
			$to_menu = '<a rel="nofollow" class="kc-gotop kc__gotop" href="'. $opt->page_url .'#kcmenu">'. $opt->to_menu .'</a>';

			// remove '$to_menu' if simbols beatween $to_menu too small (< 300)
			$pos = strpos( $temp->content, $match[0] ); // mb_strpos( $temp->content, $match[0] ) - в 150 раз медленнее!
			if( empty($temp->elpos) ){
				$prevpos = 0;
				$temp->elpos = array( $pos );
			}
			else {
				$prevpos = end($temp->elpos);
				$temp->elpos[] = $pos;
			}
			$simbols_count = $pos - $prevpos;
			if( $simbols_count < $opt->tomenu_simcount ) $to_menu = '';
		}

		return $to_menu . $new_el;
	}

	## anchor transliteration
	function _sanitaze_anchor( $anch ){
		$anch = strip_tags( $anch );

		$iso9 = array(
			'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ё'=>'YO', 'Ж'=>'ZH',
			'З'=>'Z', 'И'=>'I', 'Й'=>'J', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O',
			'П'=>'P', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Х'=>'H', 'Ц'=>'TS',
			'Ч'=>'CH', 'Ш'=>'SH', 'Щ'=>'SHH', 'Ъ'=>'', 'Ы'=>'Y', 'Ь'=>'', 'Э'=>'E', 'Ю'=>'YU', 'Я'=>'YA',
			// small
			'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ё'=>'yo', 'ж'=>'zh',
			'з'=>'z', 'и'=>'i', 'й'=>'j', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o',
			'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'ts',
			'ч'=>'ch', 'ш'=>'sh', 'щ'=>'shh', 'ъ'=>'', 'ы'=>'y', 'ь'=>'', 'э'=>'e', 'ю'=>'yu', 'я'=>'ya',
			// other
			'Ѓ'=>'G', 'Ґ'=>'G', 'Є'=>'YE', 'Ѕ'=>'Z', 'Ј'=>'J', 'І'=>'I', 'Ї'=>'YI', 'Ќ'=>'K', 'Љ'=>'L', 'Њ'=>'N', 'Ў'=>'U', 'Џ'=>'DH',
			'ѓ'=>'g', 'ґ'=>'g', 'є'=>'ye', 'ѕ'=>'z', 'ј'=>'j', 'і'=>'i', 'ї'=>'yi', 'ќ'=>'k', 'љ'=>'l', 'њ'=>'n', 'ў'=>'u', 'џ'=>'dh'
		);

		$anch = strtr( $anch, $iso9 );

		$spec = preg_quote( $this->opt->spec );
		$anch = preg_replace("/[^a-zA-Z0-9_$spec\-]+/", '-', $anch ); // все ненужное на '-'
		$anch = strtolower( trim( $anch, '-') );
		$anch = substr( $anch, 0, 70 ); // shorten
		$anch = $this->_unique_anchor( $anch );

		return $anch;
	}

	## adds number at the end if this anchor already exists
	function _unique_anchor( $anch ){
		$temp = & $this->temp;

		// check and unique anchor
		if( empty($temp->anchors) ){
			$temp->anchors = array( $anch => 1 );
		}
		elseif( isset($temp->anchors[ $anch ]) ){
			$lastnum = substr( $anch, -1 );
			$lastnum = is_numeric($lastnum) ? $lastnum + 1 : 2;
			return $this->_unique_anchor( "$anch-$lastnum" );
		}
		else {
			$temp->anchors[ $anch ] = 1;
		}

		return $anch;
	}

	## cut the shortcode from the content
	function strip_shortcode( $text ){
		return preg_replace('~\['. $this->opt->shortcode .'[^\]]*\]~', '', $text );
	}

}
## Вывод содержания вверху, автоматом для всех постов
add_filter( 'the_content', 'contents_on_post_top', 20 );
function contents_on_post_top( $content ){
	return $content;
    
    if( ! is_single() )
		return $content;

	$args = array(
		//'margin'    => 50,
		//'to_menu'   => false,
		//'title'     => false,
		'selectors' => array('h2','h3'),
	);

	if ($contents = Kama_Contents::init( $args )->make_contents( $content )) {
	   $contents = '<div class="spoiler-wrap"><div class="spoiler-head folded">+</div><div class="spoiler-body">' . $contents . '</div></div>';
	}

	return $contents . $content;
}


/*снипет*/


add_filter( 'code_snippets/list_table/default_orderby', function () {
	return 'name';
} );

add_filter( 'code_snippets/list_table/default_orderby', function () {
	return 'modified';
} );

add_filter( 'code_snippets/list_table/default_order', function () {
	return 'desc';
} );

add_shortcode( 'c-faq-negative', function ($atts, $content='') {
	
    $atts = shortcode_atts(array(
        'link' => '#',
    ), $atts);
	
	
	$out = <<<EOT
	  

<section  class="c-faq" itemscope itemtype="https://schema.org/FAQPage">

	<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
		<h3 itemprop="name">Où acheter des actions $content en toute simplicité ?</h3>
		<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
				Notre équipe a testé pour vous la plupart des plateformes en ligne. Il va de soi que la qualité n’est pas au rendez-vous sur beaucoup d’entre elles. C’est pourquoi nous vous proposons d’acheter vos cryptos <a href="/avis-sur-alvexo-lun-des-meilleurs-courtiers">sur Alvexo</a>, un broker sécurisé et offrant des retraits rapides ! Ce courtier intuitif vous permettra de générer plus de bénéfices, plus facilement.
Inscrivez-vous ici ! 
			</div>
		</div>
	</div>
	
	
	<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
		<h3 itemprop="name">Сomment rentabiliser ses investissements sur les actions ?</h3>
		<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
				Pour cela, il faut tout d’abord choisir un bon courtier en ligne. C’est en effet la base du trading. Évitez les arnaques et faites confiance aux brokers avec lesquels notre équipe travaille depuis des années qu’on vous présente <a href="/choisir-sa-plateforme-de-trading-meilleurs-sites-forex">dans notre sélection</a>.
			</div>
		</div>
	</div>
	
	
</section>



EOT;

	return $out;
} );

add_shortcode('c-box-6', function ($atts, $content = '') {



        $out = <<<EOT
<section class="c-box-6 c-box-6-2">
    <div class="c-box-6-row">
        <div class="c-box-6-col-1">

            <div>
                <section class="c-box-6-title">
                    <div>
                        Obtenez le bon signal au bon moment
                        <div class="c-box-6-t1">
                            Nos signaux : une source d'inspiration pour vos futurs trades !
                        </div>
                    </div>
                </section>

               
            </div>
            
            <div>
                <div class="c-box-6-logo">
                    <img src="https://lps.alvexo.fr/custom_images/fr/education/introduction_a_linvestissement/Alvexo-logo-slogan-SVG-white.svg">
                </div>
            </div>


        </div>
        <div class="c-box-6-col-2">


            <div class="c-box-6-advantages">
                <div class="c-box-6-advantages-row">
                    <div class="c-box-6-advantages-col c-box-6-advantages-positive">
                        <div class="c-box-6-advantages-title">
                            Avantages
                        </div>
                        <ul>
                            <li> <span>Actions</span> </li>
                            <li> <span>Matières premières</span></li>
                            <li> <span>Indices</span></li>
                            <li><span>Métaux</span></li>
                            <li><span>Devises</span></li>
                            <li><span>Crypto-monnaies</span></li>

                        </ul>
                    </div>

                </div>

            </div>
			
			 <section class="c-box-6-dl">
                    <dl>
                        <dt>Sélectionnés</dt>
                        <dd>100%</dd>
                    </dl>
                    <dl>
                        <dt>Signaux mensuels</dt>
                        <dd>150+</dd>
                    </dl>
                    <dl>
                        <dt>de précision</dt>
                        <dd>82%</dd>
                    </dl>
                </section>


            <div class="c-box-6-btn">
                <a class="c-box-6-btn" href="/xzld">MON PACKAGE ICI</a>
            </div>

        </div>

    </div>

</section>
EOT;
    
    return $out;
});

add_shortcode('table', function ($atts, $content = '') {



    if ($atts['id'] == 1) {
$out = <<<EOT

<section class="c-table">
    <table>
        <thead>
            <tr>
                <th>Broker</th>
                <th>On aime</th>
                <th>Dépôt minimum</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/alvexo.png" alt="" width="205" height="95" class="alignnone size-full wp-image-115" /></td>
                <td data-title="On aime"><strong>Meilleur courtier Français selon nos lecteurs</strong><br>
----------------------<br>
Webinaires par des analystes boursiers chez BFM TV<br>
----------------------<br>
Formation et Gestionnaire de compte PRO<br>
----------------------<br>
Signaux de Trading en LIVE</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">500$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/realaccount" target="_blank">COMMENCER A TRADER</a></td>
            </tr>
            			<tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/etoro.png" alt="" width="205" height="95" class="alignnone size-full wp-image-115" /></td>
                <td data-title="On aime">Trading social<br>
----------------------<br>
Plateforme parfaite pour les débutants
</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">200$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/etoro" target="_blank">COMMENCER A TRADER</a></td>
            </tr>
            
            

        </tbody>
    </table>
</section>

EOT;
return do_shortcode($out);
    }

    if ($atts['id'] == 2) {
        $out = <<<EOT

<section class="c-table">
    <table>
        <thead>
            <tr>
                <th>Broker</th>
                <th>Note</th>
                <th>Dépôt minimum</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/alvexo.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">19 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">100$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/realaccount" target="_blank">COMMENCER A TRADER</a></td>
				
            </tr>
						<tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/etoro.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">13 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">200$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/etoro" target="_blank">COMMENCER A TRADER</a></td>
				
            </tr>
            
        </tbody>
    </table>
</section>

EOT;
        return do_shortcode($out);
    }

    if ($atts['id'] == 5) {
        $out = <<<EOT

<section class="c-table">
    <table>
        <thead>
            <tr>
                <th>Broker</th>
                <th>Note</th>
                <th>Dépôt minimum</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/2019/08/olymptrade-1-e1566503516456.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">19 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">15 $</div></td>
                <td data-title=""><a class="btn-cta-2" href="/olymptrade" target="_blank">COMMENCER A TRADER</a></td>
				
            </tr>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/2019/08/iq-option-Logo-e1566503533803.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">15 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">10 $</div></td>
                <td data-title=""><a class="btn-cta-2" href="/iqoption" target="_blank">COMMENCER A TRADER</a></td>
            </tr>
		
        </tbody>
    </table>
</section>

EOT;
        return do_shortcode($out);
    }

    if ($atts['id'] == 6) {
        $out = <<<EOT

<section class="c-table">
    <table>
        <thead>
            <tr>
                <th>Broker</th>
                <th>Note</th>
                <th>Dépôt minimum</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/2019/09/ava-trade-300x200.png" alt="" class="alignnone size-full wp-image-115" width="143"/></td>
                <td data-title="Note">19 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">200$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/avatrade" target="_blank">COMMENCER A TRADER</a></td>
				
            </tr>
		
        </tbody>
    </table>
</section>

EOT;
        return do_shortcode($out);
    }

    if ($atts['id'] == 7) {
        $out = <<<EOT

<section class="c-table">
    <table>
        <thead>
            <tr>
                <th>Broker</th>
                <th>Note</th>
                <th>Dépôt minimum</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/alvexo.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">19 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">100$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/alvexobook" target="_blank">COMMENCER A TRADER</a></td>
            </tr>

			<tr>
                <td data-title=""><img src="/wp-content/uploads/table_broker/etoro.png" alt="" class="alignnone size-full wp-image-115" /></td>
                <td data-title="Note">13 / 20</td>
                <td data-title="Dépôt minimum"><div class="c-table-t1">200$</div></td>
                <td data-title=""><a class="btn-cta-2" href="/alvexobook" target="_blank">COMMENCER A TRADER</a></td>
            </tr>
			          
        </tbody>
    </table>
</section>

EOT;
        return do_shortcode($out);
    }
    return false;


});

add_action('init', function () {

    global $c_brend_logo_arr;

    $c_brend_logo_arr = array(
        'alvexo'            => '/wp-content/uploads/brend-logo/c-alvexo.png',
		'etoro'            => '/wp-content/uploads/brend-logo/c-etoro.png',
        'bdswiss'           => '/wp-content/uploads/brend-logo/c-bdswiss.png',
        'binance'           => '/wp-content/uploads/brend-logo/c-binance.png',
		'binck'           	=> '/wp-content/uploads/2020/05/binck-копия.jpg',
		'btc' 		=> '/wp-content/uploads/2020/05/Btcdirect.png',
		'lmax' => '/wp-content/uploads/2020/05/Lmax-logo-post.jpg',
		'lynx' => '/wp-content/uploads/2020/05/Без-названия-3.jpeg',
		'fxtm' => '/wp-content/uploads/2020/05/fxtm-otzyvy.jpg',
		'darwinex' => '/wp-content/uploads/2020/05/1-8-660x330.jpg',
		'pepperstone' => '/wp-content/uploads/2020/05/pepperstone-forex.jpg',
        'cmcmarkets'        => '/wp-content/uploads/brend-logo/c-cmcmarkets.png',
        'coinbase'          => '/wp-content/uploads/brend-logo/c-coinbase.png',
        'fxcm'              => '/wp-content/uploads/brend-logo/c-fxcm.png',
        'igmarkets'         => '/wp-content/uploads/brend-logo/c-igmarkets.png',
        'iqoption'          => '/wp-content/uploads/brend-logo/c-iqoption.png',
        'metatrader4'       => '/wp-content/uploads/brend-logo/c-metatrader4.png',
        'nfp'               => '/wp-content/uploads/brend-logo/c-nfp.png',
        'ufx'               => '/wp-content/uploads/brend-logo/c-ufx.png',
        'xtb'               => '/wp-content/uploads/brend-logo/c-xtb.png',
        'plus500'           => '/wp-content/uploads/brend-logo/c-plus500.png',
        'etxcapital'        => '/wp-content/uploads/brend-logo/c-etxcapital.png',
        'hycm'              => '/wp-content/uploads/brend-logo/c-hycm.png',
        'bitmex'            => '/wp-content/uploads/brend-logo/c-bitmex.png',
        'bitstamp'          => '/wp-content/uploads/brend-logo/c-bitstamp.png',
        'kraken'            => '/wp-content/uploads/brend-logo/c-kraken.png',
        'wirex'             => '/wp-content/uploads/brend-logo/c-wirex.png',
        'degiro'            => '/wp-content/uploads/brend-logo/c-degiro.png',
        'swissquote'        => '/wp-content/uploads/brend-logo/c-swissquote.png',
        'bittrex'           => '/wp-content/uploads/brend-logo/c-bittrex.png',
        'zulutrade'         => '/wp-content/uploads/brend-logo/c-zulutrade.png',
        'jfd'               => '/wp-content/uploads/brend-logo/c-jfd.png',
        'bitit'             => '/wp-content/uploads/brend-logo/c-bitit.png',
        'tradeo'            => '/wp-content/uploads/brend-logo/c-tradeo.png',
        'interativebrokers' => '/wp-content/uploads/brend-logo/c-interativebrokers.png',
        'yobit'             => '/wp-content/uploads/brend-logo/c-yobit.png',
        'xm'                => '/wp-content/uploads/brend-logo/c-xm.png',
        'vantagefx'         => '/wp-content/uploads/brend-logo/c-vantagefx.png',
        'hsbc'              => '/wp-content/uploads/brend-logo/c-hsbc.png',
		'easybourse' => '/wp-content/uploads/2020/05/000079675_624x337_c.jpg',
        'poloniex'          => '/wp-content/uploads/brend-logo/c-poloniex.png',
        'fbs'               => '/wp-content/uploads/brend-logo/c-fbs.png',
        'trading212'        => '/wp-content/uploads/brend-logo/c-trading212.png',
        'hitbtc'            => '/wp-content/uploads/brend-logo/c-hitbtc.png',
        'fortrade'          => '/wp-content/uploads/brend-logo/c-fortrade.png',
        'coinhouse'         => '/wp-content/uploads/brend-logo/c-coinhouse.png',
        'paymium'           => '/wp-content/uploads/brenёd-logo/c-paymium.png',
        'alpari'            => '/wp-content/uploads/brend-logo/c-alpari.png',
        'etherdelta'        => '/wp-content/uploads/brend-logo/c-etherdelta.png',
        'hotforex'          => '/wp-content/uploads/brend-logo/c-hotforex.png',
        'admiralmarkets'    => '/wp-content/uploads/brend-logo/c-admiralmarkets.png',
        'gkfx'              => '/wp-content/uploads/brend-logo/c-gkfx.png',
        'bullionvault'      => '/wp-content/uploads/brend-logo/c-bullionvault.png',
        'boursedirect'      => '/wp-content/uploads/brend-logo/c-boursedirect.png',
        'coinmama'          => '/wp-content/uploads/brend-logo/c-coinmama.png',
        'triomarkets'       => '/wp-content/uploads/brend-logo/c-triomarkets.png',
        'avatrade'          => '/wp-content/uploads/brend-logo/c-avatrade.png',
        'activtrades'       => '/wp-content/uploads/brend-logo/c-activtrades.png',
        'stockpair'         => '/wp-content/uploads/brend-logo/c-stockpair.png',
        'ironfx'            => '/wp-content/uploads/brend-logo/c-ironfx.png',
        'bitfinex'          => '/wp-content/uploads/brend-logo/c-bitfinex.png',
        'libertex'          => '/wp-content/uploads/brend-logo/c-libertex.png',
        'xtrade'            => '/wp-content/uploads/brend-logo/c-xtrade.png',
        'goldbroker'        => '/wp-content/uploads/brend-logo/c-goldbroker.png',
        'trade.com'         => '/wp-content/uploads/brend-logo/c-trade.com.png',
        'blockchain.info'   => '/wp-content/uploads/brend-logo/c-blockchain.info.png',
        'anyoption'         => '/wp-content/uploads/brend-logo/c-anyoption.png',
        'fxpro'             => '/wp-content/uploads/brend-logo/c-fxpro.png',
        'iforex'            => '/wp-content/uploads/brend-logo/c-iforex.png',
        'itrader.com'       => '/wp-content/uploads/brend-logo/c-itrader.com.png',
        'markets.com'       => '/wp-content/uploads/brend-logo/c-markets.com.png',
        'paxful'            => '/wp-content/uploads/brend-logo/c-paxful.png',
        'localbitcoins'     => '/wp-content/uploads/brend-logo/c-localbitcoins.png',
        'zebitcoin'         => '/wp-content/uploads/brend-logo/c-zebitcoin.png',
        'cex.io'            => '/wp-content/uploads/brend-logo/c-cex.io.png',
        'shapeshift'        => '/wp-content/uploads/brend-logo/c-shapeshift.png',


    );
});


add_action( 'init', function () { 

	global $c_brend_link_arr;

	$c_brend_link_arr = array(
		'alvexo' => '/2t9q',
		'etoro' => '/1x3g',
	);

	
} );

add_shortcode('c-top', function ($atts, $content = '') {

    $atts = shortcode_atts(array(
        'n' => 'empty',
        't' => 'empty',
    ), $atts);
if($atts['t']=="i"){
	$atts['t']='img';
}

if($atts['t']=="l"){
	$atts['t']='link';
}

if($atts['t']=="n"){
	$atts['t']='name';
}
	
	global $c_brend_logo_arr;

    $c_top_arr = array(
        '1' => array(
            'name' => 'Alvexo',
            'img' => $c_brend_logo_arr['alvexo'],
            'link' => '/alvexomain',
            'empty' => 'empty1',
        ),
        '2' => array(
            'name' => 'etoro',
            'img' =>  $c_brend_logo_arr['etoro'],
            'link' => '/pun3',
            'none' => 'empty2',
        ),
        '3' => array(
            'name' => '',
            'img' => '',
            'link' => '/alvexomain',
            'empty' => 'empty3',
        ),
        'empty' => array(
            'name' => 'empty4',
            'img' => 'empty4',
            'link' => 'empty4',
            'empty' => 'empty4',
        ),
    );

    return $c_top_arr[$atts['n']][$atts['t']];

});



add_shortcode( 'c-vs', function ($atts, $content='') {
if(! get_field('c-brend')){
	return;
}
	$c_goal_logo = do_shortcode('[c-goal name="broker-vs-logo"]');
	$c_goal_btn= do_shortcode('[c-goal name="broker-vs-btn"]');
	
	
	$c_broker_name_1 = do_shortcode('[c-broker-name-1]');
	$c_broker_img_1 = '/wp-content/uploads/brend-logo/c-alvexo.png';
	$c_broker_link_1 = '/realaccount';
	

	$c_brend_img = do_shortcode('[c-brend-img]');
	$c_brend_name = do_shortcode('[c-brend-name]');
	$c_brend_id = do_shortcode('[c-brend-id]');
	
	
	$out = <<<EOT
	
<section class="c-vs">
    <div class="c-vs-row">
        <div class="c-vs-col-1">
            <div class="c-vs-brend">
                <a class="table-vs-brand" href="$c_broker_link_1" rel="noopener noreferrer"
                   target="_blank" $c_goal_logo  id="pic-top1">
                    <img alt="$c_broker_name_1" src="$c_broker_img_1">

                </a>
            </div>
            <dl>
                <dt>Formation de trading</dt>
                <dd><span class="table-vs-positive">Au pointe	</span></dd>
            </dl>
            <dl>
                <dt>sur le podium</dt>
                <dd><span class="table-vs-positive">oui</span></dd>
            </dl>
            <dl>
                <dt>Spreads</dt>
                <dd><span class="table-vs-positive">Compétitifs</span></dd>
            </dl>
            <dl>
                <dt>service client</dt>
                <dd><span class="table-vs-positive">réactif</span></dd>
            </dl>
            <dl>
                <dt>Avis de nos lecteurs</dt>
                <dd><span class="table-vs-positive">Très positifs	</span></dd>
            </dl>

        </div>
        <div class="c-vs-col-2">
            <div class="c-vs-title">

                <div class="c-vs-title-brend">
                    <div class="table-vs-brand-title"></div>
                </div>

                <div class="c-vs-title-i">Formation de trading</div>
                <div class="c-vs-title-i">sur le podium</div>
                <div class="c-vs-title-i">Spreads</div>
                <div class="c-vs-title-i">service client</div>
                <div class="c-vs-title-i">Avis de nos lecteurs</div>

            </div>
        </div>
        <div class="c-vs-col-3">
            <div class="c-vs-brend"><a class="table-vs-brand" href="$c_broker_link_1"
                                       rel="noopener noreferrer" target="_blank"  $c_goal_logo id="pic-top1"><img alt="$c_brend_name" src="$c_brend_img"></a></div>

            <dl>
                <dt>Formation de trading</dt>
                <dd><span class="table-vs-neagative">Convenable</span></dd>
            </dl>
            <dl>
                <dt>sur le podium</dt>
                <dd><span class="table-vs-neagative">non</span></dd>
            </dl>
            <dl>
                <dt>Spreads</dt>
                <dd><span class="table-vs-neagative">Élevés</span></dd>
            </dl>
            <dl>
                <dt>service client</dt>
                <dd><span class="table-vs-neagative">jamais disponible</span></dd>
            </dl>
            <dl>
                <dt>Avis de nos lecteurs</dt>
                <dd><span class="table-vs-neagative">Moyens</span></dd>
            </dl>

        </div>
    </div>

    <div class="table-vs-spoiler-wrap">
        <div class="table-vs-spoiler">
            <span class="table-vs-spoiler-title  js-table-vs-spoiler-title open">Après un mois de test :</span>
            <div class="js-table-vs-spoiler-body" style="display: none;"><p>On vous conseille de rester bien éloigné de ce broker. On ne le recommande ni pour les traders débutants, ni pour les experts ! Ainsi, nous vous conseillons un courtier confirmé par l'expérience tel Etoro pour un trading rentable.
</p></div>
        </div>
    </div>

    <div class="btn-cta-single-wrap c-box-6-btn"><a class="c-box-6-btn" href="$c_broker_link_1" rel="nofollow"
                                        target="_blank" $c_goal_btn id="btn-top1">Tradez avec un courtier digne de ce nom
</a></div>

</section>
 
EOT;

	return $out;
} );

add_shortcode( 'c-brend-img', function ($atts, $content='') {
	
	global $c_brend_logo_arr;
	
	$out = strtolower (get_field('c-brend'));
	$out = str_replace(' ', '', $out);
	$out = $c_brend_logo_arr[$out];

	return $out;
} );

add_shortcode( 'c-brend-name', function ($atts, $content='') {
	return get_field('c-brend');
} );

add_shortcode( 'c-brend-id', function ($atts, $content='') {
	return get_field('id-brend');
} );

add_shortcode( 'c-brend-link', function ($atts, $content='') {
	
	global $c_brend_link_arr;

	$out = strtolower (get_field('c-brend'));
	$out = str_replace(' ', '', $out);
	$out = $c_brend_link_arr[$out];

	return $out;
} );

add_shortcode( 'c-broker-img-1', function ($atts, $content='') {
	return do_shortcode('[c-top n=1 t=img]');
} );

add_shortcode( 'c-broker-name-1', function ($atts, $content='') {
	return do_shortcode('[c-top n=1 t=name]');
} );

add_shortcode( 'c-broker-link-1', function ($atts, $content='') {
	return do_shortcode('[c-top n=1 t=link]');
} );







add_shortcode('c-post-before', function ($atts, $content = '') {
	if(is_single('XTB avis : Ce qu’il faut savoir ABSOLUMENT avant de s’inscrire')){ return;}
		else{

    return do_shortcode('[c-vs]');}
});

add_shortcode('c-box4', function ($atts, $content = '') {

	
	$c_goal_logo = do_shortcode('[c-goal name="broker-vs-logo"]');
	$c_goal_btn= do_shortcode('[c-goal name="broker-vs-btn"]');
	
	$c_brend_img = do_shortcode('[c-brend-img]');
	$c_brend_name = do_shortcode('[c-brend-name]');


$out = <<<EOT

<section class="c-box4">
    <div class="c-box4-row">
        <div class="c-box4-col-1">
            <div class="c-box4-block-head">

                <div class="c-box4-logo">
                    <img alt="" src="/wp-content/uploads/c-custom/brend-logo-forex/c-etoro.png">
                </div>

                <div>
                    <div class="c-box4-title">
                        Etoro
                    </div>

                    <div class="c-box4-rating">
                        <img alt="" src="/wp-content/uploads/c-custom/img/star-s2-1.png">
                    </div>

                    <div class="c-box4-btn">
                        <a href="#">En savoir +</a>
                    </div>
                </div>
		</div>

                <div class="c-box4-hr"></div>


                <div class="c-box4-dl">
                    <dl>
                        <dt>DÉPOT MINIMUM</dt>
                        <dd>50€</dd>
                    </dl>

                    <dl>
                        <dt>LEVIER</dt>
                        <dd>30:1</dd>
                    </dl>
                </div>

                <div class="c-box4-block-btn">

                    <div class="c-box4-btn-1">
                        <a href="#">OUVRIR UN COMPTE</a>
                    </div>

                    <div class="c-box4-t1">sur ETORO</div>
                </div>
            
        </div>
        <div class="c-box4-col-2">
            <section class="c-box4-avantages">
                <div class="c-box4-avantages-header"></div>
                <div class="c-box4-avantages__row">
                    <div class="c-box4-avantages__col">
                        <div class="c-box4-avantages-list c-box4-avantages-positive">
							  <span>
								Avantages
							  </span>
                            <ul>
                                <li>Élu Meilleur Broker</li>
                                <li>Meilleures Formations</li>
                                <li>Copy Trading</li>
                            </ul>
                        </div>
                    </div>
                    <div class="c-box4-avantages__col">
                        <div class="c-box4-avantages-list c-box4-avantages-negative">
							  <span>
								Inconvénients
							  </span>
                            <ul>
                                <li>Dépôt de 50€ minimum</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>


        </div>

    </div>
</section>


EOT;
    
    return $out;
});






/**
 * Генерирование рейтинга для записи
 * $post_id - Id записи;
 **/
function dvt_the_post_rating(int $post_id = null) {
    $count = 5;
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (true == get_field('hide_rating', $post_id)) {
        return;
    }
    
    // количество звездочек, рандом от "количество звезд - 1" до "количество звезд".    
    if (!$active = get_post_meta($post_id, 'rating_active', 1)) {
        $active = rand($count-.6, $count);
        update_post_meta($post_id, 'rating_active', $active); 
    }
    
    // количество проголосовавших, рандом от 40 до 60.
    if (!$voted = get_post_meta($post_id, 'rating_voted', 1)) {
        $voted = rand(40, 60);
        update_post_meta($post_id, 'rating_voted', $voted);
    }
    
    return print dvt_get_rating($voted, $active);
}  

/**
 * Генерирование рейтинга для терма
 * $term - терм;
 **/
function dvt_the_term_rating(int $term = null) {
    $count = 5;
    
    if (!$term) {
        $term = get_queried_object();
    }        
    
    if (true == get_field('hide_rating', $term)) {
        return;
    }
    
    // количество звездочек, рандом от "количество звезд - 1" до "количество звезд".    
    if (!$active = get_term_meta($term->term_id, 'rating_active', 1)) {
        $active = rand($count-1, $count);
        update_term_meta($term->term_id, 'rating_active', $active); 
    }
    
    // количество проголосовавших, рандом от 40 до 60.
    if (!$voted = get_term_meta($term->term_id, 'rating_voted', 1)) {
        $voted = rand(40, 60);
        update_term_meta($term->term_id, 'rating_voted', $voted);
    }
    
    return print dvt_get_rating($voted, $active);
}  

/**
 * Генерирование рейтинга
 * $voted - количество проголосовавших;
 * $active - количество активных звезд
 **/
function dvt_get_rating($voted, $active) {    
     $count = 5;        // количество звезд
     $show_text = true; // показать комментарий к рейтингу    
    
    // формирование звездочек
    for ($i = 1, $rating = ''; $i <= 5; $i++) {
        $active_class = $i <= $active ? ' active' : '';
        $rating .= '<span class="rating-star star-'.$i.$active_class.'"></span>';
    }
    
    $rating = '<div class="rating-stars">'.$rating.'</div>';
            
    // микроразметка
    $note  = '<meta itemprop="ratingValue" content="'.$active.'" />';
    $note .= '<meta itemprop="ratingCount" content="'.$voted.'" />';
    $note .= '<meta itemprop="bestRating" content="'.$count.'" />';
    $note .= '<meta itemprop="worstRating" content="1" />';
    $note .= '<meta itemprop="name" content="'.get_the_title().'" />';
	//$note .= '<div itemprop="itemReviewed" itemscope="" itemtype="http://schema.org/CreativeWork"></div>';
$note .= '<div itemprop="itemReviewed" itemscope="" itemtype="http://schema.org/Organization"><meta itemprop="name" content="'.get_field('c-brend').'" /></div>';


    if ($show_text) {
        $note .= '<div class="rating-note">Note: '.$voted.' votes</div>';
    }                                      
                
    $out = '<div class="wrapper-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">'.$rating.$note.'</div>';  

    return $out;    
}

/**
 * Remove HTML Filtering
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );


/**
 * Хлебные крошки
 */
function dvt_the_breadcrumbs(){            
    // общий шаблон
    $template = '
        <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a href="%s" itemprop="item">
                <span itemprop="name">%s</span>
            </a>
            <meta itemprop="position" content="%d" />
        </span>
        <span class="kb_sep">/</span>     
    ';
    
    // шаблон текущего элемента
    $template_current = '<span class="kb_title">%s</span>';
    
    // уровень вложенности
    $level = 0;
    
    // главная
    $out = sprintf(
        $template, 
        esc_url( home_url( '/' ) ), 
        'Home', 
        ++$level
    );     
    
    if (is_singular()) {
        // крошки для одиночной записи
        global $post;
        
        if ($post->post_parent) {
            // родительские страницы
            $post_ancestors = get_post_ancestors( $post->ID );
            
            $parents = array_reverse($post_ancestors);
            
            foreach ($parents as $parent) {
                $out .= sprintf(
                    $template, 
                    get_permalink($parent), 
                    get_the_title($parent),
                    ++$level
                );
            }             
        } elseif (is_singular('post')) {
            if ($terms = get_the_terms($post->ID, 'category')) {
                // термы записи
                foreach ($terms as $term) {
                    $out .= sprintf(
                        $template, 
                        get_term_link($term, $term->taxonomy), 
                        $term->name,
                        ++$level
                    );
                }             
            }             
        } elseif (is_singular('blog')) {
            $out .= sprintf(
                $template, 
                get_permalink(282), 
                get_the_title(282),
                ++$level
            );            
        } elseif (is_singular('promotion')) {
            $out .= sprintf(
                $template, 
                get_permalink(242), 
                get_the_title(242),
                ++$level
            );            
        }                                  
        
        // текущий элемент
        $out .= sprintf($template_current, $post->post_title);
    } elseif (is_category()) {
        $term = get_queried_object();        
        $out .= sprintf($template_current, $term->name);       
    } elseif (is_post_type_archive()) {
        $q = get_queried_object();
        $title = isset($q->labels->breadcrumb) ? $q->labels->breadcrumb : $q->label;
        $out .= sprintf($template_current, $title);              
    } elseif (is_search()) {
        $out .= sprintf($template_current, 'Search on site'); 
    } elseif (is_404()) {
        $out .= sprintf($template_current, 'Nothing found');
    }
    
    $out = '<div class="main-bread"><div class="breadcrumbs container" itemscope="" itemtype="http://schema.org/BreadcrumbList">' . $out . '</div></div>';   
    
    return print $out;     
}
/**
 * Шорткод вывода кнопки
**/
function dvt_shortcode_button($atts, $content = '') {     
	$atts = shortcode_atts(array(
		'caption' => '',
		'link' => '#',
        'class' => '',
		'id' => '',
	), $atts);    
    
    // результат шорткода
    return '<a rel="nofollow" href="'.$atts['link'].'" id="'.$atts['id'].'" class="button '.$atts['class'].'" target="_blank">'.$atts['caption'].'</a>';
}
add_shortcode('button', 'dvt_shortcode_button');

/**
 * Шорткод вывода графика
**/
function dvt_shortcode_trading_view_function() {
    ob_start();
    dvt_the_chart();
    $content = ob_get_clean();
    ob_end_flush();
    
    return $content;
}

add_shortcode('trading_view', 'dvt_shortcode_trading_view_function'); 


function tablec_post( $atts ){
    ob_start();
    if (get_field('check_table_title_post')[0] == '1') { ?>
<div class="table_title">
  <? the_field('title_table_post') ?>
</div>
<? } 
    $rows = get_field('table-avis_post'); if($rows) { ?>
<div class="top_avisic1 myc1">
  <?php $it = 0; $a=0; foreach($rows as $row) { $it++; ?>
  <div class="navjf">
    <div class="top_avis_line1">
      <div class="top_avis_row1">
        <div><?php echo $a+1; ?></div>
      </div>
      <div class="top_avis_row1">
        <?php if($row['checklinka_post'][0] == '1'){ ?> <img src="<?php echo $row['img_avis_post']; ?>" alt="">
        <? } else { ?>
        <a href="<?php echo $row['href_button_avis_post']; ?>" id="<?php echo $row['id']; ?>">
          <img src="<?php echo $row['img_avis_post']; ?>" alt="">
        </a>
        <? } ?>
        <a href="<?php echo $row['name_href_avis_post']; ?>"><?php echo $row['name_avis_post']; ?></a>
      </div>

      <div class="top_avis_row1">
        <div>
          <div class="oneacv1">
            <img src="/wp-content/uploads/2021/01/Mask-Group-2.png">
            <span> <?php echo $row['min_depositv_post']; ?>
              <div>min. deposit</div>
            </span>
          </div>
          <div class="oneacv1">
            <img src="/wp-content/uploads/2021/01/Mask-Group-1.png">
            <span> <?php echo $row['levier_post']; ?>
              <div>
                levier
              </div>
            </span>
          </div>
        </div>


      </div>


      <div class="top_avis_row1">
        <span><img src="/wp-content/uploads/2021/01/icons8-star-filled-50-1-2.png" alt=""><span
            class="bolfa1"><?php echo $row['notre_note_post']; ?></span>/20</span>
      </div>
      <?php if($row['checkpositive_post'][0] == '1'){ ?>
      <div class="top_avis_row1">
        <a href="<?php echo $row['href_button_avis_post']; ?>" id="<?php echo $row['id']; ?>" class="button">VISITEZ</a>
      </div>
      <?php } ?>

    </div>
    <p class="podavji">
      <?php echo $row['textbotm_post']; ?>
    </p>
  </div>
  <?php $a+=1; } ?>
</div>
<?php }
    $myvariable = ob_get_clean();
    return $myvariable;
}
 
add_shortcode( 'tablec_post', 'tablec_post' );

/*
add_shortcode('button-cta-2', function ($atts, $content = '') {

    return do_shortcode('[c-vs]');
});*/


add_action( 'wp_print_styles', 'dequeue_fonts_style' );
function dequeue_fonts_style() {
      wp_dequeue_style( 'mailpoet_custom_fonts_css-css' );
}

function faqpost($atts, $content = NULL)
{
    ob_start(); 
    
        $rows = get_field('faqpost'); if($rows) { ?>
<h2>Questions fréquentes</h2>

<?php $a=0; foreach($rows as $row) { ?>
<div class="sc_fs_faq sc_card">
  <div class="faqh2">

    <?php echo $row['faqpost1']; ?>

    <div class="faqp">
      <?php echo $row['faqpost2']; ?>
    </div>
  </div>
</div>

<?php $a+=1; } ?>


<?php }
        
        
    
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('faqpost', 'faqpost');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

if( function_exists('acf_add_options2_page') ) {
	
	acf_add_options2_page();
	
}


/*
Горизонтальный ТОП begin
*/

function horizontal_top($atts, $content = NULL)
{
    ob_start(); 
    ?>
<div class="div-h-g">
  <div class="row-w-name">
    <a href="javascript:void(0);" class="forex-a active-a" id="forex-a">FOREX</a>
    <a href="javascript:void(0);" class="crypto-a" id="crypto-a">CRYPTO</a>
    <a href="javascript:void(0);" class="actions-a" id="actions-a">ACTIONS</a>
  </div>

  <? $rows = get_field('forex_hor','options'); if($rows) { ?>
  <div class="horizont_t t_forex dispflex">
    <? if($a=0) ?>
    <?php $a=0; foreach($rows as $row) { ?>

    <div class="uno_hor">
      <? if($a==2) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal.png">
      <? }
				  						elseif($a==1) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-1.png">
      <? }
				  						elseif($a==3) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-2.png">
      <? } ?>
      <div class="uno_img">
        <a href="<?php echo $row['url']; ?>" id="<?php echo $row['id']; ?>"><img src="<?php echo $row['img']; ?>"> </a>
      </div>
      <div class="uno_down">
        <div><img src="<?
							if($row['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
        <div><a href="<?php echo $row['href']; ?>">En savoir plus</a></div>
      </div>
    </div>


    <?php $a+=1; } ?>
  </div>

  <?php }
        
          $rows1 = get_field('action_hor','options'); if($rows1) { ?>
  <div class="horizont_t t_action">
    <?php $a1=0; foreach($rows1 as $row1) { ?>
    <div class="uno_hor">
      <? if($a1==2) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal.png">
      <? }
				  						elseif($a1==1) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-1.png">
      <? }
				  						elseif($a1==3) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-2.png">
      <? } ?>
      <div class="uno_img">
        <a href="<?php echo $row1['url']; ?>" id="<?php echo $row1['id']; ?>"><img src="<?php echo $row1['img']; ?>">
        </a>
      </div>
      <div class="uno_down">
        <div><img src="<?
							if($row1['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row1['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row1['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row1['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row1['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
        <div><a href="<?php echo $row1['href']; ?>">En savoir plus</a></div>
      </div>
    </div>


    <?php $a1+=1; } ?>
  </div>

  <?php }
	
	 $rows2 = get_field('crypto_hor','options'); if($rows2) { ?>
  <div class="horizont_t t_crypto">
    <?php $a2=0; foreach($rows2 as $row2) { ?>
    <div class="uno_hor">
      <? if($a2==2) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal.png">
      <? }
				  						elseif($a2==1) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-1.png">
      <? }
				  						elseif($a2==3) { ?> <img class="medal-i" src="/wp-content/uploads/2021/07/medal-2.png">
      <? } ?>
      <div class="uno_img">
        <a href="<?php echo $row2['url']; ?>" id="<?php echo $row2['id']; ?>"><img src="<?php echo $row2['img']; ?>">
        </a>
      </div>
      <div class="uno_down">
        <div><img src="<?
							if($row2['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row2['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row2['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row2['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row2['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
        <div><a href="<?php echo $row2['href']; ?>">En savoir plus</a></div>
      </div>
    </div>


    <?php $a2+=1; } ?>
  </div>
</div>

<?php }
    
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('horizontal_top', 'horizontal_top');

/*
Горизонтальный блок end
*/

add_shortcode( 'notreblock_new', 'notreblock_new' );
function notreblock_new( $atts, $content ) {
	return '
	<div class="notre_global">
	<div class="notreblock">
	<div class="fir-notre"><span>'.$atts['zag'].'</span></div>
	<div class="sec-notre"><span>'. $content .'</span></div>
	</div>
	<div class="notre_block_2">
	<span>'.$atts['zag2'].'</span>
	<img src="'.$atts['img'].'">
	</div>
	</div>
	';
} 

add_shortcode( 'notreblock_full', 'notreblock_full' );
function notreblock_full( $atts, $content ) {
	return '
	<div class="notreblock notre_full">
	<div class="fir-notre"><span>'.$atts['zag'].'</span></div>
	<div class="sec-notre"><span>'. $content .'</span></div>
	</div>
	';
} 

add_shortcode( 'btn_monet', 'btn_monet' );
function btn_monet( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-1.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_monet_2', 'btn_monet_2' );
function btn_monet_2( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-2.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_monet_3', 'btn_monet_3' );
function btn_monet_3( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-3.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_monet_4', 'btn_monet_4' );
function btn_monet_4( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-4.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_monet_5', 'btn_monet_5' );
function btn_monet_5( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-5.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_monet_6', 'btn_monet_6' );
function btn_monet_6( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/Ellipse-26.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_ouvrir', 'btn_ouvrir' );
function btn_ouvrir( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/work-from-home-1.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_ins', 'btn_ins' );
function btn_ins( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/ssadasd.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_rocket', 'btn_rocket' );
function btn_rocket( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/rockett.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_proc', 'btn_proc' );
function btn_proc( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/proccc.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_perf', 'btn_perf' );
function btn_perf( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer"> <img src="/wp-content/uploads/2021/07/cryptocurrency-1-1-6.png" id="'.$atts['id'].'"> '. $content . '</a></div>'; 
} 

add_shortcode( 'btn_simple', 'btn_simple' );
function btn_simple( $atts, $content ) {
	
	 return '<div class="div-monet"><a class="btn-monet" href="'.$atts['url'].'" target="_blank" id="'.$atts['id'].'" rel="noopener noreferrer" id="'.$atts['id'].'">'. $content . '</a></div>'; 
} 

function faqqnew($atts, $content = NULL)
{
    ob_start(); 
    ?>

<? $rows = get_field('faqpost'); if($rows) { ?>
<div class="faqs_bg">
  <div class="wrap">
    <div class="faqs">
      <div class="faqs_t">FAQ</div>
      <?php foreach($rows as $row) { ?>
      <div class="faq">
        <div class="faq_t"><span><?php echo $row['faqpost1']; ?></span></div>
        <div class="faq_e"><?php echo $row['faqpost2']; ?></div>
      </div>
      <?php } ?>
    </div>

  </div>
</div>
<?php }  
    
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('faqqnew', 'faqqnew');


function horizontal_top_tabl($atts, $content = NULL)
{
    ob_start(); 
    ?>
<div class="div-h-g-s">
  <div class="row-w-name-s">
    <a href="javascript:void(0);" class="forex-a-s active-a-s" id="forex-a-s" onclick="forexa-s()">Débutant</a>
    <a href="javascript:void(0);" class="actions-a-s" id="actions-a-s" onclick="actions-s()">Expérimenté</a>
    <a href="javascript:void(0);" class="crypto-a-s" id="crypto-a-s" onclick="creptoa-s()">Professionnel</a>

  </div>
  <?
        $rows = get_field('forex_hor-s','options'); if($rows) { ?>
  <div class="horizont_t-s t_forex-s dispflex-s">
    <? if($a=0) ?>
    <?php $a=0; foreach($rows as $row) { ?>
	  <?php if ($row['name'] == 'XTB') continue; ?>
    <a href="<?php echo $row['url']; ?>" id="<?php echo $row['id']; ?>">
      <div class="uno_hor-s  <? if($row['name'] == 'Alvexo') echo 'uno_hor-s_top' ?>" id="<?php echo $row['id']; ?>">
        <div class="fwq-and-f-s" id="<?php echo $row['id']; ?>">


          <div class="uno_img-s" id="<?php echo $row['id']; ?>">
            <img src="<?php echo $row['img']; ?>" id="<?php echo $row['id']; ?>">
          </div>
          <div class="uno_down-s" id="<?php echo $row['id']; ?>">
            <div id="<?php echo $row['id']; ?>">
              <span id="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></span>
              <? if($row['name'] == 'Alvexo') { ?> <span class="top_label-s" id="<?php echo $row['id']; ?>">TOP</span>
              <? } ?>
            </div>
            <div id="<?php echo $row['id']; ?>"><img id="<?php echo $row['id']; ?>" src="<?
							if($row['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
            <div id="<?php echo $row['id']; ?>"></div>
          </div>
          <div id="<?php echo $row['id']; ?>" class="btn_a_fw-s">
            <span id="<?php echo $row['id']; ?>" class="button-mib-tabl-s"><?php echo $row['siteoravis']; ?></span>
          </div>
        </div>
        <div id="<?php echo $row['id']; ?>" class="ul_done_li-s">
          <?php echo $row['ul_done']; ?>
        </div>
      </div>

    </a>
    <?php $a+=1; } ?>
  </div>

  <?php }
        
          $rows1 = get_field('action_hor-s','options'); if($rows1) { ?>
  <div class="horizont_t-s t_action-s">
    <?php $a1=0; foreach($rows1 as $row1) { ?>
	  <?php if ($row1['name'] == 'XTB') continue; ?>
    <a id="<?php echo $row1['id']; ?>" href="<?php echo $row1['url']; ?>">
      <div id="<?php echo $row1['id']; ?>" class="uno_hor-s <? if($row1['name'] == 'Alvexo') echo 'uno_hor-s_top' ?>">
        <div id="<?php echo $row1['id']; ?>" class="fwq-and-f-s">


          <div id="<?php echo $row1['id']; ?>" class="uno_img-s">
            <img id="<?php echo $row1['id']; ?>" src="<?php echo $row1['img']; ?>">
          </div>
          <div id="<?php echo $row1['id']; ?>" class="uno_down-s">
            <div id="<?php echo $row1['id']; ?>">
              <span id="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></span>
              <? if($row1['name'] == 'Alvexo') { ?> <span class="top_label-s">TOP</span>
              <? } ?>
            </div>
            <div id="<?php echo $row1['id']; ?>"><img id="<?php echo $row1['id']; ?>" src="<?
							if($row1['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row1['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row1['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row1['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row1['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
            <div id="<?php echo $row1['id']; ?>"></div>
          </div>
          <div id="<?php echo $row1['id']; ?>" class="btn_a_fw-s">
            <span id="<?php echo $row1['id']; ?>" class="button-mib-tabl-s"><?php echo $row1['siteoravis']; ?></span>
          </div>
        </div>
        <div id="<?php echo $row1['id']; ?>" class="ul_done_li-s">
          <?php echo $row1['ul_done']; ?>
        </div>
      </div>

    </a>
    <?php $a1+=1; } ?>
  </div>

  <?php }
	
	 $rows2 = get_field('crypto_hor-s','options'); if($rows2) { ?>
  <div class="horizont_t-s t_crypto-s">
    <?php $a2=0; foreach($rows2 as $row2) { ?>
	  <?php if ($row2['name'] == 'XTB') continue; ?>
    <a id="<?php echo $row2['id']; ?>" href="<?php echo $row2['url']; ?>">
      <div id="<?php echo $row2['id']; ?>" class="uno_hor-s <? if($row2['name'] == 'Alvexo') echo 'uno_hor-s_top' ?>">
        <div id="<?php echo $row2['id']; ?>" class="fwq-and-f-s">


          <div id="<?php echo $row2['id']; ?>" class="uno_img-s">
            <img id="<?php echo $row2['id']; ?>" src="<?php echo $row2['img']; ?>">
          </div>
          <div id="<?php echo $row2['id']; ?>" class="uno_down-s">
            <div id="<?php echo $row2['id']; ?>">
              <span id="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></span>
              <? if($row2['name'] == 'Alvexo') { ?> <span id="<?php echo $row2['id']; ?>" class="top_label-s">TOP</span>
              <? } ?>
            </div>
            <div id="<?php echo $row2['id']; ?>"><img id="<?php echo $row2['id']; ?>" src="<?
							if($row2['star'] == '5'){ echo '/wp-content/uploads/2021/07/star-5.png'; }
							if($row2['star'] == '4'){ echo '/wp-content/uploads/2021/07/star-4.png'; }
							if($row2['star'] == '3'){ echo '/wp-content/uploads/2021/07/star3.png'; }
							if($row2['star'] == '2'){ echo '/wp-content/uploads/2021/07/star2.png'; }
							if($row2['star'] == '1'){ echo '/wp-content/uploads/2021/07/star1.png'; }
							  ?>"></div>
            <div id="<?php echo $row2['id']; ?>"></div>
          </div>
          <div id="<?php echo $row2['id']; ?>" class="btn_a_fw-s">
            <span id="<?php echo $row2['id']; ?>" class="button-mib-tabl-s"><?php echo $row2['siteoravis']; ?></span>
          </div>
        </div>
        <div id="<?php echo $row2['id']; ?>" class="ul_done_li-s">
          <?php echo $row2['ul_done']; ?>
        </div>
      </div>

    </a>
    <?php $a2+=1; } ?>
  </div>
</div>



<?php }
    ?> <style>
.div-h-g-s {
  display: none;
}

.horizont_t-s {
  display: none !important;
}

.dispflex-s.horizont_t-s {
  display: flex !important;
}

@media(max-width:768px) {
  .div-h-g-s {
    display: block;
  }

  .row-w-name-s {
    display: flex !important;
    background: #F2F4F6;
    text-align: center;
    padding: 5px;
    border-radius: 8px;
  }

  .row-w-name-s a {
    padding: 5px;
    border-radius: 5px;
    color: #000;
    width: 33%;
    margin-right: 3%;
    display: block;
  }

  .row-w-name-s a:nth-child(3) {
    margin-right: 0;
  }

  .row-w-name-s a.active-a-s {
    background: #fff;
    color: #000;
    text-decoration: none;

  }

  .horizont_t-s.dispflex-s {
    display: flex;
  }

  .horizont_t-s {
    flex-direction: column;
  }

  div.horizont_t-s div.uno_hor-s {
    display: flex;
    flex-direction: column;
    padding: 10px;
    margin-top: 5px !important;
    margin-bottom: 5px !important;
    background: #FFFFFF;
    box-shadow: 0px 0px 6px rgb(0 0 0 / 9%);
    border-radius: 8px;
  }

  .horizont_t-s {
    padding: 5px;
  }

  .uno_hor-s_top {
    border: 3px solid #4DEC5D;
  }

  .ul_done_li-s ul {
    margin-bottom: 0 !important;
  }

  .fwq-and-f-s {
    min-width: 60px;
    display: flex;
    margin-bottom: 10px;
  }

  .uno_down-s div:first-child {
    margin-bottom: 5px;
  }

  .uno_img-s {
    width: 18%;
    margin-right: 4%;
  }

  .uno_down-s {
    width: 50%;
  }

  .btn_a_fw-s {
    width: 24%;
  }

  .ul_done_li-s ul li:before {
    display: none;
  }

  .ul_done_li-s ul li {
    background-size: 10px 8px !important;
    background-position-y: 8px !important;
    padding-left: 22px;
    margin: 0;
    list-style: none;
    background: url('https://www.digitalbusiness.fr/wp-content/uploads/2021/07/Vector-577.png') no-repeat 0 0;
    line-height: 1.5rem;
  }

  .uno_down-s div:first-child {
    display: flex;
    align-items: center;
  }

  .uno_down-s div:first-child span:nth-child(2) {
    margin-left: 10px;
  }

  .top_label-s {
    background: #000;
    padding: 3px 10px;
    font-size: 11px !important;
    color: #fff !important;
    border-radius: 5px;
  }

  .btn_a_fw-s {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .btn_a_fw-s span {
    padding: 5px;
    background: #c30505;
    color: #fff;
    width: 100%;
    text-align: center;
    border-radius: 5px;
  }

  .uno_down-s div:first-child span {
    color: #000;
    font-size: 19px;
    font-weight: 600;
  }

}

.new-type-of-f-b-s img {
  max-width: 120px;
}

.div-simple-s {
  margin-top: 15px;
}

.spec-ul-s li:before {
  display: none !important;
}

.spec-ul li {
  list-style: none;
  background: url('https://www.digitalbusiness.fr/wp-content/uploads/2021/01/image2.png') no-repeat 0 0;
  background-size: 10px 10px;
  line-height: 2rem;
  padding-left: 20px;
  background-position-y: 10px;
}
</style>

<script>
jQuery(function($) {
  $('.forex-a-s').on('click', function() {
    $('.t_forex-s ').addClass("dispflex-s");
    $('.t_action-s ').removeClass("dispflex-s");
    $('.t_crypto-s ').removeClass("dispflex-s");
    $('.forex-a-s').addClass("active-a-s");
    $('.crypto-a-s').removeClass("active-a-s");
    $('.actions-a-s').removeClass("active-a-s");
  });

  $('.crypto-a-s').on('click', function() {
    $('.t_forex-s ').removeClass("dispflex-s");
    $('.t_action-s ').removeClass("dispflex-s");
    $('.t_crypto-s ').addClass("dispflex-s");
    $('.forex-a-s').removeClass("active-a-s");
    $('.crypto-a-s').addClass("active-a-s");
    $('.actions-a-s').removeClass("active-a-s");
  });

  $('.actions-a-s').on('click', function() {
    $('.t_forex-s ').removeClass("dispflex-s");
    $('.t_action-s ').addClass("dispflex-s");
    $('.t_crypto-s ').removeClass("dispflex-s");
    $('.forex-a-s').removeClass("active-a-s");
    $('.crypto-a-s').removeClass("active-a-s");
    $('.actions-a-s').addClass("active-a-s");
  });
})
</script>
<script>
function forexa() {
  $('.t_forex-s ').addClass("dispflex-s");
  $('.t_action-s ').removeClass("dispflex-s");
  $('.t_crypto-s ').removeClass("dispflex-s");
  $('.forex-a-s').addClass("active-a-s");
  $('.crypto-a-s').removeClass("active-a-s");
  $('.actions-a-s').removeClass("active-a-s");
}

function creptoa() {
  $('.t_forex-s ').removeClass("dispflex-s");
  $('.t_action-s ').removeClass("dispflex-s");
  $('.t_crypto-s ').addClass("dispflex-s");
  $('.forex-a-s').removeClass("active-a-s");
  $('.crypto-a-s').addClass("active-a-s");
  $('.actions-a-s').removeClass("active-a-s");
}

function actions() {
  $('.t_forex-s ').removeClass("dispflex-s");
  $('.t_action-s ').addClass("dispflex-s");
  $('.t_crypto-s ').removeClass("dispflex-s");
  $('.forex-a-s').removeClass("active-a-s");
  $('.crypto-a-s').removeClass("active-a-s");
  $('.actions-a-s').addClass("active-a-s");
}
</script>
<?
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('horizontal_top_tabl', 'horizontal_top_tabl');

// Новый блок ПК версии
add_shortcode('newblockpc', 'newblockpc');
function newblockpc($atts, $content = NULL)
{
	ob_start(); 
	?>
        <div class="newblockpc">
			<div class="newblockpc-title">
				Choisissez un courtier correspondant à votre niveau
			</div>
          <div class="newblockpc-w-name">
            <a href="javascript:void(0);" class="forex-pc-1-1 active-a" id="categ-beginner" onclick="forexa()">Débutant</a>
            <a href="javascript:void(0);" class="forex-pc-1-2" id="categ-experimented" onclick="actions()">Expérimenté</a>
            <a href="javascript:void(0);" class="forex-pc-1-3" id="categ-professional" onclick="creptoa()">Professionnel</a>
          </div>
          <? $rows = get_field('forex_pc','options'); if($rows) { ?>
          <div class="newblockpc_t t_forex_1 dispflex">
            <?php $a=0; foreach($rows as $row) { ?>
			  <?php if ($row['name'] == 'XTB') continue; ?>
            <a href="<?php echo $row['url']; ?>" id="<?php echo $row['id']; ?>">
              <div class="uno_hor <? if($row['name'] == 'Alvexo') echo 'uno_hor_top'; ?>" id="<?php echo $row['id']; ?>">
                <div class="newblockpc-card-top">
                  <div class="fwq-and-f" id="<?php echo $row['id']; ?>">
                    <div class="uno_img" id="<?php echo $row['id']; ?>">
                      <img src="<?php echo $row['img']; ?>" id="<?php echo $row['id']; ?>">
                    </div>
                    <div class="uno_down" id="<?php echo $row['id']; ?>">
                      <div id="<?php echo $row['id']; ?>">
                        <span class="uno_down_title" id="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></span>
                        <? if($row['name'] == 'Alvexo') { ?> <span class="top_label" id="<?php echo $row['id']; ?>">TOP</span>
                        <? } ?>
                      </div>
                      <div id="<?php echo $row['id']; ?>"><img id="<?php echo $row['id']; ?>" src="<?
							        if($row['star'] == '5'){ echo '/wp-content/uploads/2021/08/starrr5.png'; }
							        if($row['star'] == '4'){ echo '/wp-content/uploads/2021/08/starrr4.png'; }
							        if($row['star'] == '3'){ echo '/wp-content/uploads/2021/08/starrr3.png'; }
							        if($row['star'] == '2'){ echo '/wp-content/uploads/2021/08/starrr2.png'; }
							        if($row['star'] == '1'){ echo '/wp-content/uploads/2021/08/starrr1.png'; }
							      ?>"></div>
                      <div id="<?php echo $row['id']; ?>"></div>
                    </div>

                  </div>
                  <div class="ul_done_li" id="<?php echo $row['id']; ?>">
                    <?php echo $row['ul_done']; ?>
                  </div>
                </div>
                <div class="btn_a_fw" id="<?php echo $row['id']; ?>">
                  <span class="button-mib-tabl" id="<?php echo $row['id']; ?>"><?php echo $row['siteoravis']; ?></span>
                </div>
              </div>
            </a>
            <?php $a+=1; } ?>
          </div>

          <?php }
        
          $rows1 = get_field('action_pc','options'); if($rows1) { ?>
          <div class="newblockpc_t t_action_1">
            <?php $a1=0; foreach($rows1 as $row1) { ?>
			  <?php if ($row1['name'] == 'XTB') continue; ?>
            <a href="<?php echo $row1['url']; ?>" id="<?php echo $row1['id']; ?>">
              <div class="uno_hor <? if($row1['name'] == 'Alvexo') echo 'uno_hor_top'; ?>" id="<?php echo $row1['id']; ?>">
                <div class="newblockpc-card-top">
                  <div class="fwq-and-f" id="<?php echo $row1['id']; ?>">
                    <div class="uno_img" id="<?php echo $row1['id']; ?>">
                      <img src="<?php echo $row1['img']; ?>" id="<?php echo $row1['id']; ?>">
                    </div>
                    <div class="uno_down" id="<?php echo $row1['id']; ?>">
                      <div id="<?php echo $row1['id']; ?>">
                        <span class="uno_down_title" id="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></span>
                        <? if($row1['name'] == 'Alvexo') { ?> <span class="top_label" id="<?php echo $row1['id']; ?>">TOP</span>
                        <? } ?>
                      </div>
                      <div id="<?php echo $row1['id']; ?>"><img id="<?php echo $row1['id']; ?>" src="<?
							        if($row1['star'] == '5'){ echo '/wp-content/uploads/2021/08/starrr5.png'; }
							        if($row1['star'] == '4'){ echo '/wp-content/uploads/2021/08/starrr4.png'; }
							        if($row1['star'] == '3'){ echo '/wp-content/uploads/2021/08/starrr3.png'; }
							        if($row1['star'] == '2'){ echo '/wp-content/uploads/2021/08/starrr2.png'; }
							        if($row1['star'] == '1'){ echo '/wp-content/uploads/2021/08/starrr1.png'; }
							      ?>"></div>
                      <div id="<?php echo $row1['id']; ?>"></div>
                    </div>

                  </div>
                  <div class="ul_done_li" id="<?php echo $row1['id']; ?>">
                    <?php echo $row1['ul_done']; ?>
                  </div>
                </div>
                <div class="btn_a_fw" id="<?php echo $row1['id']; ?>">
                  <span class="button-mib-tabl"
                    id="<?php echo $row1['id']; ?>"><?php echo $row1['siteoravis']; ?></span>
                </div>
              </div>
            </a>
            <?php $a1+=1; } ?>
          </div>

          <?php }
	
	 $rows2 = get_field('crypto_pc','options'); if($rows2) { ?>
          <div class="newblockpc_t t_crypto_1">
            <?php $a2=0; foreach($rows2 as $row2) { ?>
			  <?php if ($row2['name'] == 'XTB') continue; ?>
            <a href=" <?php echo $row2['url']; ?>" id="<?php echo $row2['id']; ?>">
              <div class="uno_hor <? if($row2['name'] == 'Alvexo') echo 'uno_hor_top'; ?> " id="<?php echo $row2['id']; ?>">
                <div class="newblockpc-card-top">
                  <div class="fwq-and-f" id="<?php echo $row2['id']; ?>">
                    <div class="uno_img" id="<?php echo $row2['id']; ?>">
                      <img src="<?php echo $row2['img']; ?>" id="<?php echo $row2['id']; ?>">
                    </div>
                    <div class="uno_down" id="<?php echo $row2['id']; ?>">
                      <div id="<?php echo $row2['id']; ?>">
                        <span class="uno_down_title" id="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></span>
                        <? if($row2['name'] == 'Alvexo') { ?> <span class="top_label" id="<?php echo $row2['id']; ?>">TOP</span>
                        <? } ?>
                      </div>
                      <div id="<?php echo $row2['id']; ?>"><img id="<?php echo $row2['id']; ?>" src="<?
							        if($row2['star'] == '5'){ echo '/wp-content/uploads/2021/08/starrr5.png'; }
							        if($row2['star'] == '4'){ echo '/wp-content/uploads/2021/08/starrr4.png'; }
							        if($row2['star'] == '3'){ echo '/wp-content/uploads/2021/08/starrr3.png'; }
							        if($row2['star'] == '2'){ echo '/wp-content/uploads/2021/08/starrr2.png'; }
							        if($row2['star'] == '1'){ echo '/wp-content/uploads/2021/08/starrr1.png'; }
							      ?>"></div>
                      <div id="<?php echo $row2['id']; ?>"></div>
                    </div>

                  </div>
                  <div class="ul_done_li" id="<?php echo $row2['id']; ?>">
                    <?php echo $row2['ul_done']; ?>
                  </div>
                </div>
                <div class="btn_a_fw" id="<?php echo $row2['id']; ?>">
                  <span class="button-mib-tabl"
                    id="<?php echo $row2['id']; ?>"><?php echo $row2['siteoravis']; ?></span>
                </div>
              </div>
            </a>
            <?php $a2+=1; } ?>
          </div>



          <?php }
    ?> <style>
          .newblockpc {
            display: block;
            margin-bottom: 40px;
            color: #171717;
          }
			
			.newblockpc-title {
				margin-bottom: 20px;
				width: 50%;
				font-weight: bold;
				font-size: 40px;
			}

          .newblockpc .newblockpc-w-name {
            display: flex;
            width: 50%;
            background: #f2f4f6;
            text-align: center;
            padding: 5px;
            border-radius: 8px;
			margin-bottom: 30px;
          }

          .newblockpc .newblockpc-w-name a {
            padding: 5px;
            border-radius: 5px;
            color: #000;
            width: 33%;
            margin-right: 3%;
            display: block;
          }

          .newblockpc .newblockpc-w-name a:nth-child(3) {
            margin-right: 0;
          }

          .newblockpc .newblockpc-w-name a.active-a {
            background: #fff;
            color: #000;
            text-decoration: none;
          }

          .newblockpc .newblockpc-w-name a.active-a {
            background: #fff;
            color: #000;
            text-decoration: none;
          }

          .newblockpc .newblockpc_t.dispflex {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
          }

          .newblockpc .newblockpc_t {
            /* flex-direction: row;
          margin-right: 10px; */
            display: none;
          }

          .newblockpc div.newblockpc_t div.uno_hor {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
            margin-top: 5px !important;
            margin-bottom: 5px !important;
            height: 100%;
            background: #FFFFFF;
            box-shadow: 0px 0px 6px rgb(0 0 0 / 9%);
            border-radius: 8px;
          }

          .newblockpc-card-top {
            display: flex;
            flex-direction: column;
          }


          .newblockpc .newblockpc_t {
            padding: 5px;
            margin-bottom: 15px;
          }

          .newblockpc .newblockpc_t .uno_hor_top {
            border: 3px solid #4DEC5D;
          }

          .newblockpc .fwq-and-f {
            min-width: 60px;
			display: -webkit-box; /* OLD - iOS 6-, Safari 3.1-6 */
  			display: -moz-box; /* OLD - Firefox 19- (buggy but mostly works) */
  			display: -ms-flexbox; /* TWEENER - IE 10 */
  			display: -webkit-flex;
            display: flex;
            margin-bottom: 10px;
			-webkit-box-align: end;
  			-webkit-flex-align: end;
  			-ms-flex-align: end;
  			-webkit-align-items: end;
			  align-items: flex-end;
          }

          .newblockpc .uno_img {
            width: 18%;
            margin-right: 4%;
          }

          .newblockpc .uno_img img {
            /* margin: 20px 0;
          margin-top: 0 !important; */
            max-width: 100%;
            height: auto;
          }

          .newblockpc .uno_down div:first-child {
			display: flex;
			align-items: center;
            margin-bottom: 5px;
			font-weight: bold;
			font-size: 24px;
          }
			
			.uno_down_title {
				margin-right: 8px;
			}

          .newblockpc .uno_down {
            width: 80%;
          }

          .newblockpc .top_label {
            background: #000;
            padding: 3px 10px;
            font-size: 11px !important;
            color: #fff !important;
            border-radius: 5px;
          }

          .newblockpc .ul_done_li ul {
            margin-bottom: 0 !important;
          }

          .newblockpc .ul_done_li ul li:before {
            display: none;
          }

          .newblockpc .ul_done_li ul li {
            background-size: 10px 8px !important;
            background-position-y: 8px !important;
            padding-left: 22px;
            margin: 0;
            list-style: none;
            background: url('https://www.digitalbusiness.fr/wp-content/uploads/2021/07/Vector-577.png') no-repeat 0 0;
            line-height: 1.5rem;
          }

          .newblockpc {
            margin-top: 15px;
          }

          .newblockpc .btn_a_fw span {
            padding: 10px;
			 color:#fff;
			  font-size: 18px;
          }

          @media (max-width: 768px) {

            .newblockpc-w-name,
            .newblockpc_t,
			 .newblockpc-title{
              display: none !important;
            }
          }
			.newblockpc .btn_a_fw {
				display: flex;
   			 	justify-content: center;
    			background: #4dec5d!important;
    			box-shadow: 0 0 0 0!important;
    			position: relative;
    			padding-right: 1rem!important;
    			border-radius: 8px;
			}

/*           .newblockpc .button-mib-tabl {
            background: #4dec5d !important;
            box-shadow: 0 0 0 0 !important;
            position: relative;
            padding-right: 1rem !important;
			border-radius: 8px;
          } */

          .newblockpc .button-mib-tabl::after {
            content: "";
            display: block;
            width: 10px;
            height: 10px;
            border-right: 2px solid;
            border-bottom: 2px solid;
            border-color: #fff;
            position: absolute;
            right: 0;
			  top: calc(50% - 5px);
            transform: rotate(-45deg);
          }
			@media(min-width:1000px){
  .newblockpc .uno_img img{
        min-width: 40px;
    min-height: 40px;
  }
  .newblockpc .uno_img{
        width: 22%;
    margin-right: 4%;
    height: 100%;
  }
}

@media(min-width:1200px){
  .newblockpc .uno_img img{
        min-width: 50px;
    min-height: 50px;
  }
}
			.div-h-g .uno_img{
				width: unset !important;
    margin-right: unset !important;
    height: unset !important;
			}
			.div-h-g .uno_down{
				width:unset;
			}
			.newblockpc .newblockpc_t.dispflex {
    display: grid!important;
    grid-template-columns: repeat(4,1fr);
    gap: 20px;
}
			@media(max-width:768px){
				.newblockpc .newblockpc_t{
					display:none!important;
				}
				.newblockpc .newblockpc_t.dispflex{
					display:none!important;
				}
			
			}
          </style>
			<script>
jQuery(function($) {
	$('.forex-pc-1-1').on('click', function() {
$('.t_forex_1 ').addClass("dispflex");
$('.t_action_1 ').removeClass("dispflex");
$('.t_crypto_1 ').removeClass("dispflex");
$('.forex-pc-1-1').addClass("active-a");
$('.forex-pc-1-2').removeClass("active-a");
$('.forex-pc-1-3').removeClass("active-a");
 });
		
$('.forex-pc-1-3').on('click', function() {
	$('.t_forex_1 ').removeClass("dispflex");
$('.t_action_1 ').removeClass("dispflex");
$('.t_crypto_1 ').addClass("dispflex");
$('.forex-pc-1-1').removeClass("active-a");
$('.forex-pc-1-3').addClass("active-a");
$('.forex-pc-1-2').removeClass("active-a");
 });
		
$('.forex-pc-1-2').on('click', function() {
$('.t_forex_1 ').removeClass("dispflex");
$('.t_action_1 ').addClass("dispflex");
$('.t_crypto_1 ').removeClass("dispflex");
$('.forex-pc-1-1').removeClass("active-a");
$('.forex-pc-1-3').removeClass("active-a");
$('.forex-pc-1-2').addClass("active-a");
 });
})
</script>

          <?
    $myvariable = ob_get_clean();
    return $myvariable;
}

// запрещаем актив ссылки в коментах
function remove_link_comment($link_text) {
return strip_tags($link_text);
}

add_shortcode( 'btn_bottom', 'btn_bottom' );
function btn_bottom( $atts, $content ) {
	 return '<div class="btn_bottom"><a id="'.$atts['id'].'" class="btn_bottom_a" href="'.$atts['url'].'" target="_blank" rel="noopener noreferrer">'. $content . '</a> <i>'.$atts['bottom'].'</i></div>'; 
	
} 

add_filter('pre_comment_content','remove_link_comment');
add_filter('comment_text','remove_link_comment');