<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */


// OPTION
$banner_height = '75'; // in vh

// CONTENT
$term = get_queried_object();

$hero_image = get_field('hero_image', $term);

$tagline = get_field('tagline', $term);

?>

<section class="hero-block">
  <div class="hero-block__wrapper" style="height: <?php echo $banner_height; ?>vh;">
    <div class="content-block">
      <div class="hero-block__image-wrapper">
        <img src="<?php echo $hero_image; ?>" alt="<?php echo $title; ?>" class="hero-block__image">
      </div>

      <div class="hero-block__content">
        <div class="hero-block__content-inner">
          <h1 class="hero-block__title"><?php echo single_term_title('', false); ?></h1>
          <?php if ($tagline) : ?>
            <div class="hero-block__subtitle"><?php echo $tagline; ?></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="hero-block__overlay"></div>
    </div>
  </div>
</section>