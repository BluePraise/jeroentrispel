<?php
/*
* Template Name: Default Page
*/
get_header(); ?>

<h2 class="page-title"><?php the_title(); ?></h2>
<article class="content page-content">
<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
    endwhile;
    endif;
    jeroentrispel_edit_link();

  ?>
</article>

<?php get_footer();?>
