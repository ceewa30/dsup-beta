<?php
/**
 * DemocracyStraighUp's functions and definitions
 *
 * @package DemocracyStraighUp
 * @since DemocracyStraighUp 1.0
 */

get_header(); ?>

<div class="page-wrap">
<?php
            if ( has_post_thumbnail() ): // check if the post has a Post Thumbnail assigned to it.
                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                <div class="blog-post-thumb">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" class="img-fluid" /></a>
                </div>
        <?php
            endif;
        ?>
    
    <?php get_template_part('includes/section','blogcontent'); ?>

    <?php 
			$tags = get_the_tags();
			foreach($tags as $tag) : ?>
			<a href="<?php the_permalink(); ?>" >
				<?php echo $tag->name; ?>
			</a>
			<?php endforeach;
		?>
</div>


<?php get_footer(); ?>