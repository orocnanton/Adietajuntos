<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 15/6/16
 * Time: 23:15
 */

get_header(); ?>

<div id="primary" class="content-area w3-container <?php verano_opten_layout(); ?>">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( ! post_password_required( $post->ID ) ) : ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="image">
							<?php the_post_thumbnail( 'blog-large' ); ?>
						</div>
					<?php endif; ?>
				<?php endif; // password check ?>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endif; ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
<!-- Omit closing PHP tag to avoid "Headers already sent" issues.-->
