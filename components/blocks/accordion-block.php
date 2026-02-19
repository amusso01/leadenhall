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
    'supports' => [
      'align'           => ['wide', 'center', 'full'],
    ],
    'category'         => 'foundry-category', // common, formatting, layout, widgets, embed
    'icon' => array(
      // Specifying a background color to appear with the icon e.g.: in the inserter.
      'background' => '#011025 ',
      // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
      'foreground' => '#ffffff',
      // Specifying a dashicon for the block
      'src' => 'editor-table',
      'mode'           => 'edit',
      'align'             => 'full',
    ),
    'keywords'         => ['foundry', 'accordion', 'faqs']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

// CHECK LIGHTNESS OF AN HEX COLOR

function foundry_gutenblock_accordionBlock()
{

  // Get Options
  $accordion = get_field('accordion');


  // Get Content




  // Return HTML
?>

  <section class="accordion-block">

    <div class="accordion-block__wrapper">
      <div class="content-block">

        <div class="accordion-block__inner ">

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
