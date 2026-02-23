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
    'keywords'         => ['foundry', 'marquee']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_marqueeBlock()
{
  // TODO: render block output
}
