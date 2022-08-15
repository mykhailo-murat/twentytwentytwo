<?php
/**
 * Archive Speakers
 */

get_header();

// WP_Query arguments
$args = array(
    'post_type' => array('Speakers'),
);

// The Query
global $post;
$query = new WP_Query($args);

// The Loop
if ($query->have_posts()) { ?>
    <main class="main-content">


        <?php if ($taxonomies = get_object_taxonomies('speakers')): ?>
            <aside class="sidebar">
                <ul class="speakers-taxonomies">
                    <?php foreach ($taxonomies as $tax): ?>
                        <li class="tax "><h3 class="dropdown-toggle"><?php echo $tax ?> </h3>

                            <?php $args = array(
                                'taxonomy' => $tax,
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'public' => true,
                            );
                            $tags = get_tags($args); ?>
                            <ul class="speakers-tags dropdown" id="<?php echo $tax ?>">
                                <?php foreach ($tags as $tag) : ?>
                                    <li class="speakers-tag" data-tax="<?php echo $tax; ?>"
                                        data-tag="<?php echo $tag->slug; ?>">
                                        <h4><?php echo $tag->name; ?></h4>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        <?php endif; ?>

        <div class="speakers">
            <?php while ($query->have_posts()) {
                $query->the_post(); ?>
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
            } ?>
        </div>
    </main>
    <?php
} else {
    _e('No posts', 'twentytwentytwo');
}

// Restore original Post Data
wp_reset_postdata();


get_footer();