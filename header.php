<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>

    <!-- selector de layout -->
    <?php if (function_exists('ot_get_option')) : ?>
        <?php if (ot_get_option('selector_de_plantillas') == '2') : ?>
            <style type="text/css">
                .situacion-sidebar {
                    float: left !important;
                }

                .situacion-conten {
                    float: right !important;
                }
            </style>

        <?php endif; ?>
    <?php endif; ?>
    <!-- fin -->

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <div class="site-inner">
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'twentysixteen'); ?></a>

        <header id="masthead" class="site-header" role="banner">
            <div class="site-header-main w3-container">
                <div class="site-branding">

                    <?php if (function_exists('ot_get_option')) : ?>
                        <?php $logo = ot_get_option('logo'); ?>
                        <?php if (!empty($logo)) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo $logo; ?>"
                                                                                 class="retina"
                                                                                 alt="<?php esc_attr(bloginfo('name')); ?>"></a>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url()); ?>">
                                <h2><?php esc_html(bloginfo('name')); ?></h2></a>
                        <?php endif; ?>
                        <p><?php echo esc_html(get_theme_mod('general_blog_description')); ?></p>
                    <?php endif; ?>
                    <?php $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>
                </div>
                <!-- .site-branding -->

                <?php if (has_nav_menu('primary') || has_nav_menu('social')) : ?>
                    <button id="menu-toggle" class="menu-toggle"></button>

                    <div id="site-header-menu" class="site-header-menu">
                        <?php if (has_nav_menu('primary')) : ?>
                            <nav id="site-navigation" class="main-navigation" role="navigation"
                                 aria-label="<?php esc_attr_e('Primary Menu', 'twentysixteen'); ?>">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'primary-menu',
                                ));
                                ?>
                            </nav><!-- .main-navigation -->
                        <?php endif; ?>

                        <?php if (has_nav_menu('social')) : ?>
                            <nav id="social-navigation" class="social-navigation" role="navigation"
                                 aria-label="<?php esc_attr_e('Social Links Menu', 'twentysixteen'); ?>">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'social',
                                    'menu_class' => 'social-links-menu',
                                    'depth' => 1,
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                ));
                                ?>
                            </nav><!-- .social-navigation -->
                        <?php endif; ?>
                    </div><!-- .site-header-menu -->
                <?php endif; ?>
            </div>
            <!-- .site-header-main -->
        </header>
        <!-- .site-header -->

        <div id="content" class="site-content w3-content w3-row">