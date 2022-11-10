<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}

// Register Sidebars
function custom_sidebars() {
  
    $args = array(
        'id'            => 'custom_sidebar',
        'name'          => __( 'Widget Recent Post', 'text_domain' ),
        'description'   => __( 'A custom widget for recent post', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
    );
    register_sidebar( $args );
  
}
add_action( 'widgets_init', 'custom_sidebars' );


//display the author AND last modified date
function post_credits_shortcode(){
    global $post;
    $post_id = $post->ID;
    $mod_date = get_the_date( 'F j, Y', $post_id );
	$avatar = get_avatar( get_the_author_meta( $post_id ));
    $author = get_the_author($post_id);
    $linkedAuthor = "by: <a href='/about'>".$author."</a>";
    // $return_string = $avatar.'  '.$linkedAuthor." - ".$mod_date;
	$return_string = '<ul>';
    $return_string .= '<li>'.$avatar.'</li>';
	$return_string .= '<li>'.$linkedAuthor.'</li>';
	$return_string .= '<li>'.$mod_date.'</li>';
	$return_string .= '<ul>';

	return $return_string;
}


function register_shortcodes(){
	add_shortcode('post_credits','post_credits_shortcode');
 }

 add_action( 'init', 'register_shortcodes');

// display the recent posts
function recent_posts_function($atts){
	extract(shortcode_atts(array(
	   'posts' => 1,
	), $atts));
 
	$return_string = '<ul>';
	query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
	if (have_posts()) :
	   while (have_posts()) : the_post();
		  $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>
		  					<li>Posted: '.get_the_date( 'F j, Y' ).'</li>';
	   endwhile;
	endif;
	$return_string .= '</ul>';
 
	wp_reset_query();
	return $return_string;
 }
 function register_recent_posts_shortcodes(){
	add_shortcode('recent-posts', 'recent_posts_function');
 }

 add_action( 'init', 'register_recent_posts_shortcodes');

 // End of recent posts

//Adding Title 

    function twentytwenty_child_theme_setup() {
    
        
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
        add_image_size( 'twentytwenty-child-blog-thumbnail', 260, 175, true );
        add_image_size( 'twentytwenty-child-blog-large', 1200, 800, true );
        add_image_size( 'twentytwenty-child-blog-custom', 900, 100, false);
        add_image_size( 'custom-image-square', 600, 600, true );
        add_image_size( 'blog-width', 800, 600 );

         
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

    add_action( 'after_setup_theme', 'twentytwenty_child_theme_setup');


	function hstngr_register_widget() {
		register_widget( 'hstngr_widget' );
		}
		add_action( 'widgets_init', 'hstngr_register_widget' );
		class hstngr_widget extends WP_Widget {
		function __construct() {
		parent::__construct(
		// widget ID
		'hstngr_widget',
		// widget name
		__('Hostinger Sample Widget', ' hstngr_widget_domain'),
		// widget description
		array( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
		);
		}
		public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		//if title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		//output
		echo __( 'Greetings from Hostinger.com!', 'hstngr_widget_domain' );
		echo $args['after_widget'];
		}
		public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Default Title', 'hstngr_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
		}
		public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
		}
		}


// Loading CSS
// if ( ! function_exists( 'twentytwenty_child_styles_setup' ) ) :
//     function twentytwenty_child_styles_setup() {
//         wp_register_style(
//             'normalize',
//             get_stylesheet_directory_uri() . '/assets/css/normalize.css',
//             array(),
//             false,
//             'all'
//         );
//         wp_enqueue_style('normalize');

//         wp_register_style(
//             'bootstrap',
//             get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
//             array(),
//             false,
//             'all'
//         );

//         wp_enqueue_style('bootstrap');

//         wp_register_style(
//             'theme_css',
//             get_stylesheet_directory_uri() . '/assets/css/main.css',
//             array('normalize', 'bootstrap'),
//             filemtime(get_template_directory(). '/assets/css/main.css'),
//             'all'
//         );

//         wp_enqueue_style('theme_css');
//     }
// endif; // CSS setup
//     add_action( 'wp_enqueue_scripts', 'twentytwenty_child_styles_setup' );


?>