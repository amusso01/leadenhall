<?php

/**
 * Requires ACF Version 5.8+
 *
 * @author      Andrea Musso
 *
 *
 */


/*==================================================================================
   teams-block, Preset ACF Gutenberg Block
 ==================================================================================*/

/* Register ACF Block
 /––––––––––––––––––––––––*/
if (function_exists('acf_register_block')) {

  $result = acf_register_block(array(
    'name'             => 'fd-teams-block',
    'title'             => __('Teams block'),
    'description'       => __('Display team members with sector and name filters'),
    'render_callback'   => 'foundry_gutenblock_teamsBlock',
    'mode'             => 'preview',
    'supports' => [
      'align'           => ['wide', 'center', 'full'],
    ],
    'category'         => 'foundry-category',
    'icon' => array(
      'background' => '#323C4E ',
      'foreground' => '#ffffff',
      'src' => 'groups',
    ),
    'keywords'         => ['foundry', 'teams', 'team', 'members']
  ));
}

/* Render Block
 /––––––––––––––––––––––––*/

function foundry_gutenblock_teamsBlock($block, $content = '', $is_preview = false)
{
  $block_id = 'fd-teams-' . ($block['id'] ?? uniqid());

  // Fetch all team members
  $team_members = get_posts(array(
    'post_type'      => 'team',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
  ));

  // Fetch all sectors
  $sectors = get_terms(array(
    'taxonomy'   => 'sector',
    'hide_empty' => true,
  ));
?>
  <section id="<?php echo esc_attr($block_id); ?>" class="fd-teams-block">
    <div class="content-block">
      <!-- Filters -->
      <div class="fd-teams-block__filters">
        <div class="fd-teams-block__filter-sector">
          <button class="fd-teams-block__sector-toggle" type="button" aria-expanded="false">
            <span>Search by sectors</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>
          <?php if (!empty($sectors) && !is_wp_error($sectors)) : ?>
            <div class="fd-teams-block__sector-dropdown">
              <button class="fd-teams-block__sector-option fd-teams-block__sector-option--active" data-sector="" type="button">All sectors</button>
              <?php foreach ($sectors as $sector) : ?>
                <button class="fd-teams-block__sector-option" data-sector="<?php echo esc_attr($sector->slug); ?>" type="button">
                  <?php echo esc_html($sector->name); ?>
                </button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="fd-teams-block__filter-search">
          <input type="text" class="fd-teams-block__search-input" placeholder="Search by name" />
          <svg class="fd-teams-block__search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
      </div>

      <!-- Team Grid -->
      <div class="fd-teams-block__grid">
        <?php foreach ($team_members as $member) :
          $member_id   = $member->ID;
          $name        = get_the_title($member_id);
          $role        = get_field('role', $member_id);
          $thumbnail   = get_the_post_thumbnail($member_id, 'medium_large');
          $member_sectors = wp_get_post_terms($member_id, 'sector', array('fields' => 'slugs'));
          $sector_data = !is_wp_error($member_sectors) ? implode(' ', $member_sectors) : '';
        ?>
          <div class="fd-teams-block__card" data-sectors="<?php echo esc_attr($sector_data); ?>" data-name="<?php echo esc_attr(strtolower($name)); ?>">
            <div class="fd-teams-block__card-image">
              <?php if ($thumbnail) : ?>
                <?php echo $thumbnail; ?>
              <?php endif; ?>
            </div>
            <h3 class="fd-teams-block__card-name"><?php echo esc_html($name); ?></h3>
            <?php if ($role) : ?>
              <p class="fd-teams-block__card-role"><?php echo esc_html($role); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- No results message -->
      <p class="fd-teams-block__no-results" style="display: none;">No team members found.</p>
    </div>
  </section>
<?php
  wp_reset_postdata();
}
