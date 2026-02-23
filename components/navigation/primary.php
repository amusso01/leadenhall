<?php

/**
 * Primary Nav
 * 
 * @author Andrea Musso
 * 
 * @package Foundry
 */

?>

<div class="primary-menu-container">

    <?php

    if (has_nav_menu('mainmenu')) :
        // Get the menu object for 'mainmenu'
        $menu_object = wp_get_nav_menu_object(get_nav_menu_locations()['mainmenu'] ?? 0);
        $menu_id = $menu_object ? $menu_object->term_id : null;

        // You can now use $menu_id as needed
        wp_nav_menu([
            'theme_location'    => 'mainmenu',
            'menu_class'        => 'hidden_mobile',
            'menu_id'           => 'menu_main',
            'container'         => 'nav',
            'container_class'   => 'site-header__item site-header__menu primary-menu',
            'depth'             => 2
        ]);
    endif;



    $buttonUrl = get_field('contact_us_btn_link', 'menu_' . $menu_id);

    ?>

    <?php if ($buttonUrl): ?>
        <div class="fdry-nav-button">
            <a href="<?php echo $buttonUrl; ?>" class="btn">GET IN TOUCH</a>
        </div>
    <?php endif; ?>

</div>