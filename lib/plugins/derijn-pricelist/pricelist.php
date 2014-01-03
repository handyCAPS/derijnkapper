<?php
/**
* Plugin Name: De Rijn Prijslijst
* Plugin URI:
* Description: Plugin die de prijslijst mogelijk maakt
* Version: 0.1.0
* Author: Tim Doppenberg
* Author URI: http://timdoppenberg.nl
* License: MIT
*/

register_activation_hook( __FILE__, 'derijn_pricelist_activation' );

function derijn_pricelist_activation() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'derijn_pricelist';
	// Creating the db table
	$sql = "CREATE TABLE $table_name (
			id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
			name varchar(30) NOT NULL,
			price DECIMAL(10,2) NOT NULL,
			UNIQUE KEY id(id)
		)
	";
	return $wpdb->query($sql);
}

// The form to go in the backend
function derijn_pricelist_admin_page() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'derijn_pricelist';
	$plugin_url = plugins_url('scripts/update-pricelist.php', __FILE__ );
	echo '<h1>Prijslijst De Rijn Kapper</h1>';
	$pricelist_form = "
		<form method='POST' action='' class='pricelist-form'>
		<fieldset>
		<legend>Prijzen toevoegen</legend>
		<label for='dienst'>Dienst : </label>
		<input type='text' name='dienst' id='dienst'><br>
		<label for='price'>Prijs : <span class='euro'>&euro;</span></label>
		<input type='text' name='price' id='price'><br>
		<input type='submit' id='pricelistSave' name='pricelistSave' value='Opslaan' class='button button-primary'>
		</fieldset>
		</form>
		<div id='load'></div>
	";

	$sql = "SELECT * FROM $table_name";

	$price_array = $wpdb->get_results($sql);

	$price_table = "<ul>";

	foreach ($price_array as $price) {
		$price_table .= "<li>$price->name</li>";
	}

	$price_table .= "</ul>";

	echo $pricelist_form;

	echo $price_table;


}

// Registering the admin page
function derijn_pricelist() {
	$page_title = 'Prijslijst';
	$menu_title = 'Prijslijst';
	$capability = 'manage_options';
	$menu_slug = 'derijn_pricelist_options';
	$function = 'derijn_pricelist_admin_page';
	$icon_url = 'dashicons-cart';
	$position = 10;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
add_action('admin_menu', 'derijn_pricelist' );

// Function to register the admin styles
function derijn_pricelist_styles() {
	// The css
	wp_register_style('pricelist_admin', plugins_url( 'scss/pricelist.css', __FILE__ ), array(), 'all' );
	wp_enqueue_style('pricelist_admin' );
	// The javascript
	wp_register_script('derijn_pricelist', plugins_url( 'js/pricelist.js', __FILE__ ), array(), false );
	wp_enqueue_script('derijn_pricelist');
}
add_action('admin_enqueue_scripts', 'derijn_pricelist_styles' );

// Creating a custom action for the back-end ajax request
add_action('wp_ajax_derijn_pricelist', 'derijn_update_pricelist');

function derijn_update_pricelist() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'derijn_pricelist';

	$name = trim($_POST['name']);
	$price = trim($_POST['price']);

	$sql = $wpdb->prepare("	INSERT into $table_name (name, price)
							VALUES (%s, %s)", $name, $price);
	$wpdb->query($sql);

	echo $name . ' ' . $price ;
	die();
}

?>