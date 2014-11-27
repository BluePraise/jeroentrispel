<?php
/*
* Template Name: Default Page
*/
get_header(); ?>

<h2 class="page-title"><?php the_title(); ?></h2>
<article class="content page-content">
<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();

  	if ( has_post_thumbnail( $post_id )) :
  		echo "<span class='page-feature-image'>";
	  		the_post_thumbnail( );
  		echo "</span>";
  	endif;
  	echo "<div class='body-content'>";
	    the_content();
	  echo "</div>";  
    
    endwhile;
    endif;
    jeroentrispel_edit_link();

  ?>
</article>

<?php get_footer();?>
