<?php
/*
 * Plugin Name:       Plugin Actions Links Demo
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Plugin Actions Links Demo
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mohammad Sabuj Khan
 * Author URI:        https://sabuj.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       action-plugin
 * Domain Path:       /languages
 */


 function acin_texdomain_load(){
    load_plugin_textdomain( 'action-plugin', false, dirname( __FILE__ ) . '/languages' );
 }
 add_action('plugins_loaded', 'acin_texdomain_load');


 function acin_admin_menu_setting(){
    add_menu_page(
        __('Action Links', 'action-plugin'),
        __('Action Links', 'action-plugin'),
        'manage_options',
        'action_links',
        'acin_action_links_page_content'
    );
 }
 function acin_action_links_page_content(){
    echo "<h2>Hello World<h2>";
 }
 add_action('admin_menu', 'acin_admin_menu_setting');



 function acin_activated_plugin_action($plugin){
    if( $plugin == plugin_basename(__FILE__) ){
        wp_redirect(admin_url('admin.php?page=action_links'));
        die();
    }
 }
 add_action('activated_plugin', 'acin_activated_plugin_action');


 function acin_plugin_settings_option($links){
    $link = sprintf("<a href='%s' style='color:maroon'>%s</a>", admin_url('admin.php?page=action_links'), __('Settings', 'action-plugin'));
    array_push($links, $link);
    return $links;
 }
 add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'acin_plugin_settings_option');


function acin_plugin_row_link_add($links, $plugin){
    if( $plugin == plugin_basename(__FILE__) ){
        $link = sprintf("<a href='%s' style='color:maroon'>%s</a>", esc_url('https://github.com/sabuj-khan'), __('Jump to Github', 'action-plugin'));
        array_push($links, $link);
        
        
    }
    return $links;
}
 add_filter('plugin_row_meta', 'acin_plugin_row_link_add', 10, 2);
