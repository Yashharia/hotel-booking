<?php

/**
 * Plugin Name: Hotel Booking
 * Plugin URI: https://www.yourwebsiteurl.com/
 * Description: This is the very first plugin I ever created.
 * Version: 1.0
 * Author: Your Name Here
 * Author URI: http://yourwebsiteurl.com/
 **/

add_action('wp_enqueue_scripts', 'my_plugin_assets');
function my_plugin_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_register_script('jqueryexample', 'https://code.jquery.com/jquery-3.6.0.min.js');
    wp_register_script('hotel-booking-js', plugins_url('script.js', __FILE__));
    wp_localize_script('hotel-booking-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('jqueryexample');
    wp_enqueue_script('hotel-booking-js');
}

add_action('meal_plan_add_form_fields', 'misha_add_term_fields');

function misha_add_term_fields($taxonomy)
{

    echo '<div class="form-field">
	<label for="meal-price">Price</label>
	<input type="number" name="meal-price" id="meal-price" />
	<p>Field description may go here.</p>
	</div>';
}

add_action('meal_plan_edit_form_fields', 'misha_edit_term_fields', 10, 2);

function misha_edit_term_fields($term, $taxonomy)
{

    $value = get_term_meta($term->term_id, 'meal-price', true);

    echo '<tr class="form-field">
	<th>
		<label for="meal-price">Price</label>
	</th>
	<td>
		<input name="meal-price" id="meal-price" type="number" value="' . esc_attr($value) . '" />
		<p class="description">Field description may go here.</p>
	</td>
	</tr>';
}

add_action('created_meal_plan', 'misha_save_term_fields');
add_action('edited_meal_plan', 'misha_save_term_fields');

function misha_save_term_fields($term_id)
{
    update_term_meta(
        $term_id,
        'meal-price',
        sanitize_text_field($_POST['meal-price'])
    );
}


require_once(__DIR__ . '/lib/cpt.php');
require_once(__DIR__ . '/lib/form-shortcode.php');
require_once(__DIR__ . '/lib/custom-fields.php');
require_once(__DIR__ . '/lib/ajax-submit.php');
