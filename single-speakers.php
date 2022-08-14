<?php
/**
 * Single speakers
 *
 */
get_header();
global $post; ?>


<main class="main-content">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) :
            the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?> >

                <div class="entry__content">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content('', true); ?>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'large', false, array('class' => 'entry__image')) ?>
                <?php endif; ?>


                <?php if ($sessions = get_field('sessions')): ?>
                    <div class="sessions">
                        <h2><?php _e('Sessions:', 'twentytwentytwo') ?></h2>

                        <?php foreach ($sessions as $post):
                            setup_postdata($post); ?>

                            <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>

            </article>
        <?php endwhile; ?>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
