<?php

/*
Plugin Name: Custom Events
Description: Enables Custom Events Post Type
Author: Adrian Boisclair
Version: 1.0.1
*/

class WehoDevCustomEvents
{

    /**
     * WehoDevCustomEvents constructor.
     * Initializes Plugin
     */
    public function __construct()
    {
        add_action('init', array($this, 'register_events_post_type'));
        add_action('wp_head', array($this, 'event_styles'));
        add_action('wp_head', array($this, 'event_scripts'));
        add_filter('archive_template', array($this, 'get_custom_post_type_template'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
    }

    /**
     * Register Events Post Type
     */
    public function register_events_post_type()
    {
        register_post_type('events',
            array(
                'labels' => array(
                    'name' => 'Events',
                    'singular_name' => 'Event',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Event',
                    'edit' => 'Edit',
                    'edit_item' => 'Edit Event',
                    'new_item' => 'New Event',
                    'view' => 'View',
                    'view_item' => 'View Event',
                    'search_items' => 'Search Events',
                    'not_found' => 'No Events found',
                    'not_found_in_trash' => 'No Events found in Trash',
                    'parent' => 'Parent Event'
                ),

                'public' => true,
                'menu_position' => 15,
                'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
                'taxonomies' => array(''),
                'menu_icon' => 'dashicons-calendar',
                'has_archive' => true
            )
        );
    }

    public function register_event_shortcode()
    {

    }

    public function event_shortcode($attributes)
    {
        $events = shortcode_atts(
            array(
                'foo' => 'something'
            ),
            $attributes
        );
        return "foo = {$events['foo']}";
    }

    public function event_styles()
    {
        ?>
        <style>
            ul#events li {
                display: inline-block;
            }

            ul#events li a {
                float: left;
                margin-right: 20px;;
            }

            ul#events li h2 {
                padding-top: 0;
            }
        </style>
        <?php
    }

    public function event_scripts()
    {
        wp_register_script('wehodev-custom-events', plugins_url('assets/javascript/scripts.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('wehodev-custom-events');

    }

    public function get_custom_post_type_template($archive_template)
    {
        global $post;

        if (is_post_type_archive('events')) {
            $archive_template = dirname(__FILE__) . '/templates/event-post-type-template.php';
        }
        return $archive_template;
    }

    /************************************************************************************************************
     ************************************************************************************************************
     ******************** Admin Options / Settings Page *********************************************************
     ************************************************************************************************************
     ***********************************************************************************************************/

    public function add_admin_menu()
    {
        add_options_page('WehoDevCustomEvents', 'WehoDevCustomEvents', 'manage_options', 'wehodev_staging_site_resources', array($this, 'options_page'));
    }


    public function settings_init()
    {

        register_setting('pluginPage', array($this, 'settings'));

        add_settings_section(
            'pluginPage_section',
            __('Adds Custom Events Post Types', 'wordpress'),
            array($this, 'settings_section_callback'),
            'pluginPage'
        );

        add_settings_field(
            'checkbox_field_1',
            __('Enable', 'wordpress'),
            array($this, 'checkbox_field_1_render'),
            'pluginPage',
            'pluginPage_section'
        );

    }

    public function checkbox_field_1_render()
    {

        $options = get_option('settings');
        ?>
        <label for="settings[checkbox_field_1]">
            <input type='checkbox'
                   name='settings[checkbox_field_1]' <?php checked($options['checkbox_field_1'], 1); ?>
                   value='1'>
        </label>
        <?php

    }


    public function settings_section_callback()
    {

        echo __('', 'wordpress');

    }


    public function options_page()
    {

        ?>
        <form action='options.php' method='post'>

            <h2>WEHODEV Custom Events</h2>

            <?php
            settings_fields('pluginPage');
            do_settings_sections('pluginPage');
            submit_button();
            ?>

        </form>
        <?php

    }

}

require_once(plugin_dir_path(__FILE__) . 'inc/index.php');

$WehoDevCustomEvents = new WehoDevCustomEvents();