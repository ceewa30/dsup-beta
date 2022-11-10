<?php
/**
 * DemocracyStraighUp's functions and definitions
 *
 * @package DemocracyStraighUp
 * @since DemocracyStraighUp 1.0
 */

get_header(); ?>

<div class="page-wrap">

    <?php get_template_part('includes/section','archive'); ?>

    <!-- previous_posts_link();  next_posts_link();  -->
    

    <?php
    global $wp_query;
    $big = 999999999; //need an unlikely integer
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%' ,
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
    ) );
    ?>
</div>


<?php get_footer(); ?>