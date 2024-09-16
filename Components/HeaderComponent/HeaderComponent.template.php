<div class="HeaderComponent">
    <h2><?php echo get_the_title(); ?></h2>

    <?php echo wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => false,
    )); ?>
</div>