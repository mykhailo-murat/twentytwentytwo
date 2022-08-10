<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
    <div class="container">
        <div class="footer__inner">

            <?php if (function_exists('the_custom_logo')): ?>
                <div class="footer__logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>

            <?php if (has_nav_menu('footer-menu')): ?>
                <nav class="footer__menu">
                    <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'menu_class' => 'footer-menu', 'depth' => 1)); ?>
                </nav>
            <?php endif; ?>

            <?php if ($footer_link = get_field('footer_link', 'options')): ?>
                <div class="footer__link">
                    <a class="link-arrow " target="<?php echo $footer_link['target'] ?>"
                       href="<?php echo $footer_link['url'] ?>"><?php echo $footer_link['title'] ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($footer_copy = get_field('footer_copy', 'options')): ?>
            <div class="footer__bottom">
                <div class="footer__copy">
                    <?php echo wp_get_attachment_image($footer_copy['id'], 'large', false, array('class' => 'speakers__card-image')); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
