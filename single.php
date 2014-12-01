<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

      <?php  while ( have_posts() ) : the_post();?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-header">

                <h2 class="entry-title"><?php the_title(); ?></h2>
                <div class="entry-meta">
                  <span class="entry-date">Geplaatst op: <?php the_date();?></span>
                  <span class="entry-author"><?php the_author();?></span>
                </div>

                  <?php if ( ! post_password_required()) :
                          jeroentrispel_edit_link();
                  endif;?>
            
            </div><!-- .entry-header -->
                
            <?php if ( has_post_thumbnail( $post_id )) : // If an article has a featured image
                echo "<span class='page-feature-image'>";
                  the_post_thumbnail( );
                echo "</span>";
              endif; ?>

            <div class="entry-content">
              <?php the_content(); ?>
            </div><!-- .entry-content -->

            <div class="entry-footer">

              <div class="page-nav">
                <!-- IF MORE THAN ONE POST THAN SHOW LINK -->
                <ul>
                  <li class="prev-link"><?php previous_post_link(' %link'); ?></li>
                  <li class="next-link"><?php next_post_link(' %link'); ?></li>
                </ul>
              </div>

                <?php comments_template(); ?>
            </div><!-- .entry-meta -->

        </article><!-- #post -->
<?php endwhile; ?>

    </div>

<?php
  // get_footer();
?>

