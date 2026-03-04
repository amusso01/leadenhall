<?php

/**
 * Template Name: Narrow Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foundry
 */

get_header();
?>

<main role="main" class="site-main page-main">
	<div class="content-block" style="max-width: 1000px; margin: 0 auto;">
		<?php

		if (have_posts()) :
			while (have_posts()) :
				the_post();

				the_content();


			endwhile; // End of the loop.

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>
	</div>
</main><!-- #main -->


<?php
get_footer();
