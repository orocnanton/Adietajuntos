<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
	$verano_subtitle_meta = get_post_meta($post->ID, 'verano_subtitle', true);
	$verano_pagelayout_style = get_post_meta($post->ID, 'verano_pagelayout_style', true);
	$verano_subtitle_meta = (!empty($verano_subtitle_meta) ? get_post_meta($post->ID, 'verano_subtitle', true) : "" );
	$verano_postpage_style_meta = get_post_meta($post->ID, 'verano_postpage_style', true);

get_header(); ?>

<div id="primary" class="content-area w3-container w3-col l8 s12 <?php verano_opten_layout(); ?>">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php if($verano_pagelayout_style != "pagelayout-fullwidth"){ ?>
		<?php get_sidebar(); ?>
<?php } ?>

<?php get_footer(); ?>