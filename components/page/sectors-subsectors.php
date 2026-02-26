<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */

// CONTENT
$term = get_queried_object();
$sub_sectors = get_field('sub_sector', $term);

?>

<?php if (!empty($sub_sectors) && is_array($sub_sectors)) : ?>
  <section class="sectors-subsectors">
    <div class="content-block">
      <h3 class="sectors-subsectors__title">Sub Sectors</h3>
      <div class="sectors-subsectors__grid">
        <?php foreach ($sub_sectors as $item) : ?>
          <?php
          $icon  = $item['icon'] ?? null;
          $title = $item['title'] ?? '';
          ?>
          <div class="sectors-subsectors__item">
            <?php if ($icon && !empty($icon['ID'])) : ?>
              <?php
              $icon_path   = get_attached_file($icon['ID']);
              $svg_content = $icon_path ? acfFile_toSvg($icon_path) : '';
              ?>
              <?php if ($svg_content) : ?>
                <div class="sectors-subsectors__icon" aria-hidden="true">
                  <?php echo $svg_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG 
                  ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <?php if ($title) : ?>
              <h5 class="sectors-subsectors__item-title"><?php echo esc_html($title); ?></h5>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>