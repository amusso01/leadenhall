<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   marquee-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-marquee-block',
    'title'             => __('Marquee block'),
    'description'       => __('Marquee block'),
    'render_callback'   => 'foundry_gutenblock_marqueeBlock',
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
    'keywords'         => ['foundry', 'marquee']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_marqueeBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  // (add content fields here)

  $block_id = 'fd-marquee-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
  ?>
<?php if ($has_padding) : ?>
  <style>
    #<?php echo esc_attr($block_id); ?> {
      <?php if ($pt !== null) : ?>--padding-pt: <?php echo (int) $pt; ?>px;<?php endif; ?>
      <?php if ($pb !== null) : ?>--padding-pb: <?php echo (int) $pb; ?>px;<?php endif; ?>
    }
  </style>
<?php endif; ?>
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-marquee-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?>">
    <div class="content-block">
      <div class="fd-marquee-block__wrapper">
    <?php // TODO: render block output ?>
      </div>
    </div>
  </section>
  <?php
}
