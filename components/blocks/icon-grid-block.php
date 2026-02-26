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
    'keywords'         => ['foundry', 'icon', 'grid']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_iconGridBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background_color = get_field('background_color');
  $grid_columns = get_field('grid_column_number') ?: 3;
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  $items = get_field('items');

  if (empty($items) || !is_array($items)) {
    return;
  }

  $block_id = 'fd-icon-grid-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;

  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
  $grid_class = 'fd-icon-grid--cols-' . (int) $grid_columns;
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
  <section id="<?= esc_attr($block_id); ?>" class="fd-icon-grid <?= esc_attr($grid_class); ?><?= $has_padding ? ' fdry-block-padding' : ''; ?>" <?= $block_style; ?>>
    <div class="content-block">
      <div class="fd-icon-grid__wrapper">
        <div class="fd-icon-grid__grid columns-<?= $grid_columns; ?>">
          <?php foreach ($items as $key => $item) : ?>
            <?php
            $icon = $item['icon'] ?? null;
            $title = $item['title'] ?? '';
            $link_url = isset($item['link']) && is_string($item['link']) ? trim($item['link']) : '';
            $content = $item['content'] ?? '';
            ?>
            <div class="fd-icon-grid__item" data-aos="fade-zoom-in" data-aos-offset="50" data-aos-easing="ease-in-sine" data-aos-duration="500">
              <?php if ($icon && !empty($icon['ID'])) : ?>
                <?php
                $icon_path = get_attached_file($icon['ID']);
                $svg_content = $icon_path ? acfFile_toSvg($icon_path) : '';
                ?>
                <?php if ($svg_content) : ?>
                  <div class="fd-icon-grid__icon" aria-hidden="true">
                    <?php echo $svg_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG from uploads 
                    ?>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
              <?php if ($title) : ?>
                <h5 class="fd-icon-grid__title"><?= esc_html($title); ?></h5>
              <?php endif; ?>
              <?php if ($content) : ?>
                <div class="fd-icon-grid__content"><?= nl2br(esc_html($content)); ?></div>
              <?php endif; ?>
              <?php if ($link_url) : ?>
                <a href="<?= esc_url($link_url); ?>" class="fd-icon-grid__link">Find Out More</a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php
}
