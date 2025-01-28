<?php

/**
 * Template for displaying search form
 */

$aria_label = '';
if (isset($args['aria_label']) && !empty($args['aria_label'])) {
    $aria_label = ' aria-label="' . esc_attr($args['aria_label']) . '"';
}
$form_classes = '';
if (isset($args['bootstrapbasic']['form_classes'])) {
    $form_classes = ' ' . $args['bootstrapbasic']['form_classes'];
}
$display_for = '';
if (isset($args['bootstrapbasic']['display_for'])) {
    $display_for = $args['bootstrapbasic']['display_for'];
}
// phpcs:disable 
?>
<form class="search-form form<?php echo $form_classes; ?>" <?php echo $aria_label; ?>role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <?php if ('navbar' === $display_for) { ?>
        <div class="form-group">
            <input class="form-control" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'blue-lite'); ?>" title="<?php echo esc_attr_x('Search for:', 'label', 'blue-lite'); ?>">
        </div>
        <button type="submit" class="btn btn-default"><?php esc_html_e('Search', 'blue-lite'); ?></button>
    <?php } else { ?>
        <label for="form-search-input" class="sr-only"><?php _ex('Search for', 'label', 'blue-lite'); ?></label>
        <div class="input-group">
            <input id="form-search-input" class="form-control" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'blue-lite'); ?>" title="<?php echo esc_attr_x('Search for:', 'label', 'blue-lite'); ?>">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><?php esc_html_e('Search', 'blue-lite'); ?></button>
            </span>
        </div>
    <?php } // phpcs:enable 
    ?>
</form>