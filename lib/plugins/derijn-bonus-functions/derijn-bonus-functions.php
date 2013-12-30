<?php
/**
 * Plugin Name: De Rijn bonus functions
 * Plugin URI:
 * Description: Extra functionality for de Rijn Kapper
 * Version:
 * Author:
 * Author URI:
 * License: GPL2
 *
  */

// A custom widget to display a table
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class De_Rijn_Table_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function De_Rijn_Table_Widget() {
        $widget_ops = array( 'classname' => 'derijn_table', 'description' => 'De tafel met openingstijden' );
        $this->WP_Widget( 'derijn_table', 'Openingstijden', $widget_ops );
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
        // $title = apply_filters( 'widget_title', $instance['title']);
        echo $before_widget;

    //
    // Widget display logic goes here
    //
        if (!empty($instance)) {
            foreach ($instance as $key => $value) {
                ${$key} = esc_html($value);
            }
        }
        // $dayone = $instance['dayone'];
        // $daytwo = $instance['daytwo'];
        // $daythree = $instance['daythree'];

        $derijn_table = "
        <table>
            <tr>
                <td>$dayone</td>
                <td>$timeone</td>
                <td>$typeone</td>
            </tr>
            <tr>
                <td>$daytwo</td>
                <td>$timetwo</td>
                <td>$typetwo</td>
            </tr>
            <tr>
                <td>$daythree</td>
                <td>$timethree</td>
                <td>$typethree</td>
            </tr>
        </table>
        ";

        echo $before_title;
        echo $title;
        echo $after_title;

        echo $derijn_table;

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

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {

        $input_fields = array(
            'title',
            'dayone',
            'daytwo',
            'daythree',
            'timeone',
            'timetwo',
            'timethree',
            'typeone',
            'typetwo',
            'typethree'
            );

        foreach ($input_fields as $key => $value) {
            ${$value} = $instance[$value];
            ${$value . 'id'} = $this->get_field_name($value);
            ${$value . 'name'} = $this->get_field_name($value);
        }

        $title_form = "
            <label for='$titleid'>Titel</label>
            <input class='widefat' type='text' id='$titleid' name='$titlename' value='$title'><br><br>
        ";

        $table_form = "
        <label for='$dayoneid'>Dag 1</label>
        <input class='widefat' type='text' name='$dayonename' id='$dayoneid' value='$dayone'><br><br>
        <label for='$daytwoid'>Dag 2</label>
        <input class='widefat' type='text' name='$daytwoname' id='$daytwoid' value='$daytwo'><br><br>
        <label for='$daythreeid'>Dag 3</label>
        <input class='widefat' type='text' name='$daythreename' id='$daythreeid' value='$daythree'><br><br><br>
        <label for='$timeoneid'>Tijd $dayone</label>
        <input class='widefat' type='text' name='$timeonename' id='$timeoneid' value='$timeone'><br><br>
        <label for='$timetwoid'>Tijd $daytwo</label>
        <input class='widefat' type='text' name='$timetwoname' id='$timetwoid' value='$timetwo'><br><br>
        <label for='$timethreeid'>Tijd $daythree</label>
        <input class='widefat' type='text' name='$timethreename' id='$timethreeid' value='$timethree'><br><br><br>
        <label for='$typeoneid'>Afspraak $dayone</label>
        <input class='widefat' type='text' name='$typeonename' id='$typeoneid' value='$typeone'><br><br>
        <label for='$typetwoid'>Afspraak $daytwo</label>
        <input class='widefat' type='text' name='$typetwoname' id='$typetwoid' value='$typetwo'><br><br>
        <label for='$typethreeid'>Afspraak $daythree</label>
        <input class='widefat' type='text' name='$typethreename' id='$typethreeid' value='$typethree'><br><br>
        ";

        echo $title_form;
        echo $table_form;

    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'De_Rijn_Table_Widget' );" ) );

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class DeRijn_Link_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function DeRijn_Link_Widget() {
        $widget_ops = array( 'classname' => 'derijn_link', 'description' => 'Eenvoudige links in de sidebar' );
        $this->WP_Widget( 'derijn_link', 'Eenvoudige link', $widget_ops );
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

        $pageid = '';
        if (isset($_REQUEST['page_id'])) {
            $pageid = '/?page_id=';
        }

        $path = get_home_url() . $pageid . $_REQUEST['page_id'];
        $current = '';
        if ($path == $url) {
            $current = 'current_sidebar_link';
        }

        echo $before_widget;
    //
    // Widget display logic goes here
    //
        echo "<a href='$url' class='sidebar_link $current'>$title</a>";

        echo $after_widget;
    }

    /**
     * Get all pages and return them as options in a select box
     *
     */
    private function get_all_pages($instance) {

       $url = $instance['url'];
       $home = home_url();
       $allpages = get_pages();

       $alloptions = '<option value="' . $home . '">Home</option>' ;

       foreach ($allpages as $page) {
           $selected = '';
           $page_option = get_page_link($page->ID);
           if ($url == $page_option) {
                $selected = 'selected';
               }

           $option = "<option value='" . get_page_link($page->ID) . "' " . $selected . " >" . $page->post_title . "</option>";
           $alloptions .= $option;
       }
       return $alloptions;
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

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {

        $input_fields = array(
            'title',
            'url'
            );

        foreach ($input_fields as $key => $value) {
            ${$value} = $instance[$value];
            ${$value . 'id'} = $this->get_field_name($value);
            ${$value . 'name'} = $this->get_field_name($value);
        }
        $link_form = "
        <label for='$titleid'>Titel: </label>
        <input class='widefat' type='text' id='$titleid' name='$titlename' value='$title'><br><br>
        <label for='$urlid'>Pagina: </label>
        <select class='widefat' id='$urlid' name='$urlname'>
        " . $this->get_all_pages($instance) . "</select>";

        echo $link_form;
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'DeRijn_Link_Widget' );" ) );

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
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

        echo $price_table;

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
        <h3>Voeg een prijs toe aan de prijslijst</h3>
        <br>
        <!-- <form method='POST'> -->
        <label for='$dienstid'>Dienst</label><br>
        <input type='text' name='$dienstname' id='$dienstid' class='widefat' value='$dienst'><br><br>
        <label for='$prijsid'>Prijs &euro;</label><br>
        <input type='text' name='$prijsname' id='$prijsid' class='widefat' value='$prijs'><br><br>
        <!-- <input type='submit' value='Opslaan'><br> -->
        <!-- </form> -->
        ";

        echo $prize_form;

    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'De_Rijn_Prijzen_Widget' );" ) );
?>