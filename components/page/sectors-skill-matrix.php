<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */

// CONTENT
$term = get_queried_object();
$roles = get_field('roles', $term);
$skills_matrix = get_field('skills_matrix', $term);

$has_roles = !empty($roles) && is_array($roles);
$has_skills = !empty($skills_matrix);

if (!$has_roles && !$has_skills) {
  return;
}

$rows = $has_roles ? (int) ceil(count($roles) / 2) : 0;

?>

<section class="sectors-skill-matrix">
  <div class="content-block">
    <h3 class="sectors-skill-matrix__roles-title">Typical Roles</h3>
    <div class="sectors-skill-matrix__layout">

      <?php if ($has_roles) : ?>
        <div class="sectors-skill-matrix__roles">

          <div class="sectors-skill-matrix__roles-grid" style="grid-template-rows: repeat(<?php echo $rows; ?>, auto);">
            <?php foreach ($roles as $item) : ?>
              <div class="sectors-skill-matrix__role">
                <span><?php echo esc_html($item['role']); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($has_skills) : ?>
        <div class="sectors-skill-matrix__skills">
          <h4 class="sectors-skill-matrix__skills-title">Skills matrix</h4>
          <div class="sectors-skill-matrix__skills-content">
            <?= wp_kses_post($skills_matrix); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>