<?php
/**
 * The front page file
 *
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage verano
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area w3-col l12">
		<main id="main" class="site-main" role="main">

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div class="slider-home w3-row">
				<?php if ( ! is_user_logged_in() ) :?>
					<div class="flexslider w3-half">
						<ul class="slides">
							<?php if (function_exists( 'ot_get_option' )) {

								/* get the slider array */
								$slides = ot_get_option( 'slider', array() );
								if ( ! empty( $slides )) {
									foreach ($slides as $slide) {
										echo '
								<li>
									<div class="w3-container">' . $slide['description'] . '</div>
								</li>';
									}
								}
							}
							?>
						</ul>
					</div>
					<div class="w3-half w3-container"><?php echo do_shortcode('[bbp-login]'); ?><br><a href="/membership-account/niveles-de-membresia/">Registrate</a></div>
				<?php else : ?>
					<div class="flexslider">
						<ul class="slides">
							<?php if (function_exists( 'ot_get_option' )) {

								/* get the slider array */
								$slides = ot_get_option( 'slider', array() );
								if ( ! empty( $slides )) {
									foreach ($slides as $slide) {
										echo '
								<li class="w3-container">
									<div class="w3-content">' . $slide['description'] . '</div>
								</li>';
									}
								}
							}
							?>
						</ul>
					</div>
				<?php endif; ?>
			</div><!-- Flex Slider -->


			<div class="front-page presentacion">
				<?php if ( function_exists( 'ot_get_option' ) ) : ?>
					<?php $front_page_a_content = ot_get_option( 'front_page_a_content' ); ?>
					<div class="w3-content w3-container"><?php echo $front_page_a_content; ?></div>
				<?php endif; ?>
			</div>


			<div class="front-page destacados w3-content w3-row">
				<?php if ( function_exists( 'ot_get_option' ) ) : ?>
					<?php $destacados = ot_get_option( 'destacados', array() ); ?>

					<?php foreach( $destacados as $destacado) { ?>
						<div class="w3-third w3-container">
							<?php $category_link = get_category_link( $destacado['link_destacado'] ); ?>
							<a href="<?php echo esc_url( $category_link ); ?>"><img class="size-medium aligncenter" src="<?php echo $destacado['imagen_destacado'];?>"></a>
							<h3 class="w3-center"> <?php echo esc_html(get_cat_name($destacado['link_destacado'])); ?></h3>
							<p><?php echo $destacado['contenido'];?></p>
							<a class="w3-btn-block"  href="<?php echo esc_url( $category_link ); ?>">Leer más</a>
						</div>
					<?php } ?>

				<?php endif; ?>
			</div>

			<div class="front-page testimonios">
				<?php if ( is_active_sidebar( 'front-page-2' ) ) : ?>
					<aside id="front-button" class="widget-area w3-content w3-row" role="complementary">
						<?php dynamic_sidebar( 'front-page-2' ); ?>
					</aside><!-- .sidebar .widget-area -->
				<?php endif; ?>
			</div>

			<div class="front-page precios w3-content w3-row ">
				<?php if ( function_exists( 'ot_get_option' ) ) : ?>
					<?php $niveles = ot_get_option( 'niveles', array() ); ?>

					<?php foreach( $niveles as $nivel) { ?>
						<div class="w3-col s12 m6 w3-container">
							<p><span class="dashicons dashicons-awards"></span></p>
							<h2> <?php echo $nivel['titulo_nivel'];?> </h2>
							<h3> <?php echo $nivel['precio_nivel']; ?> € por mes</h3>
							<p><?php echo $nivel['descripcion_nivel']; ?></p>
							<a class="w3-btn-block" href="<?php echo $nivel['boton_nivel']; ?>">Apúntate</a>
						</div>
					<?php } ?>

				<?php endif; ?>
			</div>

			<div class="front-page recent-post">
				<?php if ( is_active_sidebar( 'front-page-1' ) ) : ?>
					<aside id="front-top" class="widget-area w3-content w3-animate-bottom" role="complementary">
						<?php dynamic_sidebar( 'front-page-1' ); ?>
					</aside><!-- .sidebar .widget-area -->

				<?php endif; ?>
			</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->


<?php get_footer(); ?>