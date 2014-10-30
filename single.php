<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

      <?php  while ( have_posts() ) : the_post();?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-header">

                <h2 class="entry-title"><?php the_title(); ?></h2>
                      <?php if ( ! post_password_required()) :
                      edit_post_link( __( 'Edit', '' ), '<span class="edit-link">', '</span>' );
                      endif;
                ?>

            </div><!-- .entry-header -->

            <div class="entry-content">

              <?php the_content(); ?>
            </div><!-- .entry-content -->

            <div class="entry-footer">

              <div class="page-nav">
                <!-- IF MORE THAN ONE POST THAN SHOW LINK -->
                <ul>
                  <li class="prev-link icomayconnect"><?php previous_post_link(' %link'); ?></li>
                  <li class="next-link icomayconnect"><?php next_post_link(' %link'); ?></li>
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

