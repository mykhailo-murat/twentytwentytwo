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
    <div class="main-content">


        <?php if ($taxonomies = get_object_taxonomies('speakers')): ?>
            <aside class="sidebar">
                <ul class="speakers-taxonomies">
                    <?php foreach ($taxonomies as $tax): ?>
                        <li class="tax"><h3><?php echo $tax ?> </h3></li>

                        <?php $args = array(
                            'taxonomy' => $tax,
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'public' => true,
                        );
                        $tags = get_tags($args); ?>
                        <ul class="speakers-tags">
                            <?php foreach ($tags as $tag) : ?>
                                <li><h4 class="speakers-tag" data-tax="<?php echo $tax; ?>" data-tag="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></h4></li>
                            <?php endforeach; ?>
                        </ul>
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
                        <div class='speakers__card-flag'><?php echo $tag_country[0]->description; ?></div>
                    <?php endif; ?>

                    <?php if (has_post_thumbnail($post->ID)): ?>
                        <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'thumbnail', false, array('class' => 'speakers__card-image')); ?>
                    <?php endif; ?>

                    <a class="speakers__card-name" href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a>

                </div>

                <?php
            } ?>
        </div>
    </div>
    <?php
} else {
    _e('No posts', 'twentytwentytwo');
}

// Restore original Post Data
wp_reset_postdata();


get_footer();