<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @author Andrea Musso
 *
 * @package foundry
 */

?>

</div><!-- #content -->

<footer class="site-footer">
	<div class="site-footer__inner content-block ">
		<div class="site-footer__item site-footer__left ">

			<div class="site-footer__left-logo">
				<?php get_template_part('components/header/logo'); ?>
			</div>

			<div class="site-footer__left-info-content">
				<p><?php echo get_field('description', 'option') ?></p>
			</div>

			<div class="site-footer__left-credits-logo">
				<?php get_template_part('svg-template/svg-credits') ?>
			</div>

		</div>


		<div class="site-footer__item site-footer__right">

			<div class="site-footer__right-menus">
				<div class="footer-nav-work-with-us site-footer__right-menu">
					<h4>Work with us</h4>
					<?php get_template_part('components/navigation/footer-nav', 'work-with-us') ?>
				</div>
				<div class="footer-nav-meet-us site-footer__right-menu">
					<h4>Meet us</h4>
					<?php get_template_part('components/navigation/footer-nav', 'meet-us') ?>
				</div>
				<div class="footer-address site-footer__right-menu">
					<h4>Contact</h4>
					<div class="footer-address-content"><?php echo get_field('address', 'option') ?></div>
					<a href="mailto:<?php echo get_field('email', 'option') ?>"><?php echo get_field('email', 'option') ?></a>
					<a href="tel:<?php echo get_field('phone', 'option') ?>"><?php echo get_field('phone', 'option') ?></a>
				</div>
			</div>



			<div class="site-footer__right-social-nav">
				<ul>
					<li><a href="<?php echo get_field('linkedin', 'option') ?>" target="_blank" rel="noopener noreferrer">Linkedin</a></li>
					<li><a href="<?php echo get_field('instagram', 'option') ?>" target="_blank" rel="noopener noreferrer">Instagram</a></li>
				</ul>
				<?php get_template_part('components/footer/copyright') ?>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>