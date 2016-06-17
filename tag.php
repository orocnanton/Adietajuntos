<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 4/6/16
 * Time: 0:04
 */
get_header(); ?>

<div id="primary" class="content-area w3-container w3-col l8 s12 <?php verano_opten_layout(); ?>">
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header tag w3-container">
				<div class="title">
					<h1><span class="genericon genericon-tag"></span><?php esc_html(single_tag_title()); ?></h1>
				</div>
				<a href="<?php echo esc_url(home_url('/')); ?>"><span class="genericon genericon-previous home"></span></a>
			</header><!-- .page-header -->
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page',
						'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>
	<!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
