<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>


<!-- BEGIN of main content -->
<div class="main-content">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">

                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog</a>
            </div>
        </div>
    </div>
</div>
<!-- END of main content -->

<?php get_footer(); ?>
