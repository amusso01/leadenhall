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
    'keywords'         => ['foundry', 'animated', 'numbers']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_animatedNumbersBlock()
{
  $background = get_field('background');
  $title      = get_field('title');
  $subtitle   = get_field('subtitle');
  $image      = get_field('image');
  $numbers    = get_field('numbers');

  $style = $background ? ' style="background-color: ' . esc_attr($background) . ';"' : '';
  ?>
  <section class="animated-numbers-block"<?php echo $style; ?>>
    <div class="animated-numbers-block__wrapper">
      <?php if ($title) : ?>
        <h2 class="animated-numbers-block__title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>
      <?php if ($subtitle) : ?>
        <div class="animated-numbers-block__subtitle"><?php echo wp_kses_post(nl2br($subtitle)); ?></div>
      <?php endif; ?>
      <?php if ($image && !empty($image['url'])) : ?>
        <div class="animated-numbers-block__image">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
        </div>
      <?php endif; ?>
      <?php if ($numbers && is_array($numbers)) : ?>
        <div class="animated-numbers-block__numbers">
          <?php foreach ($numbers as $row) : ?>
            <div class="animated-numbers-block__item">
              <?php
                $num = $row['number'] ?? '';
                $sym = $row['symbol'] ?? 'none';
                $sym_char = ($sym === 'plus') ? '+' : (($sym === 'percent') ? '%' : '');
                if ($num !== '' || $sym_char !== '') : ?>
                <span class="animated-numbers-block__number"><?php echo esc_html($num . $sym_char); ?></span>
              <?php endif; ?>
              <?php if (!empty($row['title'])) : ?>
                <span class="animated-numbers-block__item-title"><?php echo esc_html($row['title']); ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <?php
}
