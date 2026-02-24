<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   hero-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-hero-block',
    'title'             => __('Hero block'),
    'description'       => __('Hero block'),
    'render_callback'   => 'foundry_gutenblock_heroBlock',
    'mode'             => 'edit',
    'supports' => [
      'align'           => ['wide', 'center', 'full'],
    ],
    'category'         => 'foundry-category',
    'icon' => array(
      'background' => '#323C4E ',
      'foreground' => '#ffffff',
      'src' => 'editor-table',
    ),
    'keywords'         => ['foundry', 'hero']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_heroBlock($block, $content = '', $is_preview = false)
{

  // OPTION
  $is_video = get_field('is_video');
  $banner_height = get_field('banner_height');
  $overlay_opacity = get_field('overlay_opacity');
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT

  if ($is_video) {
    $hero_video = get_field('hero_video');
    $hero_video_poster = get_field('hero_video_poster');
  } else {
    $hero_image = get_field('hero_image');
  }

  $title = get_field('title');
  $subtitle = get_field('subtitle');

  $button = get_field('button_label');
  $button_url = get_field('button_link');

  $block_id = 'fd-hero-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
?>

  <?php if ($has_padding) : ?>
    <style>
      #<?= esc_attr($block_id); ?> {
        <?php if ($pt !== null) : ?>--padding-pt: <?= (int) $pt; ?>px;
        <?php endif; ?><?php if ($pb !== null) : ?>--padding-pb: <?= (int) $pb; ?>px;
        <?php endif; ?>
      }
    </style>
  <?php endif; ?>
  <section id="<?= esc_attr($block_id); ?>" class="hero-block<?= $has_padding ? ' fdry-block-padding' : ''; ?>">
    <div class="hero-block__wrapper" style="height: <?= $banner_height; ?>vh;">
      <div class="content-block">
        <?php if ($is_video) : ?>
          <div class="hero-block__video-wrapper">
            <video src="<?= $hero_video; ?>" <?php if (! empty($hero_video_poster)) : ?>poster="<?= esc_url($hero_video_poster); ?>" <?php endif; ?> autoplay loop muted playsinline class="hero-block__video">
              <source src="<?= $hero_video; ?>" type="video/mp4">
            </video>
          </div>
        <?php else : ?>
          <div class="hero-block__image-wrapper">
            <img src="<?= $hero_image; ?>" alt="<?= $title; ?>" class="hero-block__image">
          </div>
        <?php endif; ?>

        <div class="hero-block__content">
          <div class="hero-block__content-inner">
            <h1 class="hero-block__title"><?= $title; ?></h1>
            <?php if ($subtitle) : ?>
              <div class="hero-block__subtitle"><?= $subtitle; ?></div>
            <?php endif; ?>
            <?php if ($button || $button_url) : ?>
              <a href="<?= $button_url; ?>" class="hero-block__button btn btn--white"><?= $button ? $button : $button_url; ?></a>
            <?php endif; ?>
          </div>
        </div>

        <div class="hero-block__overlay" style="opacity: <?= $overlay_opacity; ?>;"></div>
      </div>
    </div>
  </section>
<?php
}
