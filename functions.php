<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


if (!function_exists('twentytwentytwo_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @return void
     * @since Twenty Twenty-Two 1.0
     *
     */
    function twentytwentytwo_support()
    {

        // Add support for block styles.
        add_theme_support('wp-block-styles');

        // Enqueue editor styles.
        add_editor_style('style.css');

    }

endif;

add_action('after_setup_theme', 'twentytwentytwo_support');

if (!function_exists('twentytwentytwo_styles')) :

    /**
     * Enqueue styles.
     *
     * @return void
     * @since Twenty Twenty-Two 1.0
     *
     */
    function twentytwentytwo_styles()
    {
        // Register theme stylesheet.
        $theme_version = wp_get_theme()->get('Version');

        $version_string = is_string($theme_version) ? $theme_version : false;
        wp_register_style(
            'twentytwentytwo-style',
            get_template_directory_uri() . '/inc/scss/main.css',
            array(),
            $version_string
        );
        wp_enqueue_script('jquery');

        // Enqueue theme stylesheet.
        wp_enqueue_style('twentytwentytwo-style');

        wp_enqueue_script(
            'main.js',
            get_template_directory_uri() . '/inc/main.js',
            'jquery',
            null,
            true
        );

        wp_localize_script(
            'main.js',
            'ajax_object',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('project_nonce'),
            ]
        );

    }

endif;

add_action('wp_enqueue_scripts', 'twentytwentytwo_styles');

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');


function filter_ajax()
{
    ob_start();

    $tag = $_POST['tag'];
    $tax = $_POST['tax'];

    $posts = array(
        'post_type' => array('Speakers'),
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $tag
            )
        ),
    );
    $the_query = new WP_Query($posts);

    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();
            global $post; ?>
            <div class="speakers__card">

                <?php $tag_country = wp_get_post_terms($post->ID, 'countries', array('fields' => 'all')); ?>
                <?php if ($tag_country) : ?>
                    <div class='speakers__card-flag'>
                        <div class="speakers__card-flag-in">
                            <?php echo $tag_country[0]->description; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (has_post_thumbnail($post->ID)): ?>
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'speaker-thumbnail', false, array('class' => 'speakers__card-image')); ?>
                <?php endif; ?>

                <a class="speakers__card-name" href="<?php the_permalink(); ?>"
                   target="_blank"> <?php the_title(); ?></a>

            </div>
        <?php
        endwhile;
    endif;
    wp_reset_query();
    $data = ob_get_clean();
    wp_send_json_success($data);
    wp_die();
}

add_action('wp_ajax_nopriv_filter_ajax', 'filter_ajax');
add_action('wp_ajax_filter_ajax', 'filter_ajax');


add_image_size('speaker-thumbnail', 180, 180);
add_image_size('full_hd', 1920, 0, ['center', 'center']);
add_image_size('large', 700, 0, ['center', 'center']);

function my_update_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, false, true);
        wp_enqueue_script('jquery');
    }
}

add_action('wp_enqueue_scripts', 'my_update_jquery');

register_nav_menus(
    array(
        'header-menu' => __('Header Menu'),
        'footer-menu' => __('Footer Menu')
    )
);

add_theme_support('custom-logo');

function custom_logo_setup()
{
    $defaults = array(
        'height' => 50,
        'width' => 100,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );

    add_theme_support('custom-logo', $defaults);
}

function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

add_filter('upload_mimes', 'add_file_types_to_uploads');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

/**
 * Output background image style
 *
 * @param array|string $img Image array or url
 * @param string $size Image size to retrieve
 * @param bool $echo Whether to output the the style tag or return it.
 *
 * @return string|void String when retrieving.
 */
function bg($img = '', $size = '', $echo = true)
{
    if (empty($img)) {
        return false;
    }

    if (is_array($img)) {
        $url = $size ? $img['sizes'][$size] : $img['url'];
    } else {
        $url = $img;
    }

    $string = 'style="background-image: url(' . $url . ')"';

    if ($echo) {
        echo $string;
    } else {
        return $string;
    }
}


/**
 * Custom styles in TinyMCE
 */
add_filter(
    'mce_buttons_2',
    function ($buttons) {
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }
);

add_filter(
    'tiny_mce_before_init',
    function ($init_array) {
        // Define the style_formats array
        $style_formats = [
            [
                'title' => 'SUP title',
                'classes' => 'sup-title',
                'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                'wrapper' => false,
            ],
            [
                'title' => 'Button',
                'classes' => 'button',
                'selector' => 'a',
                'wrapper' => false,
            ],
            [
                'title' => 'Link Arrow',
                'classes' => 'link-arrow',
                'selector' => 'a',
                'wrapper' => false,
            ],
        ];
        $init_array['style_formats'] = json_encode($style_formats);
        return $init_array;
    }
);

add_editor_style();

/**
 * Add custom color to TinyMCE editor text color selector
 */
add_filter(
    'tiny_mce_before_init',
    /**
     * @param $init array
     *
     * @return mixed array
     */
    function ($init) {
        $default_colours = [
            'Black' => '000000',
            'White' => 'ffffff',
        ];

        /**
         * By using the same array keys as the default values you'll override (replace) them
         */
        $custom_colours = [
            'Navy' => '065C9E',
            'Black' => '323232',
            'Brand' => '22BAC9'
        ];

        $textcolor_map = [];
        foreach (array_merge($default_colours, $custom_colours) as $name => $color) {
            $textcolor_map[] = "\"$color\", \"$name\"";
        }

        if (!empty($textcolor_map)) {
            $init['textcolor_map'] = '[' . implode(', ', $textcolor_map) . ']';
            $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
        }

        return $init;
    }
);