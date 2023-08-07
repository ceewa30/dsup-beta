<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="actual-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile;
else :
	echo "<p class='no-posts'>" . __( "Sorry, there are no posts at this time." ) . "</p>";
endif;

?> 
 
