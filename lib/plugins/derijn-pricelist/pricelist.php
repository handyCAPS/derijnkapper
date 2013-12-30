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

function derijn_pricelist_admin_page() {
	echo '<h1>Prijslijst De Rijn Kapper</h1>';
	$pricelist_form = "
		<form method='POST' action='' class='pricelist-form'>
		<fieldset>
		<legend>Prijzen toevoegen</legend>
		<label for='dienst'>Dienst : </label>
		<input type='text' name='dienst' id='dienst'><br>
		<label for='prijs'>Prijs : <span class='euro'>&euro;</span></label>
		<input type='text' name='prijs' id='prijs'><br>
		<input type='submit' value='Opslaan' class='button button-primary'>
		</fieldset>
		</form>
	";
	echo $pricelist_form;
}

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
?>