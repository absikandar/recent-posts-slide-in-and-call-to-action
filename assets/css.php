<?php
// exit if accessed directly
//version 1.1
if (!defined('ABSPATH')) {
    exit;
}
$options = rpsi_cta_options_globals();
$rpsi_theme_color = $options['rpsi_cta_field_theme_color'];
$rpsi_bg_img = $options['rpsi_cta_field_cta_bg_img'];
$rpsi_custom_css = $options['rpsi_cta_field_custom_css']; ?>
<style type="text/css">
.rpsi_cta_wrap {
	width: 425px;
	height: 100vh;
	position: fixed;
	right: 0;
	top: 0;
	background-color: #fafafa;
	z-index: 9999999999;
	-webkit-transition: 200ms;
	-moz-transition: 200ms;
	-ms-transition: 200ms;
	-o-transition: 200ms;
	transition: 200ms;
	-webkit-box-shadow: -13px 0px 66px -27px #000;
	-moz-box-shadow: -13px 0px 66px -27px #000;
	-ms-box-shadow: -13px 0px 66px -27px #000;
	-o-box-shadow: -13px 0px 66px -27px #000;
	box-shadow: -13px 0px 66px -27px #000;
}
.rpsi_cta_wrap.rpsi_toggle {
	right: -425px;
}
.rpsi_cta_toggler {
	width: 145px;
	height: 45px;
	position: absolute;
	top: 25%;
	left: -144px;
	background-color: <?php echo esc_attr( $rpsi_theme_color ); ?>;
	font-size: 14px;
	line-height: 45px;
	color: #fff;
	font-style: italic;
	letter-spacing: 1px;
	padding-left: 10px;
	padding-right: 10px;
	text-align: center;
	cursor: pointer;
	z-index: 99999;
	-webkit-transition: 300ms;
	-moz-transition: 300ms;
	-ms-transition: 300ms;
	-o-transition: 300ms;
	transition: 300ms;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	-o-border-radius: 3px;
	border-radius: 3px;
}
.rpsi_cta_toggler:hover, .rpsi_cta_toggler:focus {
	background-color: #333;
}
.rpsi_cta_wrap .rpsi_cta_toggler_on {
	display: none !important;
}
.rpsi_cta_wrap .rpsi_cta_toggler_off {
	display: block !important;
}
.rpsi_cta_wrap.rpsi_toggle .rpsi_cta_toggler_on {
	display: block !important;
}
.rpsi_cta_wrap.rpsi_toggle .rpsi_cta_toggler_off {
	display: none !important;
}
.rpsi_cta_inner {
	height: 100vh;
	overflow: auto;
}
.rpsicta_wrap {
	height: 375px;
	background-image: url('<?php echo esc_url( $rpsi_bg_img ); ?>');
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
	background-color: rgba(0, 0, 0, 0.52);
	background-blend-mode: overlay;
	padding: 50px 25px 25px;
	color: #fff;
}
.rpsicta_wrap h2, .rpsicta_wrap h5, .rpsicta_wrap p, .rpsicta_wrap a {
	padding-top: 0;
	padding-bottom: 0;
	margin-top: 10px;
	margin-bottom: 25px;
	color: #fff;
}
.rpsicta_wrap h2 {
	font-size: 26px;
}
.rpsicta_wrap h5 {
	font-size: 12px;
	font-weight: 400;
	letter-spacing: 4px;
	text-transform: uppercase;
}
.rpsicta_wrap p {
	font-size: 15px;
}
.rpsicta_wrap a {
	background-color: <?php echo esc_attr( $rpsi_theme_color ); ?>;
	display: inline-block;
	height: 40px;
	line-height: 40px;
	padding: 0 25px;
	border: none;
	outline: none;
	box-shadow: none;
	border-radius: 0;
	cursor: pointer;
}
.rpsicta_wrap a:hover, .rpsicta_wrap a:focus {
	background-color: #333;
}
.rpsi_block {
	display: table;
	padding: 25px 20px;
	clear: both;
	border-bottom: 1px solid #cecece;
	-webkit-transition: 200ms;
	-moz-transition: 200ms;
	-ms-transition: 200ms;
	-o-transition: 200ms;
	transition: 200ms;
	border-left: 6px solid <?php echo esc_attr( $rpsi_theme_color ); ?>;
}
.rpsi_block:hover, .rpsi_block:focus {
	background-color: <?php echo esc_attr( $rpsi_theme_color ); ?>;
	color: #fff;
	text-decoration: none;
}
.rpsi_heading {
	width: 100%;
	height: 41px;
	font-size: 15px;
	font-weight: bold;
	line-height: 41px;
	background-color: #333;
	color: #fff;
	padding: 0 25px;
}
.rpsi_thumb, .rpsi_content_wrap {
	display: table-cell;
	vertical-align: top;
}
.rpsi_thumb {
	max-width: 80px;
	height: auto;
}
.rpsi_content_wrap {
	padding-left: 15px;
}
.rpsi_title {
	font-size: 13px;
	font-weight: bold;
	color: <?php echo esc_attr( $rpsi_theme_color ); ?>;
	margin-bottom: 7px;
}
.rpsi_block:hover .rpsi_title, .rpsi_block:focus .rpsi_title, .rpsi_block:hover .rpsi_content, .rpsi_block:focus .rpsi_content {
	color: #fff;
}
.rpsi_title:after {
	content: '';
	position: relative;
	display: block;
	width: 38px;
	height: 0;
	background-color: transparent;
	clear: both;
	border: 1px solid <?php echo esc_attr( $rpsi_theme_color ); ?>;
	margin-top: 5px;
	margin-bottom: 8px;
}
.rpsi_block:hover .rpsi_title:after, .rpsi_block:focus .rpsi_title:after {
	border-color: #fff;
}
.rpsi_content {
	font-size: 13px;
	line-height: 22px;
	color: #333;
}

@media screen and (max-width: 767px) {
	.rpsi_cta_wrap { 
		width: 100%;
		height: 400px;
		top: auto;
		bottom: 0;
	}
	
	.rpsi_cta_wrap.rpsi_toggle {
		right: auto;
		bottom: -400px;
	}
	
	.rpsi_cta_toggler {
		top: -45px;
		left: auto;
		right: 0;
		border-radius: 0;
	}
	
	.rpsi_cta_inner {
		height: 100%;
	}
	
	.rpsi_cta_wrap .rpsicta_wrap {
		height: auto;
	}
}
<?php 
	//output custom css
	echo $rpsi_custom_css; 
?>
</style>