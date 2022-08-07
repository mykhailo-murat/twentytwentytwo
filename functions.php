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


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/inc/scss/main.css',
			array(),
			$version_string
		);
        wp_enqueue_script('jquery');

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

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

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

function cc_mime_types($mimes) {
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
                'terms'    => $tag,
            ),
        )

    );
    $the_query = new WP_Query($posts);

    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();
            global $post; ?>
            <div class="speakers__card">

                <?php $tag_country = wp_get_post_terms($post->ID, 'countries', array('fields' => 'all')); ?>
                <?php if ($tag_country) : ?>
                    <div class='speakers__card-flag'><?php echo $tag_country[0]->description; ?></div>
                <?php endif; ?>

                <?php if (has_post_thumbnail($post->ID)): ?>
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'thumbnail', false, array('class' => 'speakers__card-image')); ?>
                <?php endif; ?>

                <a class="speakers__card-name" href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a>

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