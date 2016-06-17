<?php 
/**
 * The custom title header position
 *
 *
 * @package WordPress
 * @subpackage verano
 */


if (!function_exists('verano_custom_header_title')) {
    function verano_custom_header_title() {
        if (function_exists('ot_get_option')) {
            $header_title = ot_get_option('header_title');
            echo '<div class="w3-content content-title w3-red">';
            if (!is_front_page() && ($header_title == 'on')) {
                single_post_title('<h1 class="entry-title">', '</h1>');
            }
            elseif(is_archive() && ($header_title == 'on')) {
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="taxonomy-description">', '</div>');
            }
            echo '</div>';
        }
    }
    add_action('after_switch_theme', 'verano_custom_header_title');
}

if (!function_exists('verano_custom_post_title')) {
    function verano_custom_post_title() {
        if (function_exists('ot_get_option')) {
            $header_title = ot_get_option('header_title');
            echo '<header class="page-header">';

            if (is_archive() && ($header_title == 'off')) {
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="taxonomy-description">', '</div>');
            }
            elseif((!is_front_page() || is_paged()) && ($header_title == 'off')) {
                single_post_title('<h1 class="entry-title">', '</h1>');
            } else {

            }

            echo '</header>';
        }
    }
    add_action('after_switch_theme', 'verano_custom_post_title');
}