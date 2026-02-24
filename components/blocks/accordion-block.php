<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   slider-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-accordion-block',
    'title'             => __('Accordion block'),
    'description'       => __('Accordion block'),
    'render_callback'   => 'foundry_gutenblock_accordionBlock',
    'mode'             => 'edit',
    'supports' => [
      'align'           => ['wide', 'center', 'full'],
    ],
    'category'         => 'foundry-category', // common, formatting, layout, widgets, embed
    'icon' => array(
      'background' => '#323C4E ',
      'foreground' => '#ffffff',
      'src' => 'editor-table',
    ),
    'keywords'         => ['foundry', 'accordion', 'faqs']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

// CHECK LIGHTNESS OF AN HEX COLOR

function foundry_gutenblock_accordionBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $padding_top   = get_field('padding_top');
  $padding_bottom = get_field('padding_bottom');

  // CONTENT
  $accordion = get_field('accordion');

  // Unique block ID for per-block styling (used in scoped <style> and SCSS)
  $block_id = 'fd-accordion-' . ($block['id'] ?? uniqid());

  // Output CSS custom properties in a scoped <style> so SCSS can use them + media queries
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
  <section id="<?php echo esc_attr($block_id); ?>" class="accordion-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?>">
    <div class="content-block">
      <div class="accordion-block__wrapper">
        <div class="accordion-block__inner">

          <?php if ($accordion) :  ?>
            <div class="accordion-container">
              <?php foreach ($accordion as $single) : ?>
                <div class="ac">
                  <h4 class="ac-header">
                    <button type="button" class="ac-trigger"><?php echo $single['title'] ?></button>
                  </h4>
                  <div class="ac-panel">
                    <p class="ac-text"><?php echo $single['content'] ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>


<?php
}
