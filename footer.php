<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 */
?>
  </main><!-- #main -->
    <footer id="colophon" class="site-footer" role="contentinfo">

        <!-- <div class="footer-info contactinfo"> -->
          <!-- <p>Jeroen Trispel</p> -->
          <!-- <p>Arnhem, The Netherlands</p> -->
          <!-- <a class="icon-mail" href="mailto:info@jeroentrispel.com">info@jeroentrispel.com</a></p> -->

        <!-- </div> -->
         <div class="footer-info copyright">
          <span>Copyright <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Email"><?php echo bloginfo();?> </a> <?php echo date('Y'); ?>.</span>
        </div> <!--end footerinfo -->
    </footer><!-- #colophon -->
</div><!-- #page -->

  <?php wp_footer(); ?>
</body>
</html>

