<?php

/**
 *  Footer meet us
 * 
 * @author Andrea Musso
 * 
 * @package Foundry
 */

if (has_nav_menu('footermenuwork-with-us')) :
    wp_nav_menu([
        'theme_location'    => 'footermenuwork-with-us',
        'menu_class'        => 'footer-menu',
        'menu_id'           => 'menu_footer',
        'container'         => 'nav',
        'container_class'   => 'footer-menu',
        'depth'             => 1
    ]);
endif;
