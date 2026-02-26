<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   image-text-grid-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-image-text-grid-block',
    'title'             => __('Image text grid block'),
    'description'       => __('Image text grid block'),
    'render_callback'   => 'foundry_gutenblock_imageTextGridBlock',
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
    'keywords'         => ['foundry', 'image', 'text', 'grid']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_imageTextGridBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background_color = get_field('background_color');
  $image_left = get_field('image_left');
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  $items = get_field('items');

  $block_id = 'fd-image-text-grid-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;

  $image_left_class = $image_left ? 'image-left' : 'image-right';
  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
  $text_scheme = $background_color && function_exists('foundry_contrast_text_from_hex')
    ? foundry_contrast_text_from_hex($background_color)
    : 'dark';
  $text_class = ' fd-image-text-grid-block--text-' . $text_scheme;
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
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-image-text-grid-block <?php echo esc_attr($image_left_class); ?><?php echo $has_padding ? ' fdry-block-padding' : ''; ?><?php echo esc_attr($text_class); ?>" <?php echo $block_style; ?>>
    <div class="content-block">
      <div class="fd-image-text-grid-block__wrapper">
        <?php if (!empty($items) && is_array($items)) : ?>
          <div class="fd-image-text-grid__items">
            <?php foreach ($items as $item) :
              $img = $item['image'] ?? null;
              $title = $item['title'] ?? '';
              $item_content = $item['content'] ?? '';
              $button_url = $item['button_url'] ?? '';
              $button_label = $item['button_label'] ?? '';
            ?>
              <div class="fd-image-text-grid__item">
                <?php if (!empty($img) && is_array($img)) : ?>
                  <div class="fd-image-text-grid__media">
                    <img src="<?php echo esc_url($img['url'] ?? ''); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" />
                  </div>
                <?php endif; ?>
                <div class="fd-image-text-grid__body">
                  <?php if ($title) : ?>
                    <h2 class="fd-image-text-grid__title"><?php echo esc_html($title); ?></h2>
                  <?php endif; ?>
                  <?php if ($item_content) : ?>
                    <div class="fd-image-text-grid__content"><?php echo wp_kses_post($item_content); ?></div>
                  <?php endif; ?>
                  <?php if ($button_url && $button_label) : ?>
                    <a href="<?php echo esc_url($button_url); ?>" class="btn"><?php echo esc_html($button_label); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php
}
