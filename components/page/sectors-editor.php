<?php

/**
 *
 * @author      Andrea Musso
 *
 *
 */

// CONTENT
$term = get_queried_object();
$editor_content = get_field('editor', $term);

?>

<?php if ($editor_content) : ?>
  <section class="fd-wysiwyg-block">
    <div class="content-block">
      <div class="fd-wysiwyg-block__content">
        <?php echo $editor_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WYSIWYG content 
        ?>
      </div>
    </div>
  </section>
<?php endif; ?>