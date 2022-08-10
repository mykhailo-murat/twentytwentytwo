<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <!-- Add external fonts below  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline fxy'); ?>>
<?php wp_body_open(); ?>

<header>
    <div class="container">
        <div class="header">

            <?php if (function_exists('the_custom_logo')): ?>
                <div class="header__logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>

            <?php if (has_nav_menu('header-menu')) : ?>
                <nav class="header__menu">
                    <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>

                    <?php if ($header_link = get_field('header_link', 'options')): ?>
                        <a class="header__link button hollow" target="<?php echo $header_link['target'] ?>"
                           href="<?php echo $header_link['url'] ?>"><?php echo $header_link['title'] ?></a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
            <div class="header__lang">
                <a href="#"><?php _e('EN', 'twentytwentytwo') ?></a>
            </div>

            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>
</header>
