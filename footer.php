<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="w3-content">
				<div class="w3-row">
					<?php if ( is_active_sidebar( 'footer-sidebar-1' ) && ! is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
						<aside id="footer-sidebar-1" role="complementary">
						<div class="w3-col l12 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
						</div>
						</aside><!-- .sidebar .widget-area -->  

		        	<?php elseif ( is_active_sidebar( 'footer-sidebar-1' ) && is_active_sidebar( 'footer-sidebar-2' ) && ! is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
						<aside id="footer-sidebar-1" role="complementary">
						<div class="w3-col l6 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
						</div>
						<div class="w3-col l6 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
						</div>	
						</aside><!-- .sidebar .widget-area -->  

		        	<?php elseif ( is_active_sidebar( 'footer-sidebar-1' ) && is_active_sidebar( 'footer-sidebar-2' ) && is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
						<aside id="footer-sidebar-1" role="complementary">
						<div class="w3-col l4 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
						</div>
						<div class="w3-col l4 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
						</div>	
						<div class="w3-col l4 w3-container">
							<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
						</div>
						</aside><!-- .sidebar .widget-area -->        	
		        	<?php endif; ?>
		        </div>

				<div class="site-info">
					<?php
						/**
						 * Fires before the twentysixteen footer text for footer customization.
						 *
						 * @since Twenty Sixteen 1.0
						 */
						do_action( 'twentysixteen_credits' );
					?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span> © <?php echo esc_html( date('Y'));?>
				</div><!-- .site-info -->
			</div>
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
