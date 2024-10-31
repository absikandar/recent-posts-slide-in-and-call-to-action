<?php
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'rpsi_cta_menu');
add_action('admin_init', 'rpsi_cta_settings_register' );

function rpsi_cta_menu() {
	
	$rpsi_cta_page = add_options_page( 'Recent Posts Slide-In and CTA', 'Recent Posts Slide-In and CTA', 'administrator', 'rpsi-cta-options', 'rpsi_cta_options_menu_fn' );
	
	add_action( 'load-' . $rpsi_cta_page, 'rpsi_cta_load_admin_scripts_fn' );
	
	//add_submenu_page( 'rpsi-cta-options', 'Reset All Options', 'Reset', 'administrator', 'rpsi-cta-options-reset', 'rpsi_cta_options_resetmenu_fn');
}

// Register our settings. Add the settings section, and settings fields
function rpsi_cta_settings_register(){
	
	register_setting('rpsi_cta_settings', 'rpsi_cta_options', '' );
		
	add_settings_section('rpsi_cta_section_basic', 'Basic Settings', 'rpsi_cta_section_basic_fn', __FILE__);		
				
	add_settings_field('rpsi_cta_field_activate_output', 'Activate', 'rpsi_cta_field_activate_output_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_posts_num', 'Number of Posts to Show', 'rpsi_cta_field_posts_num_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_theme_color', 'Theme Color', 'rpsi_cta_field_theme_color_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_default_state', 'Default State on Page Load', 'rpsi_cta_field_default_state_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	//add_settings_field('rpsi_cta_field_display_pages', 'Display on pages', 'rpsi_cta_field_display_pages_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	
	add_settings_field('rpsi_cta_field_display_delay', 'Delay slide in by mili-seconds', 'rpsi_cta_field_display_delay_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_toggler_on_txt', 'Slide-In Opening Text', 'rpsi_cta_field_toggler_on_txt_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_toggler_off_txt', 'Slide-In Closing Text', 'rpsi_cta_field_toggler_off_txt_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_cta_bg_img', 'Call to Action Background Image', 'rpsi_cta_field_cta_bg_img_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_cta_txt', 'Call to Action Text', 'rpsi_cta_field_cta_txt_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	add_settings_field('rpsi_cta_field_custom_css', 'Custom CSS', 'rpsi_cta_field_custom_css_fn', __FILE__, 'rpsi_cta_section_basic', array( 'class' => 'rpsi_cta_class' ));
	
	//add_settings_section('rpsi_cta_section_reset', 'Reset Settings', 'rpsi_cta_section_reset_fn', __FILE__);
		
}



function rpsi_cta_section_basic_fn() {
	echo'';
}

function rpsi_cta_field_activate_output_fn() {	
		
	$options = rpsi_cta_options_globals();
		
	echo '<input name="rpsi_cta_options[rpsi_cta_field_activate_output]" id="rpsi_cta_field_activate_output" type="checkbox" value="1" class="" ' . checked( 1, $options['rpsi_cta_field_activate_output'], false ) . ' /> Check to Enable Display of this plugin.';
}

function rpsi_cta_field_posts_num_fn(){
	
	$options = rpsi_cta_options_globals();
	
	echo'<input type="number" id="rpsi_cta_field_posts_num" class="" name="rpsi_cta_options[rpsi_cta_field_posts_num]" value="'.$options['rpsi_cta_field_posts_num'].'" /> <br /> Default is 5. Enter -1 to display all posts.'; 
}

function rpsi_cta_field_theme_color_fn() {
	
	$options = rpsi_cta_options_globals();

	echo'<input type="text" id="rpsi_cta_field_theme_color" class="rpsi-cta-color-picker" name="rpsi_cta_options[rpsi_cta_field_theme_color]" data-default-color="#e67945" value="'.$options['rpsi_cta_field_theme_color']. '" />Select general theme color here. (For further customizations, use the Custom CSS section below.)';
}

function rpsi_cta_field_default_state_fn(){
	
	$options = rpsi_cta_options_globals();
	
	$items = array('Open', 'Close');

	echo "<select id='rpsi_cta_field_default_state' name='rpsi_cta_options[rpsi_cta_field_default_state]'>";
	foreach($items as $item) {
		$selected = ($options['rpsi_cta_field_default_state']==$item) ? 'selected="selected"' : '';
		echo "<option id='$item' value='$item' $selected>$item</option>";
	}
	echo "</select>";
}


/* function rpsi_cta_field_display_pages_fn(){
	
	$options = rpsi_cta_options_globals();
	
	foreach ( get_post_types( '', 'names' ) as $post_type ) {
		
		echo '<input name="rpsi_cta_options[rpsi_cta_field_display_pages][]" id="rpsi_cta_field_display_pages" type="checkbox" value="1" class="" ' . checked( 1, $options['rpsi_cta_field_display_pages'], false ) . ' />';
		echo '<p>' . $post_type . '</p>';
		
		}
}
 */

function rpsi_cta_field_display_delay_fn(){
	
	$options = rpsi_cta_options_globals();

	echo'<input type="number" id="rpsi_cta_field_display_delay" class="" name="rpsi_cta_options[rpsi_cta_field_display_delay]" value="'.$options['rpsi_cta_field_display_delay'].'" /></br>Delay Slide in by mili-seconds. 1 second = 1000 miliseconds. For example, to put a delay of 2 secs, enter value 2000. This field works only if `Default State on Page Load` is set to Open ';
}





function rpsi_cta_field_toggler_on_txt_fn() {
	
	$options = rpsi_cta_options_globals();

	echo'<input type="text" id="rpsi_cta_field_toggler_on_txt" class="" name="rpsi_cta_options[rpsi_cta_field_toggler_on_txt]" value="'.wp_strip_all_tags($options['rpsi_cta_field_toggler_on_txt'], true).'" /></br>Text for Opening Slide In';
}

function rpsi_cta_field_toggler_off_txt_fn() {
	
	$options = rpsi_cta_options_globals();

	echo'<input type="text" id="rpsi_cta_field_toggler_off_txt" class="" name="rpsi_cta_options[rpsi_cta_field_toggler_off_txt]" value="'.wp_strip_all_tags( $options['rpsi_cta_field_toggler_off_txt'], true ).'" /></br>Text for Closing Slide In';
}






function rpsi_cta_field_cta_bg_img_fn(){

	$options = rpsi_cta_options_globals();

	echo'<input type="text" id="rpsi_cta_field_cta_bg_img" name="rpsi_cta_options[rpsi_cta_field_cta_bg_img]" value="' .$options['rpsi_cta_field_cta_bg_img']. '" class="regular-text" />';
	
	echo'<input type="button" name="upload-btn" id="rpsi_upload-btn" class="button-secondary" value="Upload Image">';
} 

function rpsi_cta_field_cta_txt_fn() {
	
	$options = rpsi_cta_options_globals();
	
	$content = $options['rpsi_cta_field_cta_txt'];
		
	$txtareasettings = array( 
		'textarea_name'=> 'rpsi_cta_options[rpsi_cta_field_cta_txt]',
		'textarea_rows'=> '10',
		'wpautop'=> false,
	);
	
	wp_editor( $content , 'rpsi_cta_field_cta_txt', $txtareasettings );
	
	echo'HTML is allowed';

}

function rpsi_cta_field_custom_css_fn() {
	
	$options = rpsi_cta_options_globals();
	
	echo'<textarea type="textarea" id="rpsi_cta_field_custom_css" name="rpsi_cta_options[rpsi_cta_field_custom_css]" rows="7" cols="70" style="border:1px solid #ccc; background-color:#FBFBFB;" placeholder="Custom CSS Here ...">'. $options['rpsi_cta_field_custom_css']. '</textarea>';
	
}

// Display the admin options page
function rpsi_cta_options_menu_fn() { ?>
<style type="text/css">
h2.rpsi_email_title_txt {
	margin: 0;
}

.form-table {
}

.form-table tr {
	display: table;
	border-collapse: separate;
}
</style>

<div class="wrap">
  <div class="icon32" id="icon-options-general"><br>
  </div>
  <h2>Recent Posts Slide-In and Call to Action</h2>
    <div class="">
	<form action="options.php" method="post" id="rpsi_cta_form">
		<?php settings_fields('rpsi_cta_settings'); ?>
		<?php do_settings_sections(__FILE__); ?>
	  <p class="submit">
        <input name="submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
      </p>
    
	</form>
  </div>
</div>
<div class="wrap">
<div class="">
 <p class="submit"></p> 
<h1>Reset Defaults</h1>
	<form method="post" action="">
	 <p><strong>Click the button below to load Default Settings: (After resetting, refresh the page to load default values.)</strong></p> 
	 <input type="hidden" name="action" value="reset" />
	 <input name="reset" class="button button-secondary" type="submit" value="Reset to default settings" >
	 </form
  </div>
</div>
<?php 
	if( isset($_POST['reset']) ) {
		delete_option('rpsi_cta_options');
		echo '<p style="color:red">Plugins settings have been reset. Please refresh the page to load default values.</p>';
	}
?>
<?php
}


// Define default option settings

add_action('rpsi_cta_set_globals', 'rpsi_cta_options_globals');

function rpsi_cta_options_globals() {
	
      $defaults = array(
        'rpsi_cta_field_activate_output' => 0,
		'rpsi_cta_field_posts_num' => 5, 
		'rpsi_cta_field_theme_color' => '#e67945',
		'rpsi_cta_field_default_state' => 'Open',
		/* 'rpsi_cta_field_display_pages' => 'post', */
		'rpsi_cta_field_display_delay' => 0,
		'rpsi_cta_field_toggler_on_txt' => 'Top Offers',
		'rpsi_cta_field_toggler_off_txt' => 'Hide Me',
		'rpsi_cta_field_cta_bg_img' => RPSI_CTA_URL .'/assets/images/rpsi_cta_bg.jpeg',
		'rpsi_cta_field_cta_txt' => '<h5>Where can I get some?</h5><h2>What is Lorem Ipsum?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</p>
		<a href="#" title="CTA Link">Call to Action Button</a>',
		
		'rpsi_cta_field_custom_css' => '',		
      );
	  
      $options = wp_parse_args(get_option('rpsi_cta_options'), $defaults);
	  return $options;
}






//register admin script
function rpsi_cta_load_admin_scripts_fn(){
		add_action( 'admin_enqueue_scripts', 'rpsi_cta_admin_scripts_fn' );
}

function rpsi_cta_admin_scripts_fn() {

	wp_enqueue_media();
    //enqueue iris colorpicker
	wp_enqueue_style( 'wp-color-picker' );
	
	wp_enqueue_script( 'rpsi_cta_admin_js', RPSI_CTA_URL . 'admin/js/admin_js.js', array('jquery', 'wp-color-picker'), null, true);
}

function rpsi_cta_admin_notice() {
	$options = rpsi_cta_options_globals();
	$rpsi_cta_activate = $options['rpsi_cta_field_activate_output'];
	if( !$rpsi_cta_activate == 1 ) :
		$class = 'notice notice-error is-dismissible';
		$message = __( 'The plugin Recent Posts Slide-In and CTA is activated. One last step, <a href="options-general.php?page=rpsi-cta-options">go to plugin settings</a> and enable its display on frontend.', 'rpsi_cta' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) ); 
	endif;
}
add_action( 'admin_notices', 'rpsi_cta_admin_notice' );
