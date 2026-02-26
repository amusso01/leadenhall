<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   testimonial-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-testimonial-block',
    'title'             => __('Testimonial block'),
    'description'       => __('Testimonial block'),
    'render_callback'   => 'foundry_gutenblock_testimonialBlock',
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
    'keywords'         => ['foundry', 'testimonial']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_testimonialBlock($block, $content = '', $is_preview = false)
{
  $soft_blue = '#50617A';

  // OPTIONS
  $padding_top      = get_field('padding_top');
  $padding_bottom   = get_field('padding_bottom');
  $background_color = get_field('background_color');

  // CONTENT
  $image = get_field('image');
  $slides = get_field('slides');

  $block_id = 'fd-testimonial-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
  $bg_color = ($background_color !== '' && $background_color !== null) ? $background_color : $soft_blue;
  $block_style = sprintf(' style="background-color: %s;"', esc_attr($bg_color));
  $text_scheme = $bg_color && function_exists('foundry_contrast_text_from_hex')
    ? foundry_contrast_text_from_hex($bg_color)
    : 'dark';
  $text_class = ' fd-testimonial-block--text-' . $text_scheme;
?>
  <?php if ($has_padding) : ?>
    <style>
      #<?php echo esc_attr($block_id); ?> {
        <?php if ($pt !== null) : ?>--padding-pt: <?php echo (int) $pt; ?>px;
        <?php endif; ?><?php if ($pb !== null) : ?>--padding-pb: <?php echo (int) $pb; ?>px;
        <?php endif; ?>
      }
    </style>
  <?php endif; ?>
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-testimonial-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?><?php echo esc_attr($text_class); ?>" <?php echo $block_style; ?>>
    <div class="content-block">
      <div class="fd-testimonial-block__grid">
        <div class="fd-testimonial-block__slider-col">
          <h2 class="fd-testimonial-block__title">Testimonials</h2>
          <?php if (!empty($slides) && is_array($slides)) : ?>
            <div class="swiper fd-testimonial-block__slider">
              <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) : ?>
                  <?php $testimonial = $slide['testimonial'] ?? ''; ?>
                  <?php $author = $slide['author'] ?? ''; ?>
                  <div class="swiper-slide">
                    <div class="fd-testimonial-block__slide">
                      <?php if ($testimonial) : ?>
                        <div class="fd-testimonial-block__testimonial">
                          <span class="fd-testimonial-block__quote fd-testimonial-block__quote--start">&ldquo;</span>
                          <?php echo nl2br($testimonial); ?>
                        </div>
                      <?php endif; ?>

                      <?php if ($author) : ?>
                        <div class="fd-testimonial-block__author"><?= $author ?></div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="fd-testimonial-block__controls">
              <button class="fd-testimonial-block__prev" aria-label="Previous">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
              </button>
              <div class="fd-testimonial-block__pagination"></div>
              <button class="fd-testimonial-block__next" aria-label="Next">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="9 6 15 12 9 18"></polyline>
                </svg>
              </button>
            </div>
          <?php endif; ?>
        </div>
        <div class="fd-testimonial-block__image-col">
          <?php if ($image && !empty($image['ID'])) : ?>
            <div class="fd-testimonial-block__image">
              <?php echo wp_get_attachment_image((int) $image['ID'], 'large'); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php
}
