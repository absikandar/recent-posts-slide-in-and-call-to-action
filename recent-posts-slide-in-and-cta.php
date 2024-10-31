<?php/** * Plugin Name: Recent Posts Slide In and Call to Action * Plugin URI:   * Description: A WordPress plugin that adds a Slide In area containing recent posts and a Call to Action.  * Version:     1.1 * Author:      Abu Bakar * Author URI:  http://www.theweb-designs.com * Text Domain: rpsi_cta * License:     GPLv2 or later * License URI: http://www.gnu.org/licenses/gpl-2.0.html**/// exit if accessed directlyif (!defined('ABSPATH')) {    exit;}//Define plugin pathdefine('RPSI_CTA_DIR', plugin_dir_path( __FILE__ ));define('RPSI_CTA_URL', plugin_dir_url( __FILE__ ));//require plugin filesrequire_once RPSI_CTA_DIR . 'admin/admin.php';require_once RPSI_CTA_DIR . 'recent-posts-slide-in-and-cta-output.php';register_activation_hook(__FILE__, 'rpsi_cta_on_activation_fn');function rpsi_cta_on_activation_fn(){	do_action('rpsi_cta_set_globals');}add_filter('rpsi_cta_toggler_on_txt', 'rpsi_ct_toggler_on_txt_change_fn');function rpsi_ct_toggler_on_txt_change_fn(){	$options = rpsi_cta_options_globals();	$rpsi_cta_toggler_on_alttxt = $options['rpsi_cta_field_toggler_on_txt'];		return wp_strip_all_tags($rpsi_cta_toggler_on_alttxt, true);}add_filter('rpsi_cta_toggler_off_txt', 'rpsi_ct_toggler_off_txt_change_fn');function rpsi_ct_toggler_off_txt_change_fn(){	$options = rpsi_cta_options_globals();	$rpsi_cta_toggler_off_alttxt = $options['rpsi_cta_field_toggler_off_txt'];		return wp_strip_all_tags($rpsi_cta_toggler_off_alttxt, true);}