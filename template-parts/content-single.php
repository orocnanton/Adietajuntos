<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
	$verano_subtitle_meta = get_post_meta($post->ID, 'verano_subtitle', true);
	$verano_subtitle_meta = (!empty($verano_subtitle_meta) ? get_post_meta($post->ID, 'verano_subtitle', true) : "" );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<?php
			if(has_post_thumbnail()){
				$post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single');
				$post_image = $post_image[0];
				echo '<div class="post-image" style="background-image:url(' . esc_url($post_image) . ');" alt="' . esc_attr(get_the_title()) . '"></div>';
			}
		?>
		

		<?php esc_attr(the_title( '<h1 class="entry-title">', '</h1>' )); ?>
		<?php if (!empty($verano_subtitle_meta)) : ?>
			<h2><?php echo esc_html($verano_subtitle_meta); ?></h2>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
