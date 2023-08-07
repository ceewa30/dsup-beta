<?php
/**
 * DemocracyStraighUp's Footer and definitions
 *
 * @package DemocracyStraighUp
 * @since DemocracyStraighUp 1.0
 */

 ?>
    <footer class="site-footer">
        <?php if ( is_active_sidebar( 'footer-section-one' ) ) : ?>
            <div class="footer-section-one">
                <?php dynamic_sidebar( 'footer-section-one' ); ?>
            </div>
        <?php endif; ?>
        <div class="footer-menu">
        <?php
            wp_nav_menu( array(
                'theme_location'  => 'footer',
            ) );
        ?>
        </div>
        <div class="footer-slogon">
        <?php if ( is_active_sidebar( 'footer-section-two' ) ) : ?>
            <div class="footer-section-two">
                <?php dynamic_sidebar( 'footer-section-two' ); ?>
            </div>
        <?php endif; ?>
        </div>
        <div class="copyright">
            <p><?php printf( __( '%s. All right reserved &copy; %s', 'dsu' ), get_bloginfo('name'), date_i18n( 'Y' ) ); ?></p>
        </div>
    </footer><!-- End of Footer -->

<?php wp_footer(); ?>

</body>
</html>