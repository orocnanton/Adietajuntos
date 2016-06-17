<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 15/6/16
 * Time: 23:24
 */
?>
<?php get_header(); ?>
	<div id="primary" class="content-area w3-container w3-col l12 s12">
		<?php if ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( ! post_password_required( $post->ID ) ) : ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="image">
							<?php the_post_thumbnail( 'blog-large' ); ?>
						</div>
					<?php endif; ?>
				<?php endif; // password check ?>
				<h3 class="entry-title"><?php the_title(); ?></h3>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer();
// Omit closing PHP tag to avoid "Headers already sent" issues.
