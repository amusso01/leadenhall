<?php

/*==================================================================================
Register color paette for guttenberg
==================================================================================*/
function ea_setup()
{
	// Disable Custom Colors
	add_theme_support('disable-custom-colors');

	// Editor Color Palette
	add_theme_support('editor-color-palette', array(
		array(
			'name'  => __('Dark Blue', 'foundry'),
			'slug'  => 'dark-blue',
			'color'	=> '#323C4E',
		),
		array(
			'name'  => __('White', 'foundry'),
			'slug'  => 'white',
			'color' => '#FFFFFF',
		),
		array(
			'name'  => __('Soft White', 'foundry'),
			'slug'  => 'soft-white',
			'color' => '#FAF9F9',
		),
		array(
			'name'  => __('Orange', 'foundry'),
			'slug'  => 'orange',
			'color' => '#FF844C',
		),
		array(
			'name'  => __('Darkest Blue', 'foundry'),
			'slug'  => 'darkest-blue',
			'color' => '#263143',
		),
		array(
			'name'  => __('Soft Blue', 'foundry'),
			'slug'  => 'soft-blue',
			'color' => '#50617A',
		),
		array(
			'name'  => __('Grey', 'foundry'),
			'slug'  => 'grey',
			'color' => '#ECEBEB',
		),
	));
}
add_action('after_setup_theme', 'ea_setup');

/*==================================================================================
Allow certain block on Guttenberg
==================================================================================*/

/* function misha_allowed_block_types( $allowed_blocks ) {
 
	return array(
		'acf/fd-greybgtext',
		'acf/fd-sharetitle',
		'acf/fd-bluebg',
		'acf/fd-button',
		'acf/fd-teamcard',
		'acf/fd-imagetext',
		'acf/mediatextareablock',
		'core/image',
		'core/separator',
		'core/spacer',
		'core/paragraph',
		'core/heading',
		'core/list'
	);
 
}

add_filter( 'allowed_block_types', 'misha_allowed_block_types' );*/

/*==================================================================================
ADD JS
==================================================================================*/
/**
 * Enqueue block JavaScript and CSS for the editor
 */
// function my_block_plugin_editor_scripts()
// {
// 	// Enqueue block editor styles

// 	// Enqueue block editor JS
// 	wp_enqueue_script('lazysizes', get_template_directory_uri() . '/js/lazysizes.js', array(), true);
// }

// Hook the enqueue functions into the editor
// add_action('enqueue_block_editor_assets', 'my_block_plugin_editor_scripts');

/*==================================================================================
Wrap certain blocks with a div (narrow-width / content-block)
==================================================================================*/
function fdry_block_wrapper($block_content, $block)
{
	$block_name = $block['blockName'] ?? '';

	$wrappers = array(
		'core/paragraph'  => 'wp-block-paragraph  content-block',
		'core/heading'    => 'wp-block-title  content-block',
		'core/image'      => 'wp-block-image  content-block',
		'core/separator'  => 'wp-block-separator  content-block',
		'core/list'       => 'wp-block-list  content-block',
		'core/embed'      => 'wp-block-embed__wrapper content-block',
		'core/group'      => 'wp-block-group fd-narrow-width',
	);

	if (!empty($wrappers[$block_name])) {
		return '<div class="' . esc_attr($wrappers[$block_name]) . '">' . $block_content . '</div>';
	}

	return $block_content;
}
add_filter('render_block', 'fdry_block_wrapper', 10, 2);

/*==================================================================================
Register back-end CSS editor
==================================================================================*/
add_theme_support('editor-styles');
add_editor_style('./dist/styles/root.css');
add_editor_style('./dist/styles/main.css');
add_editor_style('./static/editor.css');
/*==================================================================================
Register new category in guttenberg block
==================================================================================*/

function my_foundry_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'foundry-category',
				'title' => __('Foundry', 'foundry'),
			),
		)
	);
}
add_filter('block_categories', 'my_foundry_category', 10, 2);

/*==================================================================================
LOAD CUSTOM ACF-GUTENBERG-BLOCKS
==================================================================================*/

require get_template_directory() . '/components/blocks/accordion-block.php';
require get_template_directory() . '/components/blocks/hero-block.php';
require get_template_directory() . '/components/blocks/animated-numbers-block.php';
require get_template_directory() . '/components/blocks/global-map-block.php';
require get_template_directory() . '/components/blocks/image-text-grid-block.php';
require get_template_directory() . '/components/blocks/cards-grid-block.php';
require get_template_directory() . '/components/blocks/icon-grid-block.php';
require get_template_directory() . '/components/blocks/wysiwyg-block.php';
require get_template_directory() . '/components/blocks/history-slider-block.php';
require get_template_directory() . '/components/blocks/testimonial-block.php';
require get_template_directory() . '/components/blocks/marquee-block.php';
require get_template_directory() . '/components/blocks/teams-block.php';


/**
 * Disable Editor From certain tempalte/Page
 **/

/**
 * Templates and Page IDs without editor
 *
 */
// function ea_disable_editor($id = false)
// {

// 	$excluded_templates = array(
// 		// 'templates/modules.php',
// 		// 'templates/contact.php'
// 		'template-page/two-col-page.php'
// 	);

// 	$excluded_ids = array(
// 		// get_option( 'page_on_front' )
// 		6523
// 	);

// 	if (empty($id))
// 		return false;

// 	$id = intval($id);
// 	$template = get_page_template_slug($id);

// 	return in_array($id, $excluded_ids) || in_array($template, $excluded_templates);
// }

/**
 * Disable Gutenberg by template
 *
 */
// function ea_disable_gutenberg($can_edit, $post_type)
// {

// 	if (! (is_admin() && !empty($_GET['post'])))
// 		return $can_edit;

// 	if (ea_disable_editor($_GET['post']))
// 		$can_edit = false;

// 	return $can_edit;
// }
// add_filter('gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2);
// add_filter('use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2);
