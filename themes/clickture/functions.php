<?php
/**
 * Clickture functions and definitions
 *
 * @package Clickture
 */

if ( ! function_exists( 'clickture_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function clickture_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Clickture, use a find and replace
	 * to change 'clickture' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'clickture', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'clickture' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'clickture_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // clickture_setup
add_action( 'after_setup_theme', 'clickture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clickture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'clickture_content_width', 640 );
}
add_action( 'after_setup_theme', 'clickture_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function clickture_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'clickture' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'clickture_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function clickture_scripts() {
	wp_enqueue_style( 'clickture-style', get_stylesheet_uri() );

	wp_enqueue_script( 'clickture-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'clickture-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clickture_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */

 /* Below is taken from my functions.php */ 
 

	/*
 * Register widgetized area and update sidebar with default widgets
 */
	function magazino_widgets_init() {
		/*these allow the sidebar to exist; I wrote this function for my lab, based on a tutorial - couldn't change name without breaking fuctionality; perhaps someone can fix it */ 
		register_sidebar( array('name' => __( 'Footer Sidebar', 'fluffy' ),'id' => 'sidebar-1','before_widget' => '<aside id="%1$s" class="widget %2$s">','after_widget' => "</aside>",'before_title' => '<div class="widget-title">','after_title' => '</div>',) );
		register_sidebar( array('name' => __( 'Side Sidebar', 'fluffy' ),'id' => 'sidebar-2','before_widget' => '<aside id="%1$s" class="widget %2$s">','after_widget' => "</aside>",'before_title' => '<div class="widget-title">','after_title' => '</div>',) );
	}

	add_action( 'widgets_init', 'magazino_widgets_init' );
	function cd_custom_gravatar ($avatar_defaults) {
		$myavatar = get_stylesheet_directory_uri() . '/imgs/luna.png';
		$avatar_defaults[$myavatar] = __( 'Custom Gravatar', 'YOUR TEXT DOMAIN' );
		return $avatar_defaults;
		// this provides my custom luna gravatar icon in the discussion options page 
	}

	// Add Signature Image after single post
	add_filter('the_content','add_signature');
	function add_signature($text) {
		global $post;
		
		if($post->post_type == 'post') $text .= '<div class="signature">
<img src="https://scontent-lga1-1.xx.fbcdn.net/hphotos-xfp1/v/t1.0-9/10325566_10153213144815668_1506123044450425268_n.jpg?oh=77ae4d00762405fa1f3111468ce96c5b&oe=56186848" alt="Kyle Johnson" />
</div>';
		return $text;
	}

	//this function limits the number of words displayed on the home page for posts
	function custom_excerpt_length( $length ) {
		return 20;
	}

	add_filter( 'excerpt_length', 'custom_excerpt_length',999 );
	//this places a message and link after every post
	function everything_is_awesome($content){
		$content .= 'Watch out for this muggle author, J.K. Rowling! She spreads lies!!! <a
href="http://www.jkrowling.com/en_GB/">http:
//www.jkrowling.com/en_GB/!</a>';
		return $content;
	}

	add_filter( 'the_content', 'everything_is_awesome');
	//this function dictates the text of the excerpt 'read more' section 
	function new_excerpt_more( $more ) {
		return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Open your mind...', 'your-text-domain' ) . '</a>';
	}

	add_filter( 'excerpt_more', 'new_excerpt_more' );
	// This theme uses wp_nav_menu() in two locations.  
	register_nav_menus( array(    'primary' => __( 'Primary Navigation', 'fluffy-master' ),    'secondary' => __('Secondary Navigation', 'fluffy-master')  ) );
	//this function loads the google fonts through enqueueing
	
	function load_fonts() {
		wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Oswald|Comfortaa');
		wp_enqueue_style( 'googleFonts');
	}

	add_action('wp_print_styles', 'load_fonts');
	add_theme_support( 'post-thumbnails' );
	/* This gives the theme support for thumbnails*/
	set_post_thumbnail_size( 250, 250);
	/* This dictates the size of the posted thumbnails, regardless of the settings made in the dashboard*/
 
 