<?php
/*
* Template Name: Blog Page
* Description: Contains blog without Portfolio category.
*/

get_header();
?>

<ul>
<?php
$query = new WP_Query( 'cat=-2' );
  while ( $query->have_posts() ) : $query->the_post() ?>
  <li id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>

   <div class="entry-header">
      <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ;?></a></h2>
        <div class="comments-link">
          <?php
          if ( comments_open() && have_comments() || get_comments_number()) :
              comments_popup_link( '<span class="leave-reply italic">' . __( 'Comments', '' ) . '</span>', __( 'One genius comment', '' ), __( '%', '' ) );
          endif; ?>
        </div><!-- .comments-link -->
        <div class="entry-meta"><span class="entry-date">Geplaatst op: <?php the_date();?></span><span class="entry-author"><?php the_author();?></span></div>
    </div><!-- .entry-header -->
    <div class="entry-body">
        <?php the_excerpt('new_excerpt_more'); ?>
    </div>

  </li><!-- #post -->
<?php
  // wp_reset_postdata();
  endwhile;
  // get_footer();
?>
</ul>

