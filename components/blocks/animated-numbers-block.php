<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   animated-numbers-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-animated-numbers-block',
    'title'             => __('Animated Numbers block'),
    'description'       => __('Animated Numbers block'),
    'render_callback'   => 'foundry_gutenblock_animatedNumbersBlock',
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
    'keywords'         => ['foundry', 'animated', 'numbers']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_animatedNumbersBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background = get_field('background');
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  $title      = get_field('title');
  $subtitle   = get_field('subtitle');
  $image      = get_field('image');
  $numbers    = get_field('numbers');

  $block_id = 'fd-animated-numbers-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;

  $style = $background ? ' style="background-color: ' . esc_attr($background) . ';"' : '';
  $text_scheme = $background && function_exists('foundry_contrast_text_from_hex')
    ? foundry_contrast_text_from_hex($background)
    : 'dark';
  $text_class = ' animated-numbers-block--text-' . $text_scheme;
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
  <section id="<?php echo esc_attr($block_id); ?>" class="animated-numbers-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?><?php echo esc_attr($text_class); ?>" <?php echo $style; ?>>
    <div class="content-block">
      <div class="animated-numbers-block__wrapper">
        <div class="animated-numbers-block__left">
          <?php if ($title) : ?>
            <h2 class="animated-numbers-block__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>
          <?php if ($subtitle) : ?>
            <div class="animated-numbers-block__subtitle"><?= $subtitle; ?></div>
          <?php endif; ?>
          <?php if ($numbers && is_array($numbers)) : ?>
            <div class="animated-numbers-block__numbers" role="list">
              <?php foreach ($numbers as $row) : ?>
                <div class="animated-numbers-block__item" role="listitem">
                  <?php if (!empty($row['title'])) : ?>
                    <span class="animated-numbers-block__item-title"><?php echo esc_html($row['title']); ?></span>
                  <?php endif; ?>
                  <?php
                  $num_raw = $row['number'] ?? '';
                  $sym = $row['symbol'] ?? 'none';
                  $sym_char = ($sym === 'plus') ? '+' : (($sym === 'percent') ? '%' : '');
                  $num_value = is_numeric($num_raw) ? floatval($num_raw) : 0;
                  $decimals = (is_numeric($num_raw) && strpos((string) $num_raw, '.') !== false) ? 1 : 0;
                  if ($num_raw !== '' || $sym_char !== '') : ?>
                    <span
                      class="animated-numbers-block__number js-count-up"
                      data-count-end="<?php echo esc_attr($num_value); ?>"
                      data-count-suffix="<?php echo esc_attr($sym_char); ?>"
                      data-count-decimals="<?php echo (int) $decimals; ?>"
                    ><?php echo esc_html($num_raw . $sym_char); ?></span>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <?php if ($image && !empty($image['url'])) : ?>
          <div class="animated-numbers-block__right">
            <div class="animated-numbers-block__image" data-aos="fade-in" data-aos-offset="100" data-aos-easing="ease-in-sine" data-aos-duration="600">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php
}
