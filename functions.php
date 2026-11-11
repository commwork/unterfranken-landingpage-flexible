<?php
/**
 * uflp functions and definitions
 *
 * @package uflp
 */

/**
 * Paths
 *
 * @since  1.0
 */
if ( !defined('UFLP_THEME_DIR') ) {
	define ('UFLP_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template() );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* pixels */
}

if ( ! function_exists( 'uflp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uflp_setup() {
    // Add theme support for title tag
	add_theme_support( 'title-tag' );
    // Add theme support for post thumbnails
	add_theme_support( 'post-thumbnails' );
    // Register navigation menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'uflp' ),
		'footer' => __( 'Footer', 'uflp' ),
	));

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));
}
endif; // uflp_setup
add_action( 'after_setup_theme', 'uflp_setup' );

/**
 * /////////////////////////////////////////////////
 *  Enqueue scripts and styles.
 * /////////////////////////////////////////////////
 */

function uflp_scripts() {
    // Deregister WordPress default jQuery and register our own version (local)
    wp_deregister_script('jquery');
    wp_register_script(
        'jquery',
        get_template_directory_uri() . '/assets/vendor/jquery/jquery.min.js',
        array(),
        '4.0.0',
        false
    );
    wp_enqueue_script('jquery');

    // UFLP JavaScript (local)
    wp_enqueue_script(
        'AppJs',
        get_template_directory_uri() . '/assets/js/app.js',
        array('jquery'),
        filemtime(get_template_directory() . '/assets/js/app.js'), // dynamic cache busting
        true
    );
    
    // Bootstrap CSS (local)
    wp_enqueue_style(
        'bootstrapCss',
        get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap-grid.min.css',
        array(),
        filemtime(get_template_directory() . '/assets/vendor/bootstrap/bootstrap-grid.min.css'),
        'all'
    );

    // AOS – Animate on Scroll
    wp_enqueue_style(
        'aosCss',
        'https://unpkg.com/aos@2.3.4/dist/aos.css',
        array(),
        '2.3.4',
        'all'
    );
    wp_enqueue_script(
        'aosJs',
        'https://unpkg.com/aos@2.3.4/dist/aos.js',
        array(),
        '2.3.4',
        true
    );
    wp_add_inline_script( 'aosJs', "if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { AOS.init({ disable: true }); } else { AOS.init({ offset: 10, duration: 400, easing: 'ease', once: true }); }", 'after' );
}
add_action('wp_enqueue_scripts', 'uflp_scripts');

function uflp_enqueue_style() {
    wp_enqueue_style( 'UflpStyle', get_template_directory_uri() . '/style.css', [], filemtime(get_template_directory() . '/style.css'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'uflp_enqueue_style' );

function uflp_admin_styles() {
    $admin_css = get_template_directory() . '/admin.css';

    if ( ! file_exists( $admin_css ) ) {
        return;
    }

    wp_enqueue_style(
        'uflp-admin',
        get_template_directory_uri() . '/admin.css',
        array(),
        filemtime( $admin_css ),
        'all'
    );
}
add_action( 'admin_enqueue_scripts', 'uflp_admin_styles' );

/**
 * /////////////////////////////////////////////////
 *  Plugins
 * /////////////////////////////////////////////////
 */

// Email adress encoder
// Make it work with ACF fields
if ( function_exists( 'eae_encode_emails' ) ) {
    add_filter('acf_the_content', 'eae_encode_emails');
}

// Contact Form 7: disable automatic <br> / <p> insertion in form markup
add_filter( 'wpcf7_autop_or_not', function( $autop, $options ) {
    if ( isset( $options['for'] ) && 'form' === $options['for'] ) {
        return false;
    }

    return $autop;
}, 10, 2 );

/**
 * /////////////////////////////////////////////////
 *  ACF options
 * /////////////////////////////////////////////////
 */
function uflp_register_options_pages() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
    // Top-level: UFLP (parent for most sub-pages; shows its own fields).
	acf_add_options_page( array(
		'page_title'      => 'Optionen',
		'menu_title'      => 'Optionen',
		'menu_slug'       => 'uflp',
		'capability'      => 'edit_posts',
		'redirect'        => false,
		'icon_url'        => 'dashicons-star-filled',
		'update_button'   => 'Speichern',
		'updated_message' => 'Optionen gespeichert',
		'autoload'        => false,
	) );
}
add_action( 'acf/init', 'uflp_register_options_pages' );

/**
 * /////////////////////////////////////////////////
 *  Replace UpdraftPlus custom PNG menu icon with a Dashicon.
 * /////////////////////////////////////////////////
 */

function uflp_updraftplus_menu_icon() {
	global $menu;

	if ( empty( $menu ) || ! is_array( $menu ) ) {
		return;
	}

	foreach ( $menu as $key => $item ) {
		if ( empty( $item[2] ) || 'options-general.php?page=updraftplus' !== $item[2] ) {
			continue;
		}

		$menu[ $key ][6] = 'dashicons-update';
		break;
	}
}
add_action( 'admin_menu', 'uflp_updraftplus_menu_icon', 999 );

/**
 * /////////////////////////////////////////////////
 *  Minify HTML output (safe, conservative)
 * /////////////////////////////////////////////////
 */

class Simple_WP_Minifier {
    public function __construct() {
        ob_start([$this, 'minify_buffer']);
    }

    public function minify_buffer($buffer) {
        if (!is_admin() && !is_customize_preview() && is_string($buffer) && strlen($buffer) > 0) {
            // Remove HTML comments except IE conditionals (typo fix: \s* not s*)
            $buffer = preg_replace('/<!--(?!\s*(?:\[if [^]]+\]|!|>))(?:(?!-->).)*-->/s', '', $buffer);

            // Only remove whitespace BETWEEN tags – safe, does not touch <pre>/<textarea> content
            $buffer = preg_replace('/>\s+</', '><', $buffer);
        }

        return $buffer;
    }
}

new Simple_WP_Minifier();