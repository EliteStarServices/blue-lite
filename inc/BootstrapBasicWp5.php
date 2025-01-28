<?php
/**
 * WordPress Blocks Support (Gutenberg).
 * !adapted from Bootstrap Basic v3
 */

if (!class_exists('BootstrapBasicWp5')) {
    class BootstrapBasicWp5
    {

        /**
         * Bootstrap Basic WP5 class constructor.
         */
        public function __construct()
        {
            // Add Bootstrap styles into Gutenberg editor.
            add_action('enqueue_block_editor_assets', array( $this, 'enqueueBlockEditorAssets' ));

            // Add Bootstrap styles into editor.
            add_action('admin_init', array( $this, 'addEditorStyles' ));
        }

        /**
         * Add Bootstrap styles into Classic Editor.
         */
        public function addEditorStyles()
        {
            if (function_exists('add_editor_style')) {
                add_editor_style('css/bootstrap.min.css');
            }
        }


        /**
         * Add Bootstrap Styles into Gutenberg Editor.
         * DISABLED SINCE v2.0.0
         *
        public function enqueueBlockEditorAssets()
        {
            if (!wp_script_is('bootstrap-style', 'registered')) {
                $BootstrapBasic = new BootstrapBasic();
                $BootstrapBasic->registerCommonStyles();
            }
            wp_enqueue_style('bootstrap-style');
        }// enqueueBlockEditorAssets
        */
    }
}
