<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DSU
 */
get_header();
?>
<div class="">
    <?php if ( is_home() ) : ?>
        <h1 class="page-title"><?php single_post_title(); ?></h1>
        <?php
            if ( has_post_thumbnail() ): // check if the post has a Post Thumbnail assigned to it.
                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                <div class="blog-post-thumb">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                </div>
        <?php
            endif;
        ?>
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                <div class="blog-posts">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php the_excerpt(); ?>
            </div>
            <?php endwhile;
            else :
                echo "<p class='no-posts'>" . __( "Sorry, there are no posts at this time." ) . "</p>";
            endif;
            ?> 
    <?php endif; ?>
    
</div>
<?php get_footer(); ?>