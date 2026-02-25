<?php

/**
 * WYSIWYG block – padding, background color, rich text content.
 * Requires ACF Version 5.8+
 */

/*==================================================================================
   wysiwyg-block, ACF Gutenberg Block
 ==================================================================================*/

if (function_exists('acf_register_block')) {

  acf_register_block(array(
    'name'              => 'fd-wysiwyg-block',
    'title'             => __('WYSIWYG block'),
    'description'       => __('Block with padding, background color and rich text content.'),
    'render_callback'   => 'foundry_gutenblock_wysiwygBlock',
    'mode'              => 'edit',
    'supports'          => [
      'align' => ['wide', 'center', 'full'],
    ],
    'category'          => 'foundry-category',
    'icon'              => array(
      'background' => '#323C4E',
      'foreground' => '#ffffff',
      'src'        => 'editor-alignleft',
    ),
    'keywords'          => ['foundry', 'wysiwyg', 'content', 'text'],
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_wysiwygBlock($block, $content = '', $is_preview = false)
{
  $padding_top    = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');
  $background_color = get_field('background_color');
  $wysiwyg_content = get_field('content');

  $block_id = 'fd-wysiwyg-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;

  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
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
  <section id="<?= esc_attr($block_id); ?>" class="fd-wysiwyg-block<?= $has_padding ? ' fdry-block-padding' : ''; ?>" <?= $block_style; ?>>
    <div class="content-block">
      <?php if ($wysiwyg_content) : ?>
        <div class="fd-wysiwyg-block__content">
          <?php echo $wysiwyg_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WYSIWYG content
          ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php
}
