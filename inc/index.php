<?php

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path($path)
{

    // update path
    $path = get_acf_path() . '/settings';

    // return
    return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir($dir)
{

    // update path
    $dir = get_acf_path();

    // return
    return $dir;

}


// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once(get_acf_path() . 'acf.php');


add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{

    // update path
    $path = get_acf_path() . 'settings/';

    // return
    return $path;

}

/**
 * Get Local ACF Path
 * @return string
 */
function get_acf_path()
{
    return plugin_dir_path(__FILE__) . 'vendor/advanced-custom-fields/';
}
