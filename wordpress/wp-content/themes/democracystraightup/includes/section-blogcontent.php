<?php

    if ( have_posts() ) :
	    while ( have_posts() ) : the_post(); 
?>
		    <div class="post-content">
            <h4><?php the_title(); ?></h4>
                <div class="author-img">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                    <span class="author-name">
                        <?php
                        if (!is_author()) {
                            global $post;
                            $post_id = $post->ID;
                            $author = get_the_author($post_id);
                            $linkedAuthor = "<a href='/about'>".$author."</a>";
                            echo $linkedAuthor;
                        }
                        else {
                            $fname = get_the_author_meta('first_name');
                            $lname = get_the_author_meta('last_name');
                            echo $fname .' ' . $lname;
                        }
					?>
                        <?php echo get_the_date(); ?>
                    </span>
					
					
                    </div>
<?php 
                    the_content(); 
?>
		    </div>  
            <?php 
			$tags = get_the_title();
			foreach($tags as $tag) : ?>
			<a href="<?php the_permalink(); ?>" >
				<?php echo $tag->name; ?>
			</a>
			<?php endforeach;
		?>
        
<?php 
        endwhile;
    else :
	    echo "<p class='no-posts'>" . __( "Sorry, there are no posts at this time." ) . "</p>";
    endif;
?> 