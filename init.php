<?php
/*
Plugin Name: postit
Description: Jaime Salinas postit plugin with short tag
Version: 1
Author: Jaime Salinas
Author URI: mailto:grisuno@gmail.com
*/
// function to create the DB / Options / Defaults
function ss_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "postit";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
             `id` int(10) NOT NULL,
			`nota` varchar(255) NOT NULL,
			`activa` int(2) NOT NULL DEFAULT '0',
			`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','wp_postit_modifymenu');
function wp_postit_modifymenu() {

	//this is the main item for the menu
	add_menu_page('Post-it', //page title
	'Post-it', //menu title
	'manage_options', //capabilities
	'wp_postit_list', //menu slug
	'wp_postit_list' //function
	);

	//this is a submenu
	add_submenu_page('wp_postit_list', //parent slug
	'Agrega nuevo postit', //page title
	'Agrega nuevo', //menu title
	'manage_options', //capability
	'wp_postit_create', //menu slug
	'wp_postit_create'); //function

	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Actualiza postit', //page title
	'Actualiza', //menu title
	'manage_options', //capability
	'wp_postit_update', //menu slug
	'wp_postit_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'postit-list.php');
require_once(ROOTDIR . 'postit-create.php');
require_once(ROOTDIR . 'postit-update.php');

function shortcode_postit() {
    global $wpdb;
    $table_name = $wpdb->prefix . "postit";
	$postit = $wpdb->get_results($wpdb->prepare("SELECT id,nota,activa,created from $table_name where activa=1 ORDER BY RAND() limit 1"));
	$html = "

	<style> @import 'https://fonts.googleapis.com/css?family=Reenie+Beanie';
	.postit {
	line-height: 1;
	text-align:center;
	width: 275px;
	margin: 25px;
	cursor: grab;
	min-height:250px;
	max-height:250px;
	padding-top:35px;
	position:fixed;
	border:1px solid #E8E8E8;
	border-top:5px solid #fdfd86;
	font-family:'Reenie Beanie';
	font-size:3em;
	border-bottom-right-radius: 60px 5px;
	display:inline-block;
	background: #ffff88; /* Old browsers */
	background: -moz-linear-gradient(-45deg, #ffff88 81%, #ffff88 82%, #ffff88 82%, #ffffc6 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right bottom, color-stop(81%,#ffff88), color-stop(82%,#ffff88), color-stop(82%,#ffff88), color-stop(100%,#ffffc6)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(-45deg, #ffff88 81%,#ffff88 82%,#ffff88 82%,#ffffc6 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(-45deg, #ffff88 81%,#ffff88 82%,#ffff88 82%,#ffffc6 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(-45deg, #ffff88 81%,#ffff88 82%,#ffff88 82%,#ffffc6 100%); /* IE10+ */
	background: linear-gradient(135deg, #ffff88 81%,#ffff88 82%,#ffff88 82%,#ffffc6 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffff88', endColorstr='#ffffc6',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	}

	.postit:after {
	content: '';
	position:fixed;
	z-index:1000000;
	right:-0px; bottom:20px;
	width:250px;
	height: 25px;
	background: rgba(0, 0, 0, 0.2);
	box-shadow:2px 15px 5px rgba(0, 0, 0, 0.40);
	-moz-transform: matrix(-1, -0.1, 0, 1, 0, 0);
	-webkit-transform: matrix(-1, -0.1, 0, 1, 0, 0);
		-o-transform: matrix(-1, -0.1, 0, 1, 0, 0);
		-ms-transform: matrix(-1, -0.1, 0, 1, 0, 0);
			transform: matrix(-1, -0.1, 0, 1, 0, 0);
	}
	.rotate {
				/* Safari */
				-webkit-transform: rotate(-10deg);
				/* Firefox */
				-moz-transform: rotate(-10deg);
				/* IE */
				-ms-transform: rotate(-10deg);
				/* Opera */
				-o-transform: rotate(-10deg);
				/* Internet Explorer */
				filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=1);
			}

	.cerrar{
		margin-top: -80px;

		margin-right: -220px;
	}
			</style><div style='z-index:10000;' class='postit'><div id='cerrar' class='btn btn-default cerrar'><i class='fa fa-times'></i></div><ul>";
	if(!empty($postit))
	{
		foreach ($postit as $p) {
			$html .=  "<li>".$p->nota."</li>";
		}
		$html .= "</ul></div>";

		return $html;
	}else{
		return false;
	}
}
add_shortcode('postit', 'shortcode_postit');
