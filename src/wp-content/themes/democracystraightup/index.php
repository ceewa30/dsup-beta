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
<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="blog-posts">
        
        <?php if ( has_post_thumbnail() ) :
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                        <div class="blog-post-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                        </div>
                    <?php endif; 
                    /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );
            ?>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile;
else :
	echo "<p class='no-posts'>" . __( "Sorry, there are no posts at this time." ) . "</p>";
endif;

?> 
<div class="mt-5">
    <div class="">
        <div class="blog-posts">
        <?php if ( have_posts() ): ?>
            <?php while( have_posts() ): ?>
                <?php the_post(); ?>
                <div class="blog-post">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if ( has_post_thumbnail() ) :
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                        <div class="blog-post-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                        </div>
                    <?php endif; 
                    /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );
            ?>
                    <?php the_excerpt(); ?>
                    <a class="read-more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read More' ); ?></a>
                    <div class="posted-in">
                        <span><?php _e( 'Posted In', 'dsu' ); ?></span>
                        <span><?php the_category( ', ' ); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p><?php _e( 'No Blog Posts found', 'dsu' ); ?></p>
        <?php endif; ?>
        </div>
    </div>
</div>

</div>

<?php get_footer(); ?>