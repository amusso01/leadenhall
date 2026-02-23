<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   icon-grid-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-icon-grid-block',
    'title'             => __('Icon grid block'),
    'description'       => __('Icon grid block'),
    'render_callback'   => 'foundry_gutenblock_iconGridBlock',
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
    'keywords'         => ['foundry', 'icon', 'grid']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_iconGridBlock()
{
  $background_color = get_field('background_color');
  $grid_columns = get_field('grid_column_number') ?: 3;
  $items = get_field('items');

  if (empty($items) || !is_array($items)) {
    return;
  }

  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
  $grid_class = 'fd-icon-grid--cols-' . (int) $grid_columns;
  ?>
  <div class="fd-icon-grid <?php echo esc_attr($grid_class); ?>"<?php echo $block_style; ?>>
    <div class="fd-icon-grid__inner">
      <?php foreach ($items as $item) : ?>
        <?php
        $icon = $item['icon'] ?? null;
        $title = $item['title'] ?? '';
        $link = $item['link'] ?? null;
        $content = $item['content'] ?? '';
        $link_url = is_array($link) ? ($link['url'] ?? '') : '';
        $link_title = is_array($link) ? ($link['title'] ?? '') : '';
        $link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';
        ?>
        <div class="fd-icon-grid__item">
          <?php if ($icon && !empty($icon['url'])) : ?>
            <div class="fd-icon-grid__icon">
              <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? $title); ?>" loading="lazy" />
            </div>
          <?php endif; ?>
          <?php if ($title) : ?>
            <h3 class="fd-icon-grid__title"><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
          <?php if ($content) : ?>
            <div class="fd-icon-grid__content"><?php echo nl2br(esc_html($content)); ?></div>
          <?php endif; ?>
          <?php if ($link_url) : ?>
            <a href="<?php echo esc_url($link_url); ?>" class="fd-icon-grid__link"<?php echo $link_target === '_blank' ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html($link_title ?: $link_url); ?></a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
}
