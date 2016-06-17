<?php
/*  *   *  *   */

/**
 * Configure default theme environment
 *  @return void
 */
function verano_theme_setup(){
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

	add_image_size('background', 1680);
	add_image_size('background-small', 1240);
	add_image_size('single', 860);
	add_image_size('opengraph', 680);
	add_image_size('sidebar', 400);
	add_image_size('thumbnail', 200);
	add_image_size('thumbnail_small', 150, 150, true);


    function remove_admin_bar_links() {
        global $wp_admin_bar;
        if ( !current_user_can( 'administrator' ) ) {
            $wp_admin_bar->remove_menu( 'bp-register' );
            $wp_admin_bar->remove_menu( 'wp-logo' );          // Remove the WordPress logo
            //$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
            $wp_admin_bar->remove_menu( 'wporg' );            // Remove the WordPress.org link
            $wp_admin_bar->remove_menu( 'documentation' );    // Remove the WordPress documentation link
            $wp_admin_bar->remove_menu( 'support-forums' );   // Remove the support forums link
            $wp_admin_bar->remove_menu( 'feedback' );         // Remove the feedback link
            $wp_admin_bar->remove_menu( 'site-name' );        // Remove the site name menu
            $wp_admin_bar->remove_menu( 'view-site' );        // Remove the view site link
            $wp_admin_bar->remove_menu( 'updates' );          // Remove the updates link
            $wp_admin_bar->remove_menu( 'comments' );         // Remove the comments link
            $wp_admin_bar->remove_menu( 'new-content' );      // Remove the content link
            $wp_admin_bar->remove_menu( 'w3tc' );             // If you use w3 total cache remove the performance link
            //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
            $wp_admin_bar->remove_menu( 'logout' );           // Remove the logout link
        }
    }
    add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

}
add_action('after_setup_theme', 'verano_theme_setup');
/* fin */

/*
*   Quitar peso del header
*/ 

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/*  fin  */


/* 
* Activamos la capacidad de reproducir shortcodes en los widgets
*/  

add_filter('widget_text', 'do_shortcode');

/* Fin */

/*
* Quitar estilos no necesarios
*/

add_action('wp_print_styles', 'verano_deregister_styles', 100);

function verano_deregister_styles() {
    wp_dequeue_style('twentysixteen-fonts'); // desactiva las fuentes de twentysixteen
    wp_dequeue_style('genericons'); // desactiva dashicons
    wp_dequeue_style('contact-form-7'); // desactiva los estilo de contact form 7
    wp_dequeue_style('bbp-default'); // desactiva los estilos de bbpress
    wp_dequeue_style('um_minified'); // desactiva los estilos de ultimate members
    wp_dequeue_style('bp-twentysixteen'); // desactiva los estilos budyypress  para twentysisteen
    //wp_dequeue_style('bp-legacy-css'); // desactiva los estilos budyypress
}
/* Fin  */

/**
 * Truncate a string based on provided word count and include terminator
 * @param       string $string      String to be truncated
 * @param       int $length         Number of characters to allow before split
 * @param       string $terminator  (Optional) String terminator to be used
 * @return      string              Truncated string with add terminator
 */
function verano_truncate_by_words($string, $length, $terminator = ""){
    if(mb_strlen($string) <= $length){
        $string = $string;
    }else{
        $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length)) . $terminator;
    }
    return $string;
}
/*
* fin
*/

/*
* Registramos script y estilos para la web
*/

if (!function_exists('verano_scripts')) {
    function theme_enqueue_styles()
    {

        $parent_style = 'parent-style';

        // Registrar estilos
        //wp_register_style( 'w3css', 'http://www.w3schools.com/lib/w3.css', false, false );
        //wp_register_style( 'flexslider-css', 'http://flexslider.woothemes.com/css/flexslider.css', false, false );
        wp_register_style('roboto', '//fonts.googleapis.com/css?family=Roboto:700,400,400italic', false, false);
        wp_register_style('lato', '//fonts.googleapis.com/css?family=Lato:100, 300, 400,700', false, false);


        // Quitar fuentes tweny sixten



        // Cargar estilo
        //wp_enqueue_style( 'w3css' );
        //wp_enqueue_style( 'flexslider-css' );

        //wp_enqueue_style('master_style', get_stylesheet_directory_uri() . '/css/master/style.css');
        wp_enqueue_style('roboto');
        wp_enqueue_style('lato');
	    wp_enqueue_style( 'verano-dashicons', get_stylesheet_uri(), 'dashicons' );
	    wp_enqueue_style( 'dashicons' );

        // Registrar script
        wp_register_script('verano-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js', array('jquery'), false, true);
        wp_register_script('flexslider-js', 'http://flexslider.woothemes.com/js/jquery.flexslider.js', array('jquery'), false, true);
        wp_register_script('verano-custom-js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), false, true);

        // Cargar script
        wp_enqueue_script('verano-jquery');
        wp_enqueue_script('flexslider-js');
        wp_enqueue_script('verano-custom-js');


    }

    add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
}

/* Fin */
/**
 * Implement the custom post type.
 */
require_once(get_stylesheet_directory() . '/inc/custom-post-type.php');

/**
 * Implement the shortcodes.
 */
require_once(get_stylesheet_directory() . '/inc/shortcodes.php');
/**
 * Implement the custom header title.
 */
//require_once(get_stylesheet_directory() . '/inc/custom-header-title.php');
/**
 * Implement the widgets.
 */
require_once(get_stylesheet_directory() . '/inc/widgets.php');

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - Register the widget areas.
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('verano_widget_init')) {
    function verano_widget_init()
    {
        if (function_exists('register_sidebar')) {
            register_sidebar(array(
                'name' => __('Footer 1', 'verano'),
                'id' => 'footer-sidebar-1',
                'description' => __('Aparece en el pie de página.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
            register_sidebar(array(
                'name' => __('Footer 2', 'verano'),
                'id' => 'footer-sidebar-2',
                'description' => __('Aparece en el pie de página.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
            register_sidebar(array(
                'name' => __('Footer 3', 'verano'),
                'id' => 'footer-sidebar-3',
                'description' => __('Aparece en el pie de página.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
            register_sidebar(array(
                'name' => __('Front Page 1', 'verano'),
                'id' => 'front-page-1',
                'description' => __('Aparece en home del sitio.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
            register_sidebar(array(
                'name' => __('Front Page 2', 'verano'),
                'id' => 'front-page-2',
                'description' => __('Aparece en el pie de página.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
            register_sidebar(array(
                'name' => __('Related post', 'verano'),
                'id' => 'related-post',
                'description' => __('Aparece al final de un post.', 'verano'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));

        }
    }

    add_action('widgets_init', 'verano_widget_init');
}
 /*
 * Quitar widget
 */

function remove_widgets(){

    // Unregister some of the TwentyTen sidebars
    unregister_sidebar( 'sidebar-2' );
    unregister_sidebar( 'sidebar-3' );

}
add_action( 'widgets_init', 'remove_widgets', 11 );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/
 *
 * @since Twenty Sixteen 1.0
 */

/**
 * ----------------------------------------------------------------------------------------
 * 8.0 - .Alternativas a customizer
 * ----------------------------------------------------------------------------------------
 */

/*
*  Eliminamos partes de customizer twentysixteen
*/

function mytheme_customize_register($wp_customize)
{
    //All our sections, settings, and controls will be added here

    // title_tagline - Site Title & Tagline
    // colors - Colors
    // header_image - Header Image
    //background_image - Background Image
    // nav - Navigation
    // static_front_page - Static Front Page

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('header_image');
}

add_action('customize_register', 'mytheme_customize_register');

/*
*  Registro de widgets
*/
function load_widgets() {

    register_widget( 'aboutUsWidget' );

	register_widget( 'testimoniosWidget' );

	register_widget('ultimasentradasWidget');

	register_widget( 'destacadosWidget' );

    register_widget('verano_widget_latest_posts');

    register_widget('verano_widget_related_posts' );
}

add_action( 'widgets_init', 'load_widgets' );

/*
* fin
*/
/*-----------------------------------------------------------------------------------*/
/* PAGE LAYOUTS
/*-----------------------------------------------------------------------------------*/

if(!function_exists('verano_opten_layout')){
    function verano_opten_layout(){
        global $post;
        if(is_single() || is_page() || is_archive()){
	        $verano_pagelayout_style_meta = get_post_meta($post->ID, 'verano_pagelayout_style', true);
            switch($verano_pagelayout_style_meta){
                case 'pagelayout-fullwidth':
                    echo 'l12';
                    break;
                default:
                    break;
            }
        }else{
            return;
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/* POST META BOX SETTINGS
 /*-----------------------------------------------------------------------------------*/

    if(!function_exists('verano_option_meta_verano_setup')){
        function verano_option_meta_verano_setup(){
            add_action('add_meta_boxes', 'verano_add_option_boxes');
            add_action('save_post', 'verano_save_option_meta', 10, 2);
        }
    }
    add_action('load-post.php', 'verano_option_meta_verano_setup');
    add_action('load-post-new.php', 'verano_option_meta_verano_setup');

    if(!function_exists('verano_add_option_boxes')){
        function verano_add_option_boxes(){
            add_meta_box(
                'verano-post-options',
                esc_html__('Opciones para posts', 'verano'),
                'verano_options_meta_box',
                'post',
                'side',
                'core'
            );
            add_meta_box(
                'verano-post-options',
                esc_html__('Opciones para páginas', 'verano'),
                'verano_options_meta_box',
                'page',
                'side',
                'core'
            );
	        add_meta_box(
		        'verano-testimonios-autor',
		        esc_html__('Opciones para testimonios', 'verano'),
		        'verano_options_meta_box',
		        'testimonios',
		        'side',
		        'core'
	        );
        }
    }

    if(!function_exists('verano_options_meta_box')){
        function verano_options_meta_box($object, $box){ 
            global $post;
            wp_nonce_field(basename(__FILE__), 'verano_subtitle');
            $verano_subtitle_meta = get_post_meta($post->ID, 'verano_subtitle', true);
            $verano_pagelayout_style_meta = get_post_meta($post->ID, 'verano_pagelayout_style', true);
	        $verano_autor_testimonio_meta = get_post_meta($post->ID, 'verano_autor_testimonio',true);

        ?>
            <p>
                <label>
                    <strong>Subtítulo</strong>
                    <textarea class="widefat" rows="3" name="verano_subtitle" id="verano_subtitle"><?php echo esc_html($verano_subtitle_meta); ?></textarea>
                </label>
                <p class="howto">Añade un subtítutlo en tus páginas.</p>
            </p>
            <hr>
            <p>
                <strong>Estilo de página</strong><br><br>
                <input type="radio" id="pagelayout-standard" name="verano_pagelayout_style" value="pagelayout-standard" <?php if(!in_array($verano_pagelayout_style_meta, array('pagelayout-fullwidth'))){ echo 'checked'; } ?>>
                <label for="pagelayout-standard">Con Bara lateral</label><br>
                <input type="radio" id="pagelayout-fullwidth" name="verano_pagelayout_style" value="pagelayout-fullwidth" <?php checked($verano_pagelayout_style_meta, 'pagelayout-fullwidth'); ?>>
                <label for="pagelayout-fullwidth">Sin Barra lateral</label><br>
                <p class="howto">Configura es estilo de las páginas y post.</p>
            </p>
            <hr>
            <p>

				<label>
					<strong>Autor</strong>
					<textarea rows="3" name="verano_autor_testimonio" id="verano_autor_testimonio"><?php echo esc_html($verano_autor_testimonio_meta); ?></textarea>
				</label>
			</p>
			<hr>

        <?php 
        }
    }

    if(!function_exists('verano_save_option_meta')){
        function verano_save_option_meta($post_id, $post){
            $is_autosave = wp_is_post_autosave($post_id);
            $is_revision = wp_is_post_revision($post_id);

            $verano_subtitle_meta = (isset($_POST['verano_subtitle']) && wp_verify_nonce($_POST['verano_subtitle'], basename(__FILE__))) ? 'true' : 'false';
            $verano_pagelayout_style = (isset($_POST['verano_pagelayout_style']) && wp_verify_nonce($_POST['verano_pagelayout_style'], basename(__FILE__))) ? 'true' : 'false';
	        $verano_autor_testimonio_meta = (isset($_POST['verano_autor_testimonio']) && wp_verify_nonce($_POST['verano_autor_testimonio'], basename(__FILE__))) ? 'true' : 'false';

            if($is_autosave || $is_revision && !$verano_subtitle_meta && !$verano_pagelayout_style && !$verano_autor_testimonio_meta){
                return;
            }
            if(isset($_POST['verano_subtitle'])){
                update_post_meta($post_id, 'verano_subtitle', sanitize_text_field($_POST['verano_subtitle']));
            }
            if(isset($_POST['verano_pagelayout_style'])){
                update_post_meta($post_id, 'verano_pagelayout_style', sanitize_text_field($_POST['verano_pagelayout_style']));
            }
	        if(isset($_POST['verano_autor_testimonio'])){
		        update_post_meta($post_id, 'verano_autor_testimonio', sanitize_text_field($_POST['verano_autor_testimonio']));
	        }
        }
    }


/*-----------------------------------------------------------------------------------*/
    /* 7. CUSTOMIZER
    /*-----------------------------------------------------------------------------------*/


    function ecko_customize_register($wp_customize){

        /*
         * GENERAL SECTION
         */
        $wp_customize->add_section('general_section',
            array(
                'title' => 'General',
                'description' => 'This section contains general theme options.',
                'priority' => 9,
            )
        );

        $wp_customize->add_setting('general_blog_description',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('general_blog_description',
            array(
                'label' => 'Blog Profile Description',
                'section' => 'general_section',
                'type' => 'textarea',
            )
        );

        $wp_customize->add_setting('general_use_custom_date_format',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_use_custom_date_format',
            array(
                'type' => 'checkbox',
                'label' => 'Use WordPress Date Format',
                'section' => 'general_section',
            )
        );

        $wp_customize->add_setting('general_hidecomments',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_hidecomments',
            array(
                'type' => 'checkbox',
                'label' => 'Hide Comments on Load',
                'section' => 'general_section',
            )
        );

        $wp_customize->add_setting('general_disable_syntax_highlighter',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_disable_syntax_highlighter',
            array(
                'type' => 'checkbox',
                'label' => 'Disable Syntax Highlighter',
                'section' => 'general_section',
            )
        );

        $wp_customize->add_setting('general_use_extended_char_set',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_use_extended_char_set',
            array(
                'type' => 'checkbox',
                'label' => 'Use Extended Character Set',
                'section' => 'general_section',
            )
        );

        $wp_customize->add_setting('general_use_unminified_css',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_use_unminified_css',
            array(
                'type' => 'checkbox',
                'label' => 'Use Unminified CSS Source',
                'section' => 'general_section',
            )
        );

        $wp_customize->add_setting('general_disqus_plugin_support',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('general_disqus_plugin_support',
            array(
                'type' => 'checkbox',
                'label' => 'Enable Disqus Plugin Support',
                'section' => 'general_section',
            )
        );


        /*
         * TYPOGRAPHY SECTION
         */
        $wp_customize->add_section('typography_section',
            array(
                'title' => 'Typography',
                'description' => 'This section contains theme typography/font options.',
                'priority' => 10,
            )
        );

        if(defined('ECKO_FONT_BODY_FAMILY')){
            $wp_customize->add_setting('typography_body',
            array(
                'default' => 'Theme Default',
                'sanitize_callback' => 'ecko_sanitize_allow_html'
            ));
            $wp_customize->add_control('typography_body',
                array(
                    'label' => 'Body Font',
                    'section' => 'typography_section',
                    'type' => 'select',
                    'choices' => ecko_get_google_font_list()
                )
            );
        }

        if(defined('ECKO_FONT_BODY_ALT_FAMILY')){
            $wp_customize->add_setting('typography_body_alernative',
            array(
                'default' => 'Theme Default',
                'sanitize_callback' => 'ecko_sanitize_allow_html'
            ));
            $wp_customize->add_control('typography_body_alernative',
                array(
                    'label' => 'Body (Alternative) Font',
                    'section' => 'typography_section',
                    'type' => 'select',
                    'choices' => ecko_get_google_font_list()
                )
            );
        }

        if(defined('ECKO_FONT_HEADER_FAMILY')){
            $wp_customize->add_setting('typography_header',
            array(
                'default' => 'Theme Default',
                'sanitize_callback' => 'ecko_sanitize_allow_html'
            ));
            $wp_customize->add_control('typography_header',
                array(
                    'label' => 'Header Font',
                    'section' => 'typography_section',
                    'type' => 'select',
                    'choices' => ecko_get_google_font_list()
                )
            );
        }

        if(defined('ECKO_FONT_SUB_HEADER_FAMILY')){
            $wp_customize->add_setting('typography_sub_header',
            array(
                'default' => 'Theme Default',
                'sanitize_callback' => 'ecko_sanitize_allow_html'
            ));
            $wp_customize->add_control('typography_sub_header',
                array(
                    'label' => 'Sub Header Font',
                    'section' => 'typography_section',
                    'type' => 'select',
                    'choices' => ecko_get_google_font_list()
                )
            );
        }

        if(defined('ECKO_FONT_POST_FAMILY')){
            $wp_customize->add_setting('typography_post',
            array(
                'default' => 'Theme Default',
                'sanitize_callback' => 'ecko_sanitize_allow_html'
            ));
            $wp_customize->add_control('typography_post',
                array(
                    'label' => 'Post Font',
                    'section' => 'typography_section',
                    'type' => 'select',
                    'choices' => ecko_get_google_font_list()
                )
            );
        };

        /*
         * SOCIAL SECTION
         */
        $wp_customize->add_section('social_section',
            array(
                'title' => 'Social Profiles',
                'description' => 'This section contains options for social profiles.',
                'priority' => 39,
            )
        );

        $wp_customize->add_setting('social_twitter',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_twitter',
            array(
                'label' => 'Twitter Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_facebook',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_facebook',
            array(
                'label' => 'Facebook Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_google',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_google',
            array(
                'label' => 'Google+ Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_dribbble',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_dribbble',
            array(
                'label' => 'Dribbble Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_instagram',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_instagram',
            array(
                'label' => 'Instagram Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_github',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_github',
            array(
                'label' => 'Github Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_youtube',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_youtube',
            array(
                'label' => 'Youtube Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_pinterest',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_pinterest',
            array(
                'label' => 'Pinterest Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_linkedin',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_linkedin',
            array(
                'label' => 'LinkedIn Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_skype',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_skype',
            array(
                'label' => 'Skype URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_tumblr',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_tumblr',
            array(
                'label' => 'Tumblr URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_flickr',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_flickr',
            array(
                'label' => 'Flickr Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_reddit',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_reddit',
            array(
                'label' => 'Reddit Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_stackoverflow',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_stackoverflow',
            array(
                'label' => 'StackOverflow Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_twitch',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_twitch',
            array(
                'label' => 'Twitch Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_vine',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_vine',
            array(
                'label' => 'Vine Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_vk',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_vk',
            array(
                'label' => 'VK Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_vimeo',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_vimeo',
            array(
                'label' => 'Vimeo Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_weibo',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_weibo',
            array(
                'label' => 'Weibo Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('social_soundcloud',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('social_soundcloud',
            array(
                'label' => 'Soundcloud Profile URL',
                'section' => 'social_section',
                'type' => 'text',
            )
        );


        /*
         * COLORS SECTION
         */
        $wp_customize->add_setting('color_enable_custom',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('color_enable_custom',
            array(
                'type' => 'checkbox',
                'label' => 'Enable Custom Colors (Below)',
                'section' => 'colors',
            )
        );

        $wp_customize->add_setting('color_accent',
            array(
                'default' => '#000',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'color_accent',
                array(
                    'label'      => 'Color Accent',
                    'section'    => 'colors',
                    'settings'   => 'color_accent'
                )
            )
        );

        $wp_customize->add_setting('color_accent_light',
            array(
                'default' => '#000',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'color_accent_light',
                array(
                    'label'      => 'Color Accent Light',
                    'section'    => 'colors',
                    'settings'   => 'color_accent_light'
                )
            )
        );

        $wp_customize->add_setting('color_accent_dark',
            array(
                'default' => '#000',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'color_accent_dark',
                array(
                    'label'      => 'Color Accent Dark',
                    'section'    => 'colors',
                    'settings'   => 'color_accent_dark'
                )
            )
        );


        /*
         * OPENGRAPH SECTION
         */
        $wp_customize->add_section('og_section',
            array(
                'title' => 'OpenGraph',
                'description' => 'This section contains options for OpenGraph integration.',
                'priority' => 42,
            )
        );

        $wp_customize->add_setting('og_disable',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('og_disable',
            array(
                'type' => 'checkbox',
                'label' => 'Disable OpenGraph Integration',
                'section' => 'og_section',
            )
        );

        $wp_customize->add_setting('og_facebook_app_id',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('og_facebook_app_id',
            array(
                'label' => 'Facebook App ID',
                'section' => 'og_section',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('og_facebook_admin_id',
        array(
            'sanitize_callback' => 'ecko_sanitize_text'
        ));
        $wp_customize->add_control('og_facebook_admin_id',
            array(
                'label' => 'Facebook Admin ID',
                'section' => 'og_section',
                'type' => 'text',
            )
        );


        /*
         * COPYRIGHT SECTION
         */
        $wp_customize->add_section('copyright_section',
            array(
                'title' => 'Copyright',
                'description' => 'This section contains options copyright disclaimer.',
                'priority' => 43,
            )
        );

        $wp_customize->add_setting('copyright_hide_disclaimer',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('copyright_hide_disclaimer',
            array(
                'type' => 'checkbox',
                'label' => 'Hide Copyright Disclaimer',
                'section' => 'copyright_section',
            )
        );

        $wp_customize->add_setting('copyright_hide_wordpress',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('copyright_hide_wordpress',
            array(
                'type' => 'checkbox',
                'label' => 'Hide "Published By" text' ,
                'section' => 'copyright_section',
            )
        );

        $wp_customize->add_setting('copyright_hide_ecko',
        array(
            'sanitize_callback' => 'ecko_sanitize_checkbox'
        ));
        $wp_customize->add_control('copyright_hide_ecko',
            array(
                'type' => 'checkbox',
                'label' => 'Hide "Theme by Ecko" text',
                'section' => 'copyright_section',
            )
        );

        $wp_customize->add_setting('copyright_upper_html',
        array(
            'sanitize_callback' => 'ecko_sanitize_allow_html'
        ));
        $wp_customize->add_control('copyright_upper_html',
            array(
                'type' => 'text',
                'label' => 'Override Upper Copyright HTML',
                'section' => 'copyright_section',
            )
        );

        $wp_customize->add_setting('copyright_lower_html',
        array(
            'sanitize_callback' => 'ecko_sanitize_allow_html'
        ));
        $wp_customize->add_control('copyright_lower_html',
            array(
                'type' => 'text',
                'label' => 'Override Lower Copyright HTML',
                'section' => 'copyright_section',
            )
        );


        /*
         * ADVANCED SECTION
         */
        $wp_customize->add_section('advanced_section',
            array(
                'title' => 'Advanced',
                'description' => 'This section contains advanced theme options.',
                'priority' => 130,
            )
        );

        $wp_customize->add_setting('advanced_custom_css',
        array(
            'sanitize_callback' => 'ecko_sanitize_allow_html'
        ));
        $wp_customize->add_control('advanced_custom_css',
            array(
                'type' => 'textarea',
                'label' => 'Custom Theme CSS',
                'section' => 'advanced_section',
            )
        );


    }
    add_action('customize_register', 'ecko_customize_register');
