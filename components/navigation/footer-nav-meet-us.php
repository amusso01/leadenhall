<?php

/**
 *  Footer meet us
 * 
 * @author Andrea Musso
 * 
 * @package Foundry
 */

if (has_nav_menu('footermenumeet-us')) :
    wp_nav_menu([
        'theme_location'    => 'footermenumeet-us',
        'menu_class'        => 'footer-menu',
        'menu_id'           => 'menu_footer_meet_us',
        'container'         => 'nav',
        'container_class'   => 'footer-menu_meet_us',
        'depth'             => 1
    ]);
endif;
