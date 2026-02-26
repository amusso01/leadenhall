<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */

// CONTENT
$term = get_queried_object();

$team_members = new WP_Query(array(
  'post_type'      => 'team',
  'posts_per_page' => -1,
  'tax_query'      => array(
    array(
      'taxonomy' => 'sector',
      'field'    => 'term_id',
      'terms'    => $term->term_id,
    ),
  ),
));

if (!$team_members->have_posts()) {
  wp_reset_postdata();
  return;
}

?>

<section class="sectors-team">
  <div class="content-block">
    <div class="sectors-team__header">
      <h3 class="sectors-team__title"><?php echo esc_html($term->name); ?> Team</h3>
      <div class="sectors-team__nav">
        <button class="sectors-team__prev" aria-label="Previous">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <button class="sectors-team__next" aria-label="Next">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 6 15 12 9 18"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="swiper sectors-team__slider">
    <div class="swiper-wrapper">
      <?php while ($team_members->have_posts()) : $team_members->the_post(); ?>
        <?php $role = get_field('role'); ?>
        <div class="swiper-slide">
          <div class="sectors-team__card">
            <?php if (has_post_thumbnail()) : ?>
              <div class="sectors-team__card-image">
                <?php the_post_thumbnail('medium_large'); ?>
              </div>
            <?php endif; ?>
            <p class="sectors-team__card-name"><?php the_title(); ?></p>
            <?php if ($role) : ?>
              <p class="sectors-team__card-role"><?php echo esc_html($role); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php wp_reset_postdata(); ?>