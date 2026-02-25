<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   cards-grid-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-cards-grid-block',
    'title'             => __('Cards Grid block'),
    'description'       => __('Cards Grid block'),
    'render_callback'   => 'foundry_gutenblock_cardsGridBlock',
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
    'keywords'         => ['foundry', 'cards', 'grid']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_cardsGridBlock($block, $content = '', $is_preview = false)
{
  // OPTIONS
  $background_color = get_field('background_color');
  $padding_top      = get_field('padding_top');
  $padding_bottom   = get_field('padding_bottom');

  // CONTENT
  $title = get_field('title');
  $cards = get_field('cards');

  $block_id = 'fd-cards-grid-' . ($block['id'] ?? uniqid());
  $pt = ('' !== $padding_top && null !== $padding_top) ? max(0, min(200, (int) $padding_top)) : null;
  $pb = ('' !== $padding_bottom && null !== $padding_bottom) ? max(0, min(200, (int) $padding_bottom)) : null;
  $has_padding = $pt !== null || $pb !== null;
  $block_style = $background_color ? sprintf(' style="background-color: %s;"', esc_attr($background_color)) : '';
  $text_scheme = $background_color && function_exists('foundry_contrast_text_from_hex')
    ? foundry_contrast_text_from_hex($background_color)
    : 'dark';
  $text_class = ' fd-cards-grid-block--text-' . $text_scheme;
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
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-cards-grid-block<?php echo $has_padding ? ' fdry-block-padding' : ''; ?><?php echo esc_attr($text_class); ?>" <?php echo $block_style; ?>>
    <div class="content-block">
      <div class="fd-cards-grid-block__wrapper">
        <?php if ($title) : ?>
          <h2 class="fd-cards-grid-block__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($cards) && is_array($cards)) : ?>
          <div class="fd-cards-grid-block__grid">
            <?php foreach ($cards as $card) : ?>
              <?php
              $card_image = $card['image'] ?? null;
              $card_title = $card['title'] ?? '';
              $card_content = $card['content'] ?? '';
              ?>
              <div class="fd-cards-grid-block__card">
                <?php if ($card_image && !empty($card_image['ID'])) : ?>
                  <div class="fd-cards-grid-block__card-image">
                    <?php echo wp_get_attachment_image((int) $card_image['ID'], 'large'); ?>
                  </div>
                <?php endif; ?>
                <div class="fd-cards-grid-block__card-body" data-aos="zoom-in" data-aos-offset="100" data-aos-easing="ease-in-sine" data-aos-duration="600">
                  <?php if ($card_title) : ?>
                    <h3 class="fd-cards-grid-block__card-title"><?php echo esc_html($card_title); ?></h3>
                  <?php endif; ?>
                  <?php if ($card_content) : ?>
                    <div class="fd-cards-grid-block__card-content"><?php echo esc_html($card_content); ?></div>
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
