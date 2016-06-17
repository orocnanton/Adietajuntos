<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 21/5/16
 * Time: 0:14
 */
/* Testimonios widget */

class testimoniosWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'columns_widget',
			__( 'Verano Testimonios slider', 'Verano' ),
			array(
				'description' => __( 'Muestra los testimonios de la web', 'verano' ),
			)
		);
	}

	function widget( $args, $instance ) {
		$type     = 'testimonios';
		$args     = array(

			'post_type'           => $type,
			'post_status'         => 'publish',
			'posts_per_page'      => 4,
			'order_by'            => 'date',
			'ignore_sticky_posts' => 1
		);
		$my_query = null;
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ) {
			?>
			<div class="testimonios flexslider w3-container">
				<ul class="slides">
					<?php
					while ( $my_query->have_posts() ) : $my_query->the_post();
						?>

						<li>
							<?php the_excerpt(); ?>
							<div class="autor">
								<?php if ( has_post_thumbnail() ) {
									$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_small' );
									$post_image = $post_image[0];
									echo '<div class="autor-img" style="background-image:url(' . esc_url( $post_image ) . ');" alt="' . esc_attr( get_the_title() ) . '"></div>';
								}
								echo '<h3><a href="' . esc_attr( get_the_permalink() ) . '">' . esc_attr( get_the_title() ) . '</a></h3>';
								echo '</div>';
						?>

						</li>
						<?php
					endwhile;
					?>
				</ul><!--/testimonial-->
			</div>    <!--/testimonialover-->
			<?php
		}
		wp_reset_query();
	}
}

/* END - Testimonials slider widget */

/* Sobre nosotros Widget */

class aboutUsWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'about_us_widget',
			__( 'Verano Sobre nosotros - Verano (para la página principal)', 'verano' ),
			array(
				'description' => __( 'Widget para mostrar contenido sobre nosotros en la home del sítio', 'verano' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$text           = $instance['text'];
		$left_title     = $instance['left_title'];
		$right_title    = $instance['right_title'];
		$right_subtitle = $instance['right_subtitle'];
		if ( isset( $left_title ) && $left_title != '' ) {
			echo '<div class="headlineone">' . $left_title . '</div>';
		}
		if ( ( isset( $right_title ) && $right_title != "" ) || ( isset( $right_subtitle ) && $right_subtitle != "" ) || ( isset( $text ) && $text != '' ) ):
			echo '<div class="textboxone">';
			if ( isset( $right_title ) && $right_title != "" ) {
				echo "<h3>" . $right_title . "</h3>";
			}
			if ( isset( $right_subtitle ) && $right_subtitle != "" ) {
				echo "<b>" . $right_subtitle . "</b>";
			}
			if ( isset( $text ) && $text != '' ) {
				echo "<p>" . $text . "</p>";
			}
			echo '</div>';
		endif;
		echo '<div class="clearfix"></div>';

	}

	public function form( $instance ) {
		if ( isset( $instance['text'] ) ) {
			$text = $instance['text'];
		} else {
			$text = __( 'Contenido de ejemplo: Somos una empresa dedicada a la venta de objetos que no tienen una funcionalidad definida.',
				'verano' );
		}
		if ( isset( $instance['left_title'] ) ) {
			$left_title = $instance['left_title'];
		} else {

			$left_title = __( "Contenido para el subtítulo", 'verano' );
		}
		if ( isset( $instance['right_title'] ) ) {
			$right_title = $instance['right_title'];
		} else {

			$right_title = __( "Que servicios ofrecemos", 'verano' );
		}
		if ( isset( $instance['right_subtitle'] ) ) {
			$right_subtitle = $instance['right_subtitle'];
		} else {
			$right_subtitle = "";
		}
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'left_title' ); ?>"><?php _e( 'Left side title :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'left_title' ); ?>"
			       name="<?php echo $this->get_field_name( 'left_title' ); ?>" type="text"
			       value="<?php echo esc_attr( $left_title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'right_title' ); ?>"><?php _e( 'Right side title :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'right_title' ); ?>"
			       name="<?php echo $this->get_field_name( 'right_title' ); ?>" type="text"
			       value="<?php echo esc_attr( $right_title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'right_subtitle' ); ?>"><?php _e( 'Right side subtitle :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'right_subtitle' ); ?>"
			       name="<?php echo $this->get_field_name( 'right_subtitle' ); ?>" type="text"
			       value="<?php echo esc_attr( $right_subtitle ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text :', 'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>"
			       name="<?php echo $this->get_field_name( 'text' ); ?>" type="text"
			       value="<?php echo esc_attr( $text ); ?>"/>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance                   = array();
		$instance['text']           = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['left_title']     = ( ! empty( $new_instance['left_title'] ) ) ? strip_tags( $new_instance['left_title'] ) : '';
		$instance['right_title']    = ( ! empty( $new_instance['right_title'] ) ) ? strip_tags( $new_instance['right_title'] ) : '';
		$instance['right_subtitle'] = ( ! empty( $new_instance['right_subtitle'] ) ) ? strip_tags( $new_instance['right_subtitle'] ) : '';

		return $instance;
	}
}

/* Fin Sobre nosotros */

/* Últimas entradas de una categoria */

class ultimasentradasWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'ultimasentradasWidget',
			__( 'Verano Últimas entradas de una categoría', 'verano' ),
			array(
				'description' => __( 'Muestra las dos últimas entradas de la categoría elegida',
					'verano' ),
			)
		);
	}

	function form( $instance ) {
		if ( isset( $instance['categoria'] ) ) {

			$nr_post = $instance['categoria'];
		} else {

			$nr_post = 'content';
		}
		?>
		<p>
		<label
			for="<?php echo $this->get_field_id( 'categoria' ); ?>"><?php _e( 'Categoría de los artículos:',
				'verano' ); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id( 'categoria' ); ?>"
		       name="<?php echo $this->get_field_name( 'categoria' ); ?>" type="text"
		       value="<?php echo esc_attr( $nr_post ); ?>"/>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['categoria'] = ( ! empty( $new_instance['categoria'] ) ) ? strip_tags( $new_instance['categoria'] ) : '';

		return $instance;
	}

	function widget( $args, $instance ) {
		$nr_post  = apply_filters( 'widget_title', $instance['categoria'] );
		$type     = 'post';
		$args     = array(
			'post_type'           => $type,
			'post_status'         => 'publish',
			'posts_per_page'      => 2,
			'category_name'       => $nr_post,
			'ignore_sticky_posts' => 1

		);
		$my_query = null;
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ) {
			?>
			<div class="w3-row">
				<h2>Últimas entradas</h2>
				<?php
				while ( $my_query->have_posts() ) : $my_query->the_post();
					?>
					<div class="w3-half w3-container">
						<?php if ( has_post_thumbnail() ) {
							$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single' );
							$post_image = $post_image[0];
							echo '<div class="post-image" style="background-image:url(' . esc_url( $post_image ) . ');" alt="' . esc_attr( get_the_title() ) . '"></div>';

						} ?>

						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>

					</div>
					<?php
				endwhile;
				?>
			</div>
			<?php
		}
		wp_reset_query();
	}
}

/* END - Últimas entradas de una categoria widget */


/* Destacado home Widget */

class destacadosWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'destacados_widget',
			__( 'Verano Destacados para la home', 'verano' ),
			array(
				'description' => __( 'Widget para mostrar un destacados en la home',
					'verano' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$texto          = $instance['texto'];
		$left_title     = $instance['url'];
		$right_title    = $instance['titulo'];
		$right_subtitle = $instance['link'];
		$link_content   = 'Leer más';

		if ( ( isset( $left_title ) && $left_title != '' ) || ( isset( $right_title ) && $right_title != "" ) || ( isset( $right_subtitle ) && $right_subtitle != "" ) || ( isset( $texto ) && $texto != '' ) ):
			echo '<div class="w3-third w3-container">';
			if ( isset( $left_title ) && $left_title != '' ) {
				echo "<img src='" . $left_title . "'>";
			}
			if ( isset( $right_title ) && $right_title != "" ) {
				echo "<h3>" . $right_title . "</h3>";
			}
			if ( isset( $texto ) && $texto != '' ) {
				echo "<p>" . $texto . "</p>";
			}
			if ( isset( $right_subtitle ) && $right_subtitle != "" ) {
				echo "<a class='w3-btn' href='" . $right_subtitle . "'>" . $link_content . "</a>";
			}
			echo '</div>';
		endif;

	}

	public function form( $instance ) {
		if ( isset( $instance['texto'] ) ) {
			$texto = $instance['texto'];
		} else {
			$texto = __( 'Contenido del destacado.',
				'verano' );
		}
		if ( isset( $instance['url'] ) ) {
			$left_title = $instance['url'];
		} else {

			$left_title = __( "Contenido para el subtítulo", 'verano' );
		}
		if ( isset( $instance['titulo'] ) ) {
			$right_title = $instance['titulo'];
		} else {

			$right_title = __( "Que servicios ofrecemos", 'verano' );
		}
		if ( isset( $instance['link'] ) ) {
			$right_subtitle = $instance['link'];
		} else {
			$right_subtitle = "";
		}
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'url de la imagen :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>"
			       name="<?php echo $this->get_field_name( 'url' ); ?>" type="text"
			       value="<?php echo esc_attr( $left_title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'titulo' ); ?>"><?php _e( 'Título :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'titulo' ); ?>"
			       name="<?php echo $this->get_field_name( 'titulo' ); ?>" type="text"
			       value="<?php echo esc_attr( $right_title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link :',
					'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>"
			       name="<?php echo $this->get_field_name( 'link' ); ?>" type="text"
			       value="<?php echo esc_attr( $right_subtitle ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'texto' ); ?>"><?php _e( 'Texto :', 'verano' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'texto' ); ?>"
			       name="<?php echo $this->get_field_name( 'texto' ); ?>" type="text"
			       value="<?php echo esc_attr( $texto ); ?>"/>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = array();
		$instance['texto']  = ( ! empty( $new_instance['texto'] ) ) ? strip_tags( $new_instance['texto'] ) : '';
		$instance['url']    = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['titulo'] = ( ! empty( $new_instance['titulo'] ) ) ? strip_tags( $new_instance['titulo'] ) : '';
		$instance['link']   = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}
}

/* Fin Destacados home */

/* LATEST POSTS WIDGET */

class verano_widget_latest_posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'verano_widget_latest_posts',
			'Verano Últimas entradas',
			array( 'description' => 'Muestra las últimas entradas del blog.' )
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		$active_post = 0;
		if ( is_single() ) {
			$active_post = $post->ID;
		}
		$verano_latest_posts = array(
			'numberposts'  => $instance['postcount'],
			'meta_key'     => '_thumbnail_id',
			'post__not_in' => array( $active_post )
		);
		if ( ! isset( $instance['allformats'] ) ) {
			$verano_latest_posts['tax_query'] = array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array(
						'post-format-aside',
						'post-format-audio',
						'post-format-chat',
						'post-format-gallery',
						'post-format-image',
						'post-format-link',
						'post-format-quote',
						'post-format-status',
						'post-format-video'
					),
					'operator' => 'NOT IN'
				)
			);
		}
		$verano_latest_posts = get_posts( $verano_latest_posts );
		if ( count( $verano_latest_posts ) > 0 ) { ?>
			<section class="widget latestposts">
				<?php if ( $instance['title'] != '' ) { ?>
					<h2 class="widget-title"><?php echo esc_html( $instance['title'] ); ?></h2>
				<?php }
				foreach ( $verano_latest_posts as $post ) {
					setup_postdata( $post );
					$verano_thumb_id  = get_post_thumbnail_id();
					$verano_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
					$verano_category  = get_the_category();
					?>
					<article class="w3-row">
						<div class="top">
							<a class="w3-quarter" href="<?php echo esc_url( the_permalink() ); ?>">
								<img src="<?php echo esc_url( $verano_thumb_url[0] ); ?>">
							</a>
							<div class="w3-threequarter w3-container">
								<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_url( the_title() ); ?></a>
								<p><?php if ( function_exists( 'verano_truncate_by_words' ) ) {
										echo esc_html( verano_truncate_by_words( get_the_excerpt(), 90, '...' ) );
									} else {
										the_excerpt();
									} ?></p>
							</div>
						</div>

					</article>
					<?php
				}
				wp_reset_postdata();
				?>
			</section>
			<?php
		}
	}

	public function form( $instance ) {
		$defaults = array(
			'title'      => '',
			'postcount'  => '3',
			'allformats' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of Posts to show: </label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>"
			       name="<?php echo $this->get_field_name( 'postcount' ); ?>" type="number"
			       value="<?php echo esc_attr( $instance['postcount'] ); ?>" min="1" max="6"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'allformats' ); ?>">Show All Post Formats: </label>
			<input id="<?php echo $this->get_field_id( 'allformats' ); ?>"
			       name="<?php echo $this->get_field_name( 'allformats' ); ?>"
			       type="checkbox" <?php checked( $instance['allformats'], 'on' ); ?> />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $new_instance as $key => $value ) {
			$instance[ $key ] = ( ! empty( $new_instance[ $key ] ) ) ? strip_tags( $new_instance[ $key ] ) : '';
		}

		return $instance;
	}

}

/*-----------------------------------------------------------------------------------*/

/* RELATED POSTS WIDGET
/*-----------------------------------------------------------------------------------*/

class verano_widget_related_posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'verano_widget_related_posts',
			'verano Related Posts',
			array( 'description' => 'Muestra entradas relacionados en la pagina single.' )
		);
	}

	public function widget( $args, $instance ) {
		if ( is_single() ) {
			global $post;
			$verano_related_posts = array(
				'numberposts'  => $instance['postcount'],
				'category__in' => wp_get_post_categories( $post->ID ),
				'meta_key'     => '_thumbnail_id',
				'post__not_in' => array( $post->ID ),
			);
			if ( ! isset( $instance['allformats'] ) ) {
				$verano_related_posts['tax_query'] = array(
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => array(
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image',
							'post-format-link',
							'post-format-quote',
							'post-format-status',
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				);
			}
			$verano_related_posts = get_posts( $verano_related_posts );
			if ( count( $verano_related_posts ) > 0 ) {
				?>
				<section class="widget relatedposts w3-row">
					<?php if ( $instance['title'] != '' ) { ?>
						<h3 class="widget-title"><?php echo esc_html( $instance['title'] ); ?></h3>
						<hr>
					<?php }
					foreach ( $verano_related_posts as $post ) : setup_postdata( $post );
						$verano_related_posts = get_post_thumbnail_id();
						$verano_thumb_url     = wp_get_attachment_image_src( get_post_thumbnail_id(), 'opengraph' );
						?>
						<article class="w3-third">
							<a href="<?php esc_url( the_permalink() ); ?>" class="feature">
								<?php
								$post_category = get_the_category();
								if ( $post_category ) {
									echo '<span class="category">' . esc_html( $post_category[0]->name ) . '</span> ';
								}
								?>
								<img src="<?php echo esc_attr( $verano_thumb_url[0] ); ?>"
								     alt="<?php esc_attr( the_title() ); ?>">
							</a>
							<h3 class="w3-container"><a
									href="<?php esc_url( the_permalink() ); ?>"><?php esc_html( the_title() ); ?></a>
							</h3>
							<p class="w3-container"><?php if ( function_exists( 'verano_truncate_by_words' ) ) {
									echo esc_html( verano_truncate_by_words( get_the_excerpt(), 90, '...' ) );
								} else {
									the_excerpt();
								} ?></p>
						</article>
						<?php
					endforeach;
					wp_reset_postdata();
					?>
				</section>
				<?php
			}
		}
	}

	public function form( $instance ) {
		$defaults = array(
			'title'      => '',
			'postcount'  => '3',
			'allformats' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of Posts to show: </label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>"
			       name="<?php echo $this->get_field_name( 'postcount' ); ?>" type="number"
			       value="<?php echo esc_attr( $instance['postcount'] ); ?>" min="1" max="6"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'allformats' ); ?>">Show All Post Formats: </label>
			<input id="<?php echo $this->get_field_id( 'allformats' ); ?>"
			       name="<?php echo $this->get_field_name( 'allformats' ); ?>"
			       type="checkbox" <?php checked( $instance['allformats'], 'on' ); ?> />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $new_instance as $key => $value ) {
			$instance[ $key ] = ( ! empty( $new_instance[ $key ] ) ) ? strip_tags( $new_instance[ $key ] ) : '';
		}

		return $instance;
	}

}
