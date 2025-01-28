<?php

/**
 * Theme Widget: Legacy Search
 */

if (!class_exists('BootstrapBasicLegacySearchWidget')) {
    class BootstrapBasicLegacySearchWidget extends WP_Widget
    {

        /**
         * @var string Widget title.
         */
        private $widget_title;

        /**
         * Class construction for theme search widget.
         */
        public function __construct()
        {
            parent::__construct(
                'bootstrapbasic_legacysearch_widget', // base ID
                __('Bootstrap Legacy Search', 'blue-lite'),
                array( 'description' => __('Display Search widget for Bootstrap that can be use in sidebar.', 'blue-lite') )
            );
        } // __construct

        /**
         * back-end widget form
         * 
         * @see WP_Widget::form()
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            /* search widget title */
            if (isset($instance['bootstrapbasic-legacysearch-widget-title'])) {
                $this->widget_title = $instance['bootstrapbasic-legacysearch-widget-title'];
            }

            /* output form */
            $output = '<p>';
            $output .= '<label for="' . $this->get_field_id('bootstrapbasic-legacysearch-widget-title') . '">' . __('Title:', 'blue-lite') . '</label>';
            $output .= '<input id="' . $this->get_field_id('bootstrapbasic-legacysearch-widget-title') . '" class="widefat" type="text" value="' . esc_attr($this->widget_title) . '" name="' . $this->get_field_name('bootstrapbasic-legacysearch-widget-title') . '">';
            $output .= '</p>';

            echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

            unset($output);
        } /* form */


        /**
         * Sanitize widget form values as they are saved.
         * 
         * @see WP_Widget::update()
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance)
        {
            $instance = array();

            if (isset($new_instance['bootstrapbasic-legacysearch-widget-title'])) {
                $instance['bootstrapbasic-legacysearch-widget-title'] = wp_strip_all_tags($new_instance['bootstrapbasic-legacysearch-widget-title']);
            } else {
                $instance['bootstrapbasic-legacysearch-widget-title'] = '';
            }

            return $instance;
        }

        /**
         * front-end display of widget
         * 
         * @see WP_Widget::widget()
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            $widget_title = $this->widget_title;
            if (isset($instance['bootstrapbasic-legacysearch-widget-title'])) {
                $widget_title = $instance['bootstrapbasic-legacysearch-widget-title'];
            }

            // set output front-end widget ---------------------------------
            $output = $args['before_widget'];

            if (isset($instance['bootstrapbasic-legacysearch-widget-title']) && $instance['bootstrapbasic-legacysearch-widget-title'] != null) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
                $output .= $args['before_title'] . apply_filters('widget_title', $instance['bootstrapbasic-legacysearch-widget-title']) . $args['after_title'] . "\n";
            }

            $searchFormArgs = []; // phpcs:ignore Universal.Arrays.DisallowShortArraySyntax.Found
            $searchFormArgs['echo'] = false;

            $output .= get_search_form($searchFormArgs);
            unset($searchFormArgs);

            $output .= $args['after_widget'];

            echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

            /* clear unused variables */
            unset($output);
        }
    }
}
