<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 16/6/16
 * Time: 23:36
 */
?>
<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area w3-container w3-col l8 s12 <?php verano_opten_layout(); ?>">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single_testimonio' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				get_template_part('layouts/post-nextprev');
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php if ( is_active_sidebar( 'related-post' )) : ?>
		<aside id="related-post" role="complementary">
			<?php dynamic_sidebar( 'related-post' ); ?>
		</aside><!-- .sidebar .widget-area -->
	<?php endif; ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
