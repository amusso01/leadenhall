<?php

/**
 * The template for displaying sectors
 *
 * @author Andrea Musso
 *
 * @package foundry
 */

get_header();
?>


<main class="main sectors-main" role="main">

  <?php get_template_part('components/page/sectors-hero'); ?>
  <?php get_template_part('components/page/sectors-editor'); ?>
  <?php get_template_part('components/page/sectors-subsectors'); ?>
  <?php // get_template_part('components/page/sectors-team'); 
  ?>
  <?php get_template_part('components/page/sectors-skill-matrix');
  ?>
  <?php // get_template_part('components/page/sectors-skill-icon-grid'); 
  ?>

</main>

<?php get_footer(); ?>