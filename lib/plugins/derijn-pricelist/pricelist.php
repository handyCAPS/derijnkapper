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
			ordering int NOT NULL,
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

	$sql = $wpdb->prepare("SELECT * FROM %s", $table_name);

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

class De_Rijn_Prijzen_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function De_Rijn_Prijzen_Widget() {
        $widget_ops = array( 'classname' => 'price-widget', 'description' => 'De prijslijst widget' );
        $this->WP_Widget( 'price-widget', 'Prijslijst', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );

        if (!empty($instance)) {
            foreach ($instance as $key => $value) {
                ${$key} = esc_html($value);
            }
        }

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        $price_table = "
            <ul>
                <li>
                    <div class='dienst dotlist__item'>$dienst</div>
                    <div class='price dotlist__item'>&#128; $prijs</div>
                </li>
            </ul>
        ";

        // echo $price_table;
        echo $this->get_the_pricelist();

        echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        $updated_instance = array();

        if (!empty($new_instance)) {
            foreach ($new_instance as $key => $value) {
                $updated_instance[$key] = sanitize_text_field($value);
            }
        }

        return $updated_instance;
    }

    function get_the_pricelist() {
    	global $wpdb;
    	$table_name = $wpdb->prefix . 'derijn_pricelist';

    	$sql = $wpdb->prepare("SELECT * FROM %s", $table_name);
    	$result = $wpdb->get_results($sql);

    	$table = '<ul>';

    	foreach ($result as $prices_array) {
    		$price = str_replace('.', ',', $prices_array->price);
    		$name = str_replace('.', ',', $prices_array->name);

    		$table .= "<li><div class='dienst dotlist__item'>$name</div><div class='price dotlist__item'>$price</div></li>";
    	}
    	$table .= '</ul>';

    	return $table;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {

        $input_fields = array(
            'title',
            'dienst',
            'prijs'
            );

        foreach ($input_fields as $key => $value) {
            ${$value} = $instance[$value];
            ${$value . 'id'} = $this->get_field_name($value);
            ${$value . 'name'} = $this->get_field_name($value);
        }
        $prize_form = "
        <br>
        <label for='$titleid'>Titel</label><br>
        <input type='text' name='$titlename' id='$titleid' value='$title'><br>
        ";

        echo $prize_form;
        echo $this->get_the_pricelist();

    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'De_Rijn_Prijzen_Widget' );" ) );

?>