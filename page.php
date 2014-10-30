<?php
/*
* Template Name: Default Page
*/
get_header();
?>
<h2 class="page-title"><?php the_title(); ?></h2>
<article class="content page-content">

<?php
    the_content();
    jeroentrispel_edit_link();

  ?>
</article>

<?php get_footer();?>
