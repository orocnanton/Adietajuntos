<?php
// Add Shortcode
/**
 * @param $atts
 * @param null $content
 * @return string
 */

// Buttons
// function button_shortcode($atts, $content = null)
// {
//     return '<button class="w3-btn">' . $content . '</button>';
// }

// add_shortcode('button', 'button_shortcode');
/*-----------------------------------------------------------------------------------*/
/*  Buttons
/*-----------------------------------------------------------------------------------*/

 function accio_button_shortcode($atts, $content = null) {
     extract(shortcode_atts(array(
         'size' => '',
         'color' => '',
         'url' => '',
         'target' => ''
     ), $atts));

     $output = '<a href="'.$url.'" class="w3-btn '.$size.' '.$color.' button-main" target="'.$target.'">' .do_shortcode($content). '</a>';

     return $output;
 }
 add_shortcode('button', 'accio_button_shortcode');

/*---------------------------------------------------------------------------*/
/* Flexslider
/*---------------------------------------------------------------------------*/

 function accio_slider($atts, $content = null) {
    $str = '';
    $str .= '<div class="flexslider">';
    $str .= '<ul class="slides">';
    $str .= do_shortcode($content);
    $str .= '</ul>';
    $str .= '</div>';
    return $str;
 }

 add_shortcode('slider', 'accio_slider');


 function accio_slide($atts, $content = null) {
    $str = '';
    $str .= '<li>'.$content.'</li>';
    return $str;
 }

 add_shortcode('slide', 'accio_slide');

//  Add Row
function row_shortcode($atts, $content = null)
{
    return '<div class="w3-row">' . do_shortcode($content) . '</div>';
}

add_shortcode('row', 'row_shortcode');
// Add Shortcode Column half
function column_shortcode_half($atts, $content = null)
{
    //return '<img src="' . $content . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '">';
    return '<div class="w3-container w3-half w3-red"><p>' . $content . '</p></div>';
}

add_shortcode('column-half', 'column_shortcode_half');

// Entradas relacionadas por tags
function verano_related_post()
{
    echo '<h2>Entradas Relacionadas</h2>';
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $tag_ids = array();
        foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args = array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 4, // Number of related posts to display.
            'ignore_sticky_posts' => 1
        );
        echo '<ul>';
        $my_query = new wp_query($args);
        while ($my_query->have_posts()) {
            $my_query->the_post(); ?>
            <li>
                <?php if (has_post_thumbnail()) { ?>
                    <a rel="external" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(array(150, 100)); ?>
                    </a>
                <?php } ?>
                <p>
                    <a rel="external" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                        <p><?php if(function_exists('verano_truncate_by_words')){ echo esc_html(verano_truncate_by_words(get_the_excerpt(), 90, '...')); }else{ the_excerpt(); } ?></p>
                    </a>
                </p>
            </li>
            <?php
        }
        echo '</ul>';
    }
    wp_reset_query();
}
add_shortcode('verano_related_post', 'verano_related_post');

/*
* fin
*/

