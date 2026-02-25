<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   history-slider-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-history-slider-block',
    'title'             => __('History slider block'),
    'description'       => __('History slider block'),
    'render_callback'   => 'foundry_gutenblock_historySliderBlock',
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
    'keywords'         => ['foundry', 'history', 'slider']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_historySliderBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background_color = get_field('background_color');
  $padding_top      = get_field('padding_top');
  $padding_bottom   = get_field('padding_bottom');

  // CONTENT
  $title  = get_field('title');
  $slides = get_field('slides');

  $block_id = 'fd-history-slider-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
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
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-history-slider-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?>" <?php echo $block_style; ?>>
    <div class="content-block">
      <div class="fd-history-slider-block__wrapper">
        <?php if ($title) : ?>
          <h2 class="fd-history-slider-block__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
      </div>
      <?php if (!empty($slides) && is_array($slides)) : ?>
        <div class="swiper fd-history-slider-block__slider">
          <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) : ?>
              <?php
              $year    = $slide['year'] ?? '';
              $image   = $slide['image'] ?? null;
              $content = $slide['content'] ?? '';
              ?>
              <div class="swiper-slide">
                <?php if ($year) : ?>
                  <div class="fd-history-slider-block__year"><?php echo esc_html($year); ?></div>
                <?php endif; ?>
                <?php if ($image && !empty($image['ID'])) : ?>
                  <div class="fd-history-slider-block__image">
                    <?php echo wp_get_attachment_image((int) $image['ID'], 'large'); ?>
                  </div>
                <?php endif; ?>
                <?php if ($content) : ?>
                  <div class="fd-history-slider-block__content"><?php echo nl2br(esc_html($content)); ?></div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </section>
<?php
}
