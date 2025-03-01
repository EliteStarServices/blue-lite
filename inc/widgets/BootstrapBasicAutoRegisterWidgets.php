<?php

/**
 * Auto register widgets.
 */


if (!class_exists('BootstrapBasicAutoRegisterWidgets')) {
    class BootstrapBasicAutoRegisterWidgets
    {


        /**
         * Register all widgets that come with this theme.
         */
        public function registerAll()
        {
            $widgets_folder = __DIR__;
            $DirectoryIterator = new \DirectoryIterator($widgets_folder);

            foreach ($DirectoryIterator as $fileinfo) {
                if (!$fileinfo->isDot() && $fileinfo->isFile() && strtolower($fileinfo->getExtension()) === 'php') {
                    $file_name_only = $fileinfo->getBasename('.php');
                    $class_name = __NAMESPACE__ . (!empty(__NAMESPACE__) ? '\\' : '') . $file_name_only;
                    require_once($fileinfo->getRealPath()); // needs require to use `class_exists()`.

                    if ($class_name != __CLASS__ && class_exists($class_name)) { // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
                        add_action('widgets_init', function () use ($class_name) {
                            return register_widget($class_name);
                        });
                    }

                    unset($class_name, $file_name_only);
                }
            }
            unset($DirectoryIterator, $fileinfo, $widgets_folder);
        }
    }
}
