<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   global-map-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-global-map-block',
    'title'             => __('Global map block'),
    'description'       => __('Global map block'),
    'render_callback'   => 'foundry_gutenblock_globalMapBlock',
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
    'keywords'         => ['foundry', 'global', 'map']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_globalMapBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background     = get_field('background');
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  $title = get_field('title');
  $subtitle = get_field('subtitle');

  $block_id = 'fd-global-map-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
  $block_style = $background ? sprintf(' style="background-color: %s;"', esc_attr($background)) : '';
  $text_scheme = $background && function_exists('foundry_contrast_text_from_hex')
    ? foundry_contrast_text_from_hex($background)
    : 'dark';
  $text_class = ' fd-global-map-block--text-' . $text_scheme;
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
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-global-map-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?><?php echo esc_attr($text_class); ?>" <?php echo $block_style; ?>>
    <div class="content-block">
      <div class="fd-global-map-block__wrapper">
        <div class="fd-global-map-block__content">
          <div class="fd-global-map-block__title">
            <h2><?php echo esc_html($title); ?></h2>
          </div>

          <div class="fd-global-map-block__subtitle">
            <p><?= $subtitle; ?></p>
          </div>
        </div>

        <div class="fd-global-map-block__map">
          <?php get_template_part('svg-template/svg-world'); ?>
        </div>

      </div>
    </div>
  </section>
<?php
}
