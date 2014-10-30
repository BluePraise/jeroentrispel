<?php
/*
* Template Name: Front Page
*/
get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      // the_content();
      endwhile;
      wp_reset_query();
      endif;
    ?>

<?php
// else:

get_footer();
?>

