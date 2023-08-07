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
		<div class="page-wrap">
			<div class="card">
				<div class="card-body">
					<h4><?php the_title(); ?></h4>
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
					<?php
                    if ( !the_author() ) {
                        echo the_author();
                    } ?>
					<?php echo get_the_date(); ?>
					<?php
						
						$fname = get_the_author_meta('first_name');
						$lname = get_the_author_meta('last_name');
						echo $fname .' ' . $lname;
					?>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" >Read More</a>
				</div>
			</div>
		</div>
	<?php endwhile;
else :
	echo "<p class='no-posts'>" . __( "Sorry, there are no posts at this time." ) . "</p>";
endif;

?> 
 
