<?php
/**
 * DemocracyStraighUp's Theme Functions and definitions
 *
 * @package DemocracyStraighUp
 * @since DemocracyStraighUp 1.0
 */
 
 if ( ! defined( 'DSU_DIR_PATH ') ) {
     define( 'DSU_DIR_PATH', untrailingslashit( get_template_directory() ) );
 }


/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */

//Adding Title 
if ( ! function_exists( 'dsu_theme_setup' ) ) :
    function dsu_theme_setup() {
    
        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        */
        load_theme_textdomain( 'dsu', get_stylesheet_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
    
        // Adds <title> tag support
        add_theme_support( 'title-tag' );
        // Add custom-logo support
        add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);
    
        // Add widgets support
        add_theme_support( 'widgets' );
        
        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
        
        // Add Featured Image support
        // add_theme_support( 'post-thumbnails' );
    
        // Add image sizes
        add_image_size( 'dsu-blog-thumbnail', 260, 175, true );
        add_image_size( 'dsu-blog-large', 1200, 800, true );
        add_image_size( 'dsu-blog-custom', 900, 100, false);
        add_image_size( 'custom-image-square', 600, 600, true );
        add_image_size( 'blog-width', 800, 600 );

         
        // Register Navigation Menus
        register_nav_menus( array(
            'header'   => esc_html__( 'Display this menu in Header', 'dsu' ),
            'footer'   => esc_html__( 'Display this menu in Footer', 'dsu'),
            'social'   => esc_html__( 'Display this menu in Social', 'dsu')
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
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);
    
    }
    endif; // Title setup
    add_action( 'after_setup_theme', 'dsu_theme_setup');


if ( ! isset( $content_width ) )
    $content_width = 800; /* pixels */
 
// Loading CSS
if ( ! function_exists( 'dsu_styles_setup' ) ) :
    function dsu_styles_setup() {
        wp_register_style(
            'normalize',
            get_stylesheet_directory_uri() . '/assets/css/normalize.css',
            array(),
            false,
            'all'
        );
        wp_enqueue_style('normalize');

        wp_register_style(
            'bootstrap',
            get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
            array(),
            false,
            'all'
        );

        wp_enqueue_style('bootstrap');

        wp_register_style(
            'theme_css',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            array('normalize', 'bootstrap'),
            filemtime(get_template_directory(). '/assets/css/main.css'),
            'all'
        );

        wp_enqueue_style('theme_css');
    }
endif; // CSS setup
    add_action( 'wp_enqueue_scripts', 'dsu_styles_setup' );


    add_filter( 'image_size_names_choose','wpmudev_custom_image_sizes' );

function wpmudev_custom_image_sizes( $sizes ) {
return array_merge( $sizes, array(

//Add your custom sizes here
'dsu-blog-custom' => __( 'Custom' ),
'blog-width' => __( 'Blog Content Full Width' ),
) );
}



// Loading Script
if ( ! function_exists( 'dsu_script_setup' ) ) :
    function dsu_script_setup() {

        wp_enqueue_script('jquery');

        wp_register_script(
            'main-js',
            get_stylesheet_directory_uri() . '/assets/js/main.js',
            array('jquery'),
            '1.0.0',
            true // load this script in the footer
        );
        wp_enqueue_script('main-js');

        wp_register_script(
            'bootstrap-js',
            get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js',
            array('jquery'),
            '1.0.0',
            true // load this script in the footer
        );
        wp_enqueue_script('bootstrap-js');
    }
endif; // Script setup

add_action( 'wp_enqueue_scripts', 'dsu_script_setup' );




//display the author AND last modified date
function feature_image_shortcode() {
    // Things that you want to do.
    $message = 'Hello world!'; 
    
    // Output needs to be return
    // return $message;
    if ( has_post_thumbnail() ): // check if the post has a Post Thumbnail assigned to it.
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                <img src="<?php the_post_thumbnail_url('dsu-blog-custom'); ?>" alt="<?php the_title(); ?>" class="img-fluid" />
        <?php
        return $featured_image[0];
    endif;

}
add_shortcode('post_feature_image','feature_image_shortcode');




/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'dsu_register_sidebars' ) ) :
function dsu_register_sidebars() {
	
    register_sidebar( array(
        'name'          => esc_html__( 'Social Media', 'dsu' ),
        'id'            => 'social-media',
        'description'   => esc_html__( 'Widgets added here would appear inside the Social Media', 'dsu' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
         'name'          => esc_html__( 'Footer Section One', 'dsu' ),
         'id'            => 'footer-section-one',
         'description'   => esc_html__( 'Widgets added here would appear inside the first section of the footer', 'dsu' ),
         'before_widget' => '',
         'after_widget'  => '',
         'before_title'  => '',
         'after_title'   => '',
     ) );
     
     register_sidebar( array(
         'name'          => esc_html__( 'Footer Section Two', 'dsu' ),
         'id'            => 'footer-section-two',
         'description'   => esc_html__( 'Widgets added here would appear inside the second section of the footer', 'dsu' ),
         'before_widget' => '',
         'after_widget'  => '',
         'before_title'  => '',
         'after_title'   => '',
     ) );

     register_sidebar( array(
        'name'          => esc_html__( 'Blog Section', 'dsu' ),
        'id'            => 'blog-section',
        'description'   => esc_html__( 'Widgets added here would appear inside the Blog section', 'dsu' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
 }
endif;
 add_action( 'widgets_init', 'dsu_register_sidebars' );	

 // sidebar

 
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}

add_action( 'widgets_init', 'my_register_sidebars' );

//display the author name which is linked to the About page
function author_name_shortcode(){
    global $post;
    $post_id = $post->ID;
    $author = get_the_author($post_id);
    $linkedAuthor = "<a href='/about'>".$author."</a>";
    return $linkedAuthor;
}
add_shortcode('post_author','author_name_shortcode');

//display the post's last modified date
function post_updated_shortcode(){
    global $post;
    $post_id = $post->ID;
    $mod_date = get_the_modified_date('F jS, Y', $post_id);
    return $mod_date;
}
add_shortcode('post_updated','post_updated_shortcode');

//display the author AND last modified date
function post_credits_shortcode(){
    global $post;
    $post_id = $post->ID;
    $mod_date = get_the_modified_date('F jS, Y', $post_id);
    $author = get_the_author($post_id);
    $linkedAuthor = "<a href='/about'>".$author."</a>";
    $post_creds = $linkedAuthor." | ".$mod_date;
    return $post_creds;
}
add_shortcode('post_credits','post_credits_shortcode');


?>