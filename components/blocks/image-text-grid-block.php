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
    'supports' => [
      'align'           => ['wide', 'center', 'full'],
    ],
    'category'         => 'foundry-category', // common, formatting, layout, widgets, embed
    'icon' => array(
      // Specifying a background color to appear with the icon e.g.: in the inserter.
      'background' => '#323C4E ',
      // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
      'foreground' => '#ffffff',
      // Specifying a dashicon for the block
      'src' => 'editor-table',
      'mode'           => 'edit',
      'align'             => 'full',
    ),
    'keywords'         => ['foundry', 'image', 'text', 'grid']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_imageTextGridBlock($block, $content = '', $is_preview = false)
{
  $background_color = get_field('background_color');
  $image_left = get_field('image_left');
  $items = get_field('items');

  $block_id = 'fd-image-text-grid-' . ($block['id'] ?? uniqid());
  $image_left_class = $image_left ? 'image-left' : 'image-right';
  $style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
  ?>
  <div id="<?php echo esc_attr($block_id); ?>" class="fd-image-text-grid-block <?php echo esc_attr($image_left_class); ?>"<?php echo $style; ?>>
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
                <h3 class="fd-image-text-grid__title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>
              <?php if ($item_content) : ?>
                <div class="fd-image-text-grid__content"><?php echo wp_kses_post($item_content); ?></div>
              <?php endif; ?>
              <?php if ($button_url && $button_label) : ?>
                <a href="<?php echo esc_url($button_url); ?>" class="fd-image-text-grid__button"><?php echo esc_html($button_label); ?></a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php
}
