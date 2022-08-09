<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>


<!-- BEGIN of main content -->
<main class="main-content">
    <div class="container">
        <?php $hero_bg = get_field('hero_bg'); ?>
        <?php $hero_text = get_field('hero_text'); ?>
        <?php if ($hero_bg || $hero_text) : ?>
            <section class="hero bg-cover" <?php bg($hero_bg, 'full_hd') ?>>
                <div class="hero__text">
                    <?php echo $hero_text ?>
                </div>
            </section>
        <?php endif; ?>

        <?php $sbs_image = get_field('sbs_image'); ?>
        <?php $sbs_text = get_field('sbs_text'); ?>
        <?php if ($sbs_image && $sbs_text): ?>
            <section class="sbs">
                <div class="sbs__image rel-content">
                    <?php echo wp_get_attachment_image($sbs_image['id'], 'large', false, array('class' => 'stretched-img')); ?>
                </div>

                <div class="sbs__text">
                    <?php echo $sbs_text; ?>
                </div>

            </section>
        <?php endif; ?>
        <?php ?>
    </div>
</main>
<!-- END of main content -->

<?php get_footer(); ?>
