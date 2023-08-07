<?php
/**
 * DemocracyStraighUp's Header and definitions
 *
 * @package DemocracyStraighUp
 * @since DemocracyStraighUp 1.0
 */

 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); wp_title( '|', true, 'left' ); ?></title>

    <?php wp_head(); ?>

</head>
<body <?php body_class('no-js'); ?> id="site-container">
<?php
    if ( function_exists('wp_body_open') ) {
        wp_body_open();
    }
?>
<header class="site-header">
            <div class="row header">
                <div class="col-sm-4">
                  <div class="header-logo">
                    <?php if( has_custom_logo() ):  ?>
                        <?php
                            // Get Custom Logo URL
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            // var_dump( $custom_logo_id );
                            $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id );
                            // var_dump( $custom_logo_data );
                            $custom_logo_url = $custom_logo_data[0];
                            // var_dump( $custom_logo_url );
                        ?>

                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                           title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                           rel="home">

                            <img src="<?php echo esc_url( $custom_logo_url ); ?>"
                                 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>

                        </a>
                        <div class="description"><?php echo esc_attr( get_bloginfo( 'description' ) ); ?></div>
                        <?php else: ?>
                            <div class="site-name"><?php bloginfo( 'name' ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-8">
                    <nav class="primary-navigation">
                        <?php
                            wp_nav_menu( array(
                                'theme_location'  => 'header',
                            ) );
                        ?>
                    </nav>
                    
                </div>
            </div>
</header>
    
