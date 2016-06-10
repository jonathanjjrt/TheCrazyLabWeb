<?php	
// Load Localization Files
$lang_dir = get_template_directory() . '/lang';
load_theme_textdomain('bloompixel', $lang_dir);

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/options/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options/ReduxCore/framework.php' );
}
if ( !isset( $bpxl_travelista_options ) && file_exists( dirname( __FILE__ ) . '/inc/options/settings/sample-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options/settings/sample-config.php' );
}

// Custom template functions for this theme.
require get_template_directory() . '/inc/template-functions.php';

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 1108;
}

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
/* UBlog supports.
/*-----------------------------------------------------------------------------------*/
function bpxl_theme_setup() {
	global $bpxl_travelista_options;
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme supports the following post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'image', 'status', 'audio', 'aside' ) );
	
	// Register WordPress Custom Menus
	add_theme_support( 'menus' );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'bloompixel' ) );
	register_nav_menu( 'secondary-menu', __( 'Top Menu', 'bloompixel' ) );
	
    /*--------------------------------*/
    /*	Register Post Thumbnails
    /*--------------------------------*/
    // Entry Image Sizes
    if ( !empty( $bpxl_travelista_options['bpxl_entry_img_width'] ) ) {
        $bpxl_entry_img_width = $bpxl_travelista_options['bpxl_entry_img_width'];
    } else {
        $bpxl_entry_img_width = '738';
    }
    if ( !empty( $bpxl_travelista_options['bpxl_entry_img_height'] ) ) {
        $bpxl_entry_img_height = $bpxl_travelista_options['bpxl_entry_img_height'];
    } else {
        $bpxl_entry_img_height = '355';
    }
    // Widgets Thumbnail Sizes
    if ( !empty( $bpxl_travelista_options['bpxl_widgets_img_width'] ) ) {
        $bpxl_widgets_img_width = $bpxl_travelista_options['bpxl_widgets_img_width'];
    } else {
        $bpxl_widgets_img_width = '65';
    }
    if ( !empty( $bpxl_travelista_options['bpxl_widgets_img_height'] ) ) {
        $bpxl_widgets_img_height = $bpxl_travelista_options['bpxl_widgets_img_height'];
    } else {
        $bpxl_widgets_img_height = '65';
    }
    // Slider Thumbnail Sizes
    if ( !empty( $bpxl_travelista_options['bpxl_slider_img_height'] ) ) {
        $bpxl_slider_img_height = $bpxl_travelista_options['bpxl_slider_img_height'];
    } else {
        $bpxl_slider_img_height = '500';
    }
    
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'slider', 1170, $bpxl_slider_img_height, true ); //slider
	add_image_size( 'featured', $bpxl_entry_img_width, $bpxl_entry_img_height, true ); //featured
	add_image_size( 'featuredthumb', 325, 150, true ); //featuredthumb
	add_image_size( 'related', 237, 150, true ); //related
	add_image_size( 'widgetthumb', $bpxl_widgets_img_width, $bpxl_widgets_img_height, true ); //widgetthumb
    
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
add_action( 'after_setup_theme', 'bpxl_theme_setup' );

// title tag implementation with backward compatibility
if ( ! function_exists( '_wp_render_title_tag' ) ) :
function theme_slug_render_title() {
    echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
}
add_action( 'wp_head', 'theme_slug_render_title' );
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Meta Boxes
/*-----------------------------------------------------------------------------------*/
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
// Include the meta box script
require_once ( RWMB_DIR . 'meta-box.php' );
// Include the meta box definition (the file where you define meta boxes, see 'demo/demo.php')
include_once(get_template_directory() . '/inc/meta-box/meta-boxes.php');

get_template_part('inc/category-meta/Tax-meta-class/class-usage');

/*-----------------------------------------------------------------------------------*/
/*	Add Stylesheets
/*-----------------------------------------------------------------------------------*/
function bpxl_stylesheets() {
	global $bpxl_travelista_options;
	wp_enqueue_style( 'travelista-style', get_stylesheet_uri() );
	
	// Color Scheme
	if (is_category()) {
		$category_ID = get_query_var('cat');
		
		$cat_color_1 = get_tax_meta($category_ID,'bpxl_color_field_id');
		$cat_bg_color = get_tax_meta($category_ID,'bpxl_cat_bg_color_field_id');
		$cat_bg = get_tax_meta($category_ID,'bpxl_bg_field_id');
		$cat_repeat = get_tax_meta($category_ID,'bpxl_category_repeat_id');
		$cat_position = get_tax_meta($category_ID,'bpxl_category_position_id');
		$cat_attachment = get_tax_meta($category_ID,'bpxl_category_attachment_id');
		$cat_size = get_tax_meta($category_ID,'bpxl_category_size_id');
	}
	if (is_single() || is_page()) {
		$single_bg_color = rwmb_meta( 'bpxl_post_bg_color', $args = array('type' => 'color'), get_the_ID() );
		$single_bg_images = rwmb_meta( 'bpxl_post_bg_img', $args = array('type' => 'plupload_image'), get_the_ID() );
			foreach ($single_bg_images as $single_bg_img_id) {
				$single_bg_img_code = wp_get_attachment_image_src($single_bg_img_id['ID'],'full');
				$single_bg_img = $single_bg_img_code[0];
			}
		$single_repeat = rwmb_meta( 'bpxl_post_bg_repeat', $args = array('type' => 'select'), get_the_ID() );
		$single_position = rwmb_meta( 'bpxl_post_bg_position', $args = array('type' => 'select'), get_the_ID() );
		$single_size = rwmb_meta( 'bpxl_post_bg_size', $args = array('type' => 'select'), get_the_ID() );
		$single_attachment = rwmb_meta( 'bpxl_post_bg_attachment', $args = array('type' => 'select'), get_the_ID() );
	}
	
	// Color Scheme 1
	$color_scheme_1 = "";
	if (is_category()) {
		if (strlen($cat_color_1) > 2 ) {
			$color_scheme_1 = $cat_color_1;
		} else { $color_scheme_1 = $bpxl_travelista_options['bpxl_color_one']; }
	} elseif ($bpxl_travelista_options['bpxl_color_one'] != '') {
		$color_scheme_1 = $bpxl_travelista_options['bpxl_color_one'];
	}
	
	// Background Color
	if (!empty($bpxl_travelista_options['bpxl_body_bg']['background-color'])) { $background_color = $bpxl_travelista_options['bpxl_body_bg']['background-color']; } else { $background_color = '#f2f2f2'; }
	
	// Background Pattern
	$background_img = get_template_directory_uri(). "/images/bg.png";
	$bg_repeat = 'repeat';
	$bg_attachment = 'scroll';
	$bg_position = '0 0';
	$bg_size = 'inherit';
	if (is_category()) {
		if ($cat_bg != '') { // Category Background Pattern
			$background_img = $cat_bg['src'];
			$bg_repeat = $cat_repeat;
			$bg_attachment = $cat_attachment;
			$bg_position = $cat_position;
			$bg_size = $cat_size;
		} elseif (strlen($cat_bg_color) > 2) {
			$background_color = $cat_bg_color;
		}
		elseif (!empty($bpxl_travelista_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
			$background_img = $bpxl_travelista_options['bpxl_body_bg']['background-image'];
			$bg_repeat = $bpxl_travelista_options['bpxl_body_bg']['background-repeat'];
			$bg_attachment = $bpxl_travelista_options['bpxl_body_bg']['background-attachment'];
			$bg_size = $bpxl_travelista_options['bpxl_body_bg']['background-size'];
			$bg_position = $bpxl_travelista_options['bpxl_body_bg']['background-position'];
		} elseif ($bpxl_travelista_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
			$background_img = get_template_directory_uri(). "/images/".$bpxl_travelista_options['bpxl_bg_pattern'].".png";
			$bg_repeat = 'repeat';
			$bg_attachment = 'scroll';
			$bg_position = '0 0';
		}
	} elseif (is_single() || is_page()) {
		if (!empty($single_bg_img)) { // Single Background Image
			$background_img = $single_bg_img;
			$bg_repeat = $single_repeat;
			$bg_position = $single_position;
			$bg_size = $single_size;
			$bg_attachment = $single_attachment;
		} elseif (!empty($single_bg_color)) { // Single Background Color
			$background_color = rwmb_meta( 'bpxl_post_bg_color', $args = array('type' => 'color'), get_the_ID() );
		} elseif (!empty($bpxl_travelista_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
			$background_img = $bpxl_travelista_options['bpxl_body_bg']['background-image'];
			$bg_repeat = $bpxl_travelista_options['bpxl_body_bg']['background-repeat'];
			$bg_attachment = $bpxl_travelista_options['bpxl_body_bg']['background-attachment'];
			$bg_size = $bpxl_travelista_options['bpxl_body_bg']['background-size'];
			$bg_position = $bpxl_travelista_options['bpxl_body_bg']['background-position'];
		} elseif ($bpxl_travelista_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
			$background_img = get_template_directory_uri(). "/images/".$bpxl_travelista_options['bpxl_bg_pattern'].".png";
			$bg_repeat = 'repeat';
			$bg_attachment = 'scroll';
			$bg_position = '0 0';
		}
	} elseif (!empty($bpxl_travelista_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
		$background_img = $bpxl_travelista_options['bpxl_body_bg']['background-image'];
		$bg_repeat = $bpxl_travelista_options['bpxl_body_bg']['background-repeat'];
		$bg_attachment = $bpxl_travelista_options['bpxl_body_bg']['background-attachment'];
		$bg_size = $bpxl_travelista_options['bpxl_body_bg']['background-size'];
		$bg_position = $bpxl_travelista_options['bpxl_body_bg']['background-position'];
	} elseif ($bpxl_travelista_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
		$background_img = get_template_directory_uri(). "/images/".$bpxl_travelista_options['bpxl_bg_pattern'].".png";
		$bg_repeat = 'repeat';
		$bg_attachment = 'scroll';
		$bg_position = '0 0';
		$bg_size = 'inherit';
	}
	
	// Layout Options
	$bpxl_single_layout = '';
	$bpxl_featured_css = '';
	$bpxl_sticky_css = '';
	$bpxl_custom_css = '';
	$bpxl_footer_logo_css = '';
	
	// Single Layout
	if( is_single() || is_page() ) {		
		$sidebar_positions = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
		
		if( !empty($sidebar_positions) ) {
			$sidebar_position = $sidebar_positions;
			
			if( $sidebar_position == 'left' ) $bpxl_single_layout = '.single-content-area { float:right }';
			elseif( $sidebar_position == 'right' ) $bpxl_single_layout = '.single-content-area { float:left; } .content { float:left; border:0; border-bottom:1px solid #e3e3e3; border-right:1px solid #e3e3e3 }';
			elseif( $sidebar_position == 'none' ) $bpxl_single_layout = '.single-content-area { margin:0; width:100% } .content { border:0; margin:0 } .post-box img { max-width:98% }';
		}
	}

	// Navigation Menu
	if (!empty($bpxl_travelista_options['bpxl_nav_link_color']['regular'])) {
		$bpxl_nav_link_color = $bpxl_travelista_options['bpxl_nav_link_color']['regular'];
	}
	if (!empty($bpxl_travelista_options['bpxl_nav_link_color']['hover'])) {
		$bpxl_nav_link_hover_color = $bpxl_travelista_options['bpxl_nav_link_color']['hover'];
	}
	
	// Hex to RGB
	$bpxl_hex = $color_scheme_1;
	list($bpxl_r, $bpxl_g, $bpxl_b) = sscanf($bpxl_hex, "#%02x%02x%02x");
	
	// Footer Background
	if($bpxl_travelista_options['bpxl_footer_logo_btn'] == '1') {
		$bpxl_footer_logo_css = ".footer-logo-wrap { 
			background-color:{$bpxl_travelista_options['bpxl_footer_logo_bg']['background-color']};
			background-image:url({$bpxl_travelista_options['bpxl_footer_logo_bg']['background-image']});
			background-repeat:{$bpxl_travelista_options['bpxl_footer_logo_bg']['background-repeat']};
			background-size:{$bpxl_travelista_options['bpxl_footer_logo_bg']['background-size']};
			background-attachment:{$bpxl_travelista_options['bpxl_footer_logo_bg']['background-attachment']};
			background-position:{$bpxl_travelista_options['bpxl_footer_logo_bg']['background-position']};
		}";
	}
	
	// Custom CSS
	if ($bpxl_travelista_options['bpxl_custom_css'] != '') {
		$bpxl_custom_css = $bpxl_travelista_options['bpxl_custom_css'];
	}
	
	$custom_css = "
	body, .menu-pusher { background-color:{$background_color}; background-image:url({$background_img}); background-repeat:{$bg_repeat}; background-attachment:{$bg_attachment}; background-position:{$bg_position}; background-size:{$bg_size} }
	.header-search:hover .search-button, .search-button, .nav-menu ul li ul li a:hover, .read-more a, .post-type i, .post-cats a:before, .widget_archive a:hover .cat-count, .cat-item a:hover .cat-count, .tagcloud a:hover, .pagination .current, .pagination a:hover, .post-format-quote, .flex-direction-nav a:hover, .flex-control-nav a.flex-active, .subscribe-widget input[type='submit'], #wp-calendar caption, #wp-calendar td#today, #commentform #submit, .wpcf7-submit, .off-canvas-search, .author-location span, .jetpack_subscription_widget input[type=submit] { background-color:{$color_scheme_1}; }
	a, a:hover, .title a:hover, .sidebar a:hover, .sidebar-small-widget a:hover, .breadcrumbs a:hover, .meta a:hover, .post-meta a:hover, .post .post-content ul li:before, .content-page .post-content ul li:before, .reply:hover i, .reply:hover a, .edit-post a, .relatedPosts .widgettitle a:hover, .error-text { color:{$color_scheme_1}; }
	.main-nav a { color:{$bpxl_nav_link_color}}
	.main-nav .current-menu-parent > a, .main-nav .current-page-parent > a, .main-nav .current-menu-item > a, .main-nav .menu > .sfHover > a, .main-nav a:hover { color:{$bpxl_nav_link_hover_color}; }
	.main-nav .current-menu-parent > a, .main-nav .current-page-parent > a, .main-nav .current-menu-item > a, .main-nav .menu > .sfHover > a, .main-nav a:hover { border-color:{$color_scheme_1}}
	.widget-title span, #tabs li.active span, .section-heading span, .post-content blockquote, .tagcloud a:hover .post blockquote, .pagination .current, .pagination a:hover, .comment-reply-link:hover, .footer-links { border-color:{$color_scheme_1} !important; }
	#wp-calendar th { background: rgba({$bpxl_r},{$bpxl_g},{$bpxl_b}, 0.6) } {$bpxl_single_layout} {$bpxl_custom_css} {$bpxl_footer_logo_css}";
	wp_add_inline_style( 'travelista-style', $custom_css );
	
	// Font-Awesome CSS
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );
	
	if ($bpxl_travelista_options['bpxl_responsive_layout'] == '1') {
		// Responsive
		wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_style( 'responsive' );
	}
	
	if ($bpxl_travelista_options['bpxl_rtl'] == '1') {
		// Responsive
		wp_register_style( 'rtl', get_template_directory_uri() . '/css/rtl.css' );
		wp_enqueue_style( 'rtl' );
	}
}
add_action( 'wp_enqueue_scripts', 'bpxl_stylesheets' );

/*-----------------------------------------------------------------------------------*/
/*	Add JavaScripts
/*-----------------------------------------------------------------------------------*/
function bpxl_scripts() {
global $bpxl_travelista_options;
    wp_enqueue_script( 'jquery' );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	// Sticky Menu
	if ($bpxl_travelista_options['bpxl_sticky_menu'] == '1') {
		wp_register_script( 'stickymenu', get_template_directory_uri() . '/js/stickymenu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'stickymenu' );
	}
	
	// Masonry
	$bpxl_masonry_array = array(
		'clayout',
		'gslayout',
		'sglayout',
		'glayout',
	);
	if(in_array($bpxl_travelista_options['bpxl_layout'],$bpxl_masonry_array) || in_array($bpxl_travelista_options['bpxl_single_layout'],$bpxl_masonry_array) || in_array($bpxl_travelista_options['bpxl_archive_layout'],$bpxl_masonry_array)) {
		wp_register_script( 'masonry.min', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), '3.1.5', true );
		wp_enqueue_script( 'masonry.min' );
	}
	
	if ( is_author() || is_category() ) {
		// Required jQuery Scripts
	    wp_register_script( 'bg-check', get_template_directory_uri() . '/js/bg-check.js', array( 'jquery' ), '1.2.2', true );
	    wp_enqueue_script( 'bg-check' );
	}
	
	// imagesloaded
    wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.8', true );
    wp_enqueue_script( 'imagesloaded' );
	
	// Required jQuery Scripts
    wp_register_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'theme-scripts' );
}
add_action( 'wp_enqueue_scripts', 'bpxl_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/
function bpxl_admin_scripts() {
    wp_register_script( 'admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'admin-scripts' );
	
    wp_register_script( 'select2js', get_template_directory_uri() . '/js/select2js.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'select2js' );
	
	wp_register_style( 'select2css', get_template_directory_uri() . '/css/select2css.css' );
	wp_enqueue_style( 'select2css' );
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'adminstyle', get_template_directory_uri() . '/css/adminstyle.css' );
	wp_enqueue_style( 'adminstyle' );
    
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('wp-color-picker');
}
add_action( 'admin_enqueue_scripts', 'bpxl_admin_scripts' );

// Header Code
function bpxl_header_code_fn() {
	global $bpxl_travelista_options;
	if (!empty($bpxl_travelista_options['bpxl_header_code'])) {
		echo $bpxl_travelista_options['bpxl_header_code'];
	}
}
add_action('wp_head','bpxl_header_code_fn');

// Footer Code
function bpxl_footer_code_fn() {
	global $bpxl_travelista_options;
	if (!empty($bpxl_travelista_options['bpxl_footer_code'])) {
		echo $bpxl_travelista_options['bpxl_footer_code'];
	}
}
add_action('wp_footer','bpxl_footer_code_fn');

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/
// Theme Functions
include("inc/widgets/widget-ad160.php"); // 160x600 Ad Widget
include("inc/widgets/widget-ad300.php"); // 300x250 Ad Widget
include("inc/widgets/widget-ad125.php"); // 125x125 Ad Widget
include("inc/widgets/widget-fblikebox.php"); // Facebook Like Box
include("inc/widgets/widget-flickr.php"); // Flickr Widget
include("inc/widgets/widget-popular-posts.php"); // Popular Posts
include("inc/widgets/widget-cat-posts.php"); // Category Posts
include("inc/widgets/widget-random-posts.php"); // Random Posts
include("inc/widgets/widget-recent-posts.php"); // Recent Posts
include("inc/widgets/widget-social.php"); // Social Widget
include("inc/widgets/widget-subscribe.php"); // Subscribe Widget
include("inc/widgets/widget-tabs.php"); // Tabs Widget
include("inc/widgets/widget-tweets.php"); // Tweets Widget
include("inc/widgets/widget-video.php"); // Video Widget
include("inc/widgets/widget-slider.php"); // Slider Widget
include("inc/nav-walker.php"); // Nav Walker Class
include("inc/nav-walker-mobile.php"); // Nav Walker Class
	
/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Register Theme Widgets
/*-----------------------------------------------------------------------------------*/
function bpxl_widgets_init() {
	global $bpxl_travelista_options;
	register_sidebar(array(
		'name'          => __( 'Primary Sidebar', 'bloompixel' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar of the theme.', 'bloompixel' ),
		'before_widget' => '<div class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar(array(
		'name'          => __( 'Secondary Sidebar', 'bloompixel' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Only displayed when 3 column layout is enabled.', 'bloompixel' ),
		'before_widget' => '<div class="widget sidebar-widget sidebar-small-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	$bpxl_footer_columns = (!empty($bpxl_travelista_options['bpxl_footer_columns']) ? $bpxl_travelista_options['bpxl_footer_columns']: '' );
	if ($bpxl_footer_columns == 'footer_4') {
		$sidebars = array(1, 2, 3, 4);
		foreach($sidebars as $number) {
			register_sidebar(array(
				'name'          => __( 'Footer', 'bloompixel' ) . ' ' . $number,
				'id'            => 'footer-' . $number,
                'description'   => __( 'This widget area appears on footer of theme.', 'bloompixel' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title uppercase"><span>',
				'after_title'   => '</span></h3>'
			));
		}
	} elseif ($bpxl_footer_columns == 'footer_3') {
		$sidebars = array(1, 2, 3);
		foreach($sidebars as $number) {
			register_sidebar(array(
                'name'          => __( 'Footer', 'bloompixel' ) . ' ' . $number,
                'id'            => 'footer-' . $number,
                'description'   => __( 'This widget area appears on footer of theme.', 'bloompixel' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title uppercase">',
                'after_title'   => '</h3>'
			));
		}
	} elseif ($bpxl_footer_columns == 'footer_2') {
		$sidebars = array(1, 2);
		foreach($sidebars as $number) {
			register_sidebar(array(
                'name'          => __( 'Footer', 'bloompixel' ) . ' ' . $number,
                'id'            => 'footer-' . $number,
                'description'   => __( 'This widget area appears on footer of theme.', 'bloompixel' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title uppercase">',
                'after_title'   => '</h3>'
			));
		}
	} else {
		register_sidebar(array(
            'name'          => __( 'Footer', 'bloompixel' ),
            'id'            => 'footer-1',
            'description'   => __( 'This widget area appears on footer of theme.', 'bloompixel' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title uppercase">',
            'after_title'   => '</h3>'
		));
	}
}
add_action( 'widgets_init', 'bpxl_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function bpxl_breadcrumb() {
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '&raquo;'; // delimiter between crumbs
    $home = '<i class="fa fa-home"></i>' . __('Home','bloompixel'); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    global $post;
    $homeLink = home_url();
    if (is_home() || is_front_page()) {
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
    } else {
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . single_cat_title('', false) . $after;
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','bloompixel') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function bpxl_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>

		<span class="reply uppercase">
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply','bloompixel')))) ?>
		</span>
	</div>
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','bloompixel') ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s','bloompixel'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','bloompixel'),'  ','' );
		?>
	</div>

	<div class="commentBody">
		<?php comment_text() ?>
	</div>
	</div>
<?php }


/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function bpxl_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) { $pages = 1; }
     }

     if(1 != $pages) {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*-----------------------------------------------------------------------------------*/
/*	Custom wp_link_pages
/*-----------------------------------------------------------------------------------*/
function bpxl_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<div class="pagination" id="post-pagination">' . __( '<p class="page-links-title">Pages:</p>' ), 
		'after' => '</div>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __( 'Next page', 'bloompixel' ),
		'previouspagelink' => __( 'Previous page', 'bloompixel' ),
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current-post-page">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Automatic Theme Updates
/*-----------------------------------------------------------------------------------*/
global $bpxl_travelista_options;
$username = (!empty($bpxl_travelista_options['bpxl_envato_user_name']) ? $bpxl_travelista_options['bpxl_envato_user_name']: '' );
$apikey = (!empty($bpxl_travelista_options['bpxl_envato_api_key']) ? $bpxl_travelista_options['bpxl_envato_api_key']: '' );
$author = 'Simrandeep Singh';

load_template( trailingslashit( get_template_directory() ) . 'inc/wp-theme-upgrader/envato-wp-theme-updater.php' );
Envato_WP_Theme_Updater::init( $username, $apikey, $author );
?>