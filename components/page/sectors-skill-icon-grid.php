<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */

// Get all sector terms
$sectors = get_terms(array(
  'taxonomy'   => 'sector',
  'hide_empty' => false,
));

if (empty($sectors) || is_wp_error($sectors)) {
  return;
}

?>

<section class="fd-icon-grid sectors-icon-grid">
  <div class="content-block">
    <div class="fd-icon-grid__wrapper">
      <h2 class="sectors-icon-grid__title">Our Specialisms</h2>
      <p class="sectors-icon-grid__subtitle">Across Permanent, Contract, Temporary and Executive Search</p>
      <div class="fd-icon-grid__grid columns-<?php echo count($sectors) >= 4 ? '4' : count($sectors); ?>">
        <?php foreach ($sectors as $sector) : ?>
          <?php
          $icon = get_field('sector_icon', $sector);
          $link = get_term_link($sector);
          ?>
          <div class="fd-icon-grid__item">
            <?php if ($icon && !empty($icon['ID'])) : ?>
              <?php
              $icon_path   = get_attached_file($icon['ID']);
              $svg_content = $icon_path ? acfFile_toSvg($icon_path) : '';
              ?>
              <?php if ($svg_content) : ?>
                <a href="<?php echo esc_url($link); ?>">
                  <div class="fd-icon-grid__icon" aria-hidden="true">
                    <?php echo $svg_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG 
                    ?>
                  </div>
                </a>
              <?php endif; ?>
            <?php endif; ?>
            <h5 class="fd-icon-grid__title"><?php echo esc_html($sector->name); ?></h5>
            <?php if (!is_wp_error($link)) : ?>
              <a href="<?php echo esc_url($link); ?>" class="fd-icon-grid__link">Find Out More</a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>