<?php
/**
 * All Dependencies are imported here
 */

// Include Advanced Custom Fields
include_once(get_acf_path() . 'acf.php');


/**
 * Get Local ACF Path
 * @return string
 */
function get_acf_path()
{
    return plugin_dir_path(__FILE__) . 'vendor/advanced-custom-fields/';
}

/**
 * @param $path
 * @return string
 */
function my_acf_settings_path($path)
{
    return get_acf_path() . '/settings';
}

/**
 * @param $dir
 * @return string
 */
function my_acf_settings_dir($dir)
{
    return get_acf_path();
}

/**
 * @param $path
 * @return string
 */
function my_acf_json_save_point($path)
{
    return get_acf_path() . 'settings/';
}

add_filter('acf/settings/path', 'my_acf_settings_path');
add_filter('acf/settings/dir', 'my_acf_settings_dir');
add_filter('acf/settings/show_admin', '__return_false');
add_filter('acf/settings/save_json', 'my_acf_json_save_point');