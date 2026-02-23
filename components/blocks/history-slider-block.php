<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   history-slider-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-history-slider-block',
    'title'             => __('History slider block'),
    'description'       => __('History slider block'),
    'render_callback'   => 'foundry_gutenblock_historySliderBlock',
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
    'keywords'         => ['foundry', 'history', 'slider']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_historySliderBlock()
{
  // TODO: render block output
}
