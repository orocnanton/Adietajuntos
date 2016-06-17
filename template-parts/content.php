<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		<?php
		if ( has_post_thumbnail() ) {
			$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'background' );
			$post_image = $post_image[0];
			echo '<div class="post-image" style="background-image:url(' . esc_url( $post_image ) . ');" alt="' . esc_attr( get_the_title() ) . '"></div>';
		}
		?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>' ); ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		if ( function_exists( 'verano_truncate_by_words' ) ) {
			echo esc_html( verano_truncate_by_words( get_the_excerpt(), 250, '...' ) );
		} else {
			the_excerpt();
		}

		wp_link_pages( array(
		'before' => '
		<div class="page-links"><span class="page-links-title">' . __( 'Pages:',
					'twentysixteen' ) . '</span>',
			'after' => '
		</div>
		',
		'link_before' => '<span>',
			'link_after'  => '</span>',
		'pagelink' => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
		'separator' => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<a class="w3-btn" href="<?php the_permalink(); ?>"><?php _e( 'Leer más', 'verano' ); ?></a>
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
